"use strict";

var $ = require('jquery');
var Vue = require('vue');
var browser = require('./browser');

var api = '/api/v1/';

$(document).ready(function() {
    $('#hide-chat').click(function() {
        $('span:first', this).toggleClass('glyphicon-indent-right glyphicon-indent-left');
        $(this).parent().toggleClass('btn-group-on-stream');
        $('#chat').toggleClass('hidden col-md-3');
        $('#stream').toggleClass('col-md-9 col-md-12');
    });

    $('#fullscreen').click(function() {
        browser.toggleFullScreen();
        $('span:first', this).toggleClass('glyphicon-resize-full glyphicon-resize-small');
    });

    if (! browser.canPlayHLS()) {
        $('#no-hls-alert').toggleClass('hidden');

        $('#stream iframe').attr('src', function(index, attribute) {
            return attribute.replace('hls', 'embed');
        });
    }
});

var streams = new Vue({
    el: '.streams',

    data: {
        streams:    [],
        game:       "",
        games:      [],
        page:       0,
        loading:    true
    },

    computed: {
        offset: function() {
            return this.page * 50;
        }
    },

    /**
     * Runs this on startup
     */
    compiled: function() {
        this.fetchStreams(true);
        this.fetchGames();

        this.$watch('game', (function () {
            this.fetchStreams(true);
        }).bind(this));
    },

    /**
     * Remove the 'hidden' class so it doesn't show
     * the {{ ... }} before the Javascript loads.
     */
    ready: function() {
        this.$el.classList.remove('hidden');
    },

    methods: {
        /**
         * Fetches the stream using the internal API.
         *
         * @param  {boolean} clean Whether we clean the stream list or not.
         * @return {void}
         */
        fetchStreams: function(clean) {
            this.loading = true;

            if (clean !== undefined) {
                this.resetStreams();
            }

            $.get(api+'streams/50/'+this.offset+'/'+this.game,
                (function(data) {
                    this.streams = this.streams.concat(data);
                    this.loading = false;
                    this.page++;
                }).bind(this)
            );
        },

        /**
         * Reset the stream list
         *
         * @return {void}
         */
        resetStreams: function() {
            this.streams = [];
            this.page = 0;
        },

        /**
         * Called when the button "load more streams" is pressed
         *
         * @return {void}
         */
        loadMoreStreams: function() {
            this.fetchStreams();
        },

        /**
         * Fetch a list of top 30 games by viewers
         *
         * @return {void}
         */
        fetchGames: function() {
            $.get(api+'games/30', (function(data) {
                this.games = data;
            }).bind(this));
        }
    }
});
