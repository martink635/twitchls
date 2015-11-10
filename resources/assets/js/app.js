'use strict';

var Vue = require('vue');
var browser = require('./modules/browser');
var tabs = require('./modules/tabs');
var r = require('./modules/request');
var bootstrap = require('./bootstrap/no-jquery');

var api = '/api/v1/';

browser.ready(function() {

    var collapsibleList = document.querySelectorAll('[data-toggle=collapse]');

    for (var i = 0, leni = collapsibleList.length; i < leni; i++) {
        collapsibleList[i].onclick = bootstrap.doCollapse;
    }

    if (! browser.canPlayHLS()) {
        var hlsAlert = document.getElementById('no-hls-alert');

        if (hlsAlert !== null && hlsAlert.classList.contains('hidden')) {
            hlsAlert.classList.remove('hidden');
        }
    }

    var searchForm = document.getElementById('searchForm');

    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
        }, false);
    }

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

    components: {
        'stream': require('./components/stream'),
    },

    /**
     * Runs on startup
     */
    compiled: function() {
        this.fetchStreams(true);
        this.fetchGames();

        var followedDiv = document.querySelector('.followed');

        if (followedDiv) {
            var identifier = document.querySelector('meta[name=identifier]');
            this.identifier = identifier.getAttribute('content');
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

            r.get(api+'streams/50/'+this.offset+'/'+this.game,
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

            r.get(api+'followed/50/'+this.offset+'/'+this.identifier,
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
            r.get(api+'games/30', this.populateGames);
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

            r.get(api+'search/'+this.searchQuery,
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
