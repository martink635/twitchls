window.stream = () => {
    return {
        dragging: false,
        chatWidth: parseInt(localStorage.getItem('chat-width')) ?? 375,
        tempChatWidth: 375,
        startDrag: false,
        chat: true,
        mode: window.matchMedia('(prefers-color-scheme: dark)').matches ? '&darkpopout' : '',
        init() {
            this.$refs.chat.style.width = this.chatWidth + 'px'
        },
        toggleChat() {
            this.chat  = !this.chat
        },
        dragStart($event) {
            this.dragging = true
            this.startDrag = $event.pageX
            console.log('dragStart', this)
        },
        dragMove($event) {
            if (this.dragging) {
                this.tempChatWidth = this.chatWidth + this.startDrag - $event.pageX
                this.$refs.chat.style.width = this.tempChatWidth + 'px'

                console.log('dragging', this)
            }
        },
        dragStop($event) {
            this.dragging = false
            this.chatWidth = this.tempChatWidth
            localStorage.setItem('chat-width', this.chatWidth)
            console.log('dragStop', this)
        },
        toggleFullscreen() {
            if (
                !document.fullscreenElement &&
                !document.mozFullScreenElement &&
                !document.webkitFullscreenElement &&
                !document.msFullscreenElement
            ) {
                if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
                } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen(
                    document.ALLOW_KEYBOARD_INPUT
                );
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
    }
}
