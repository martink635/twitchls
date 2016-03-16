'use strict'

var browser = require('./modules/browser')

browser.ready(function () {
  var keyDown = false
  var hideChat = document.getElementById('hide-chat')
  var fullscreen = document.getElementById('fullscreen')

  document.body.addEventListener('keydown', (event) => {
    if (keyDown) {
      return
    }

    keyDown = true

    switch (event.keyCode) {
      case 37:
      case 39:
        toggleChat()
        break
      case 40:
      case 38:
        toggleFullscreen()
        break
    }
  })

  document.body.addEventListener('keyup', () => { keyDown = false })

  hideChat.addEventListener('click', toggleChat, false)
  fullscreen.addEventListener('click', toggleFullscreen, false)

  function toggleChat () {
    var chatDiv = document.getElementById('chat')
    var streamDiv = document.getElementById('stream')

    hideChat.childNodes[0].classList.toggle('glyphicon-indent-right')
    hideChat.childNodes[0].classList.toggle('glyphicon-indent-left')
    hideChat.parentNode.classList.toggle('btn-group-on-stream')

    chatDiv.classList.toggle('hidden')
    chatDiv.classList.toggle('col-md-3')

    streamDiv.classList.toggle('col-md-9')
    streamDiv.classList.toggle('col-md-12')
  }

  function toggleFullscreen () {
    browser.toggleFullScreen()
    fullscreen.childNodes[0].classList.toggle('glyphicon-resize-full')
    fullscreen.childNodes[0].classList.toggle('glyphicon-resize-small')
  }
})
