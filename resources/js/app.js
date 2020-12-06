window.stream = () => {
    const defaultWidth = 375
    const width = localStorage.getItem('chat-width') ?? defaultWidth

    return {
        dragging: false,
        chatWidth: isNaN(width) ? defaultWidth : parseInt(width),
        tempChatWidth: defaultWidth,
        startDrag: false,
        chat: true,
        mode: window.matchMedia('(prefers-color-scheme: dark)').matches ? '&darkpopout' : '',
        init() {
            if (window.innerWidth > 768) {
                this.$refs.chat.style.width = this.chatWidth + 'px'
            } else {
                this.$refs.chat.style.width = '100%'
                this.chat = false
            }
        },
        toggleChat() {
            this.chat  = !this.chat
        },
        dragStart($event) {
            this.dragging = true
            this.startDrag = $event.pageX
        },
        dragMove($event) {
            if (this.dragging) {
                this.tempChatWidth = this.chatWidth + this.startDrag - $event.pageX
                this.$refs.chat.style.width = this.tempChatWidth + 'px'
            }
        },
        dragStop() {
            this.dragging = false
            this.chatWidth = this.tempChatWidth
            localStorage.setItem('chat-width', this.chatWidth)
        },
        toggleFullscreen() {
            if (
                !document.fullscreenElement &&
                !document.webkitFullscreenElement
            ) {
                if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen(
                    document.ALLOW_KEYBOARD_INPUT
                );
                }
            } else {
                if (document.exitFullscreen) {
                document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
                }
            }
        },
    }
}
