'use strict';

var $ = require('jquery');
var Vue = require('vue');
var browser = require('./browser');
var tabs = require('./tabs');

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
        var hlsAlert = document.getElementById('no-hls-alert');

        if (hlsAlert !== null && hlsAlert.classList.contains('hidden')) {
            hlsAlert.classList.remove('hidden');
        }

        $('#stream iframe').attr('src', function(index, attribute) {
            return attribute.replace('hls', 'embed');
        });
    }

    $('#searchForm').on('submit', function(e) {
        return false;
    });

    var tab = document.querySelectorAll('.nav-tabs li');

    for (var i = 0; i < tab.length; i++) {
        tab[i].addEventListener('click', tabs.changeActive, 'false');
    }

    // If logged in, hide 'all', show 'followed' by default
    if (document.querySelectorAll('.followed').length > 0) {
        document.querySelector('.streams.all').classList.add('hidden');
    }

    // If there's a hash in the url, 'click' the appropriate tab
    if (location.hash !== "") {
        var hash = location.hash.substring(1);
        document.querySelectorAll('[data-key='+hash+']')[0].click();
    }
});

var streams = new Vue({
    el: '#vue',

    data: {
        followed:        [],
        followedLoading: true,
        identifier:      "",

        streams:         [],
        game:            "",
        games:           [],
        page:            0,
        loading:         true,

        searchQuery:     '',
        searchResults:   [],
        searchLoading:   false
    },

    computed: {
        offset: function() {
            return this.page * 50;
        }
    },

    /**
     * Runs on startup
     */
    compiled: function() {
        this.fetchStreams(true);
        this.fetchGames();

        if ($('.followed').length) {
            this.identifier = $('meta[name=identifier]').attr("content");
            this.fetchFollowed();
        }

        this.$watch('game', (function () {
            this.fetchStreams(true);
        }).bind(this));

        this.$watch('searchQuery', (function () {
            this.fetchSearchResults();
        }).bind(this));
    },

    /**
     * Remove the 'hidden' class so it doesn't show
     * the {{ ... }} before the Javascript loads.
     *
     * @return {void}
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
         * Fetches the followed stream using the internal API.
         *
         * @return {void}
         */
        fetchFollowed: function() {
            this.followedLoading = true;

            $.get(api+'followed/50/'+this.offset+'/'+this.identifier,
                (function(data) {
                    this.followed = data;
                    this.followedLoading = false;
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
            $.get(api+'games/30', this.populateGames);
        },

        /**
         * Populates the games list correctly so that we can use the
         * Vue options on the select field
         *
         * @param  {json} data
         * @return {void}
         */
        populateGames: function(data) {
            this.games = [{value: '', text: 'All Games'}];

            data.forEach((function(game) {
                this.games.push({
                    value: game.name,
                    text: game.name+' ('+game.viewers+')'
                });
            }).bind(this));
        },

        /**
         * Fetch a list of top 30 games by viewers
         *
         * @return {void}
         */
        fetchSearchResults: function() {
            this.resetSearchResults();

            $.get(api+'search/'+this.searchQuery,
                (function(data) {
                    this.searchResults = data;
                    this.searchLoading = false;
                }).bind(this)
            );
        },

        /**
         * Reset the search results
         *
         * @return {void}
         */
        resetSearchResults: function() {
            this.searchResults = [];
            this.searchLoading = true;
        },
    }
});
