'use strict';

var browser = require('./modules/browser');
var hotkeys = require('hotkeys-js');

browser.ready(function() {

    var hideChat = document.getElementById('hide-chat');

    if (hideChat) {
        hideChat.addEventListener('click', function(e) {
            this.childNodes[0].classList.toggle('glyphicon-indent-right');
            this.childNodes[0].classList.toggle('glyphicon-indent-left');
            this.parentNode.classList.toggle('btn-group-on-stream');

            document.getElementById('chat').classList.toggle('hidden');
            document.getElementById('chat').classList.toggle('col-md-3');

            document.getElementById('stream').classList.toggle('col-md-9');
            document.getElementById('stream').classList.toggle('col-md-12');
        }, false);
    }

    var fullscreen = document.getElementById('fullscreen');

    if (fullscreen) {
        fullscreen.addEventListener('click', function(e) {
            browser.toggleFullScreen();
            this.childNodes[0].classList.toggle('glyphicon-resize-full');
            this.childNodes[0].classList.toggle('glyphicon-resize-small');
        }, false);
    }

});
