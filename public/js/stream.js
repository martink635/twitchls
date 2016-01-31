(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

module.exports = {

  /**
   * Using this function we can determine whether the browser
   * can display HLS content.
   *
   * @return {boolean}
   */
  canPlayHLS: function canPlayHLS() {
    var result = document.createElement('video').canPlayType('application/vnd.apple.mpegURL');

    if (result === "maybe") {
      return true;
    }

    return false;
  },

  /**
   * Toggle browser fullscren.
   *
   * @return {void}
   */
  toggleFullScreen: function toggleFullScreen() {
    if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
      if (document.documentElement.requestFullscreen) {
        document.documentElement.requestFullscreen();
      } else if (document.documentElement.msRequestFullscreen) {
        document.documentElement.msRequestFullscreen();
      } else if (document.documentElement.mozRequestFullScreen) {
        document.documentElement.mozRequestFullScreen();
      } else if (document.documentElement.webkitRequestFullscreen) {
        document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
      }
    } else {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
      }
    }
  },

  ready: function ready(fn) {

    // Sanity check
    if (typeof fn !== 'function') return;

    // If document is already loaded, run method
    if (document.readyState === 'complete') {
      return fn();
    }

    // Otherwise, wait until document is loaded
    document.addEventListener('DOMContentLoaded', fn, false);
  }
};

},{}],2:[function(require,module,exports){
'use strict';

var browser = require('./modules/browser');

browser.ready(function () {

    var hideChat = document.getElementById('hide-chat');

    if (hideChat) {
        hideChat.addEventListener('click', function (e) {
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
        fullscreen.addEventListener('click', function (e) {
            browser.toggleFullScreen();
            this.childNodes[0].classList.toggle('glyphicon-resize-full');
            this.childNodes[0].classList.toggle('glyphicon-resize-small');
        }, false);
    }

    if (!browser.canPlayHLS()) {

        var streamFrame = document.querySelector('#stream iframe');

        if (streamFrame) {
            var attr = streamFrame.getAttribute('src');
            streamFrame.setAttribute('src', attr.replace('hls', 'embed'));
        }
    }
});

},{"./modules/browser":1}]},{},[2]);
