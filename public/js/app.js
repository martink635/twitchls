(()=>{var t,e={80:()=>{window.stream=function(){var t,e=null!==(t=localStorage.getItem("chat-width"))&&void 0!==t?t:375;return{dragging:!1,chatWidth:isNaN(e)?375:parseInt(e),tempChatWidth:375,startDrag:!1,chat:!0,mode:window.matchMedia("(prefers-color-scheme: dark)").matches?"&darkpopout":"",init:function(){window.innerWidth>768?this.$refs.chat.style.width=this.chatWidth+"px":(this.$refs.chat.style.width="100%",this.chat=!1)},toggleChat:function(){this.chat=!this.chat},dragStart:function(t){this.dragging=!0,this.startDrag=t.pageX},dragMove:function(t){this.dragging&&(this.tempChatWidth=this.chatWidth+this.startDrag-t.pageX,this.$refs.chat.style.width=this.tempChatWidth+"px")},dragStop:function(){this.dragging=!1,this.chatWidth=this.tempChatWidth,localStorage.setItem("chat-width",this.chatWidth)},toggleFullscreen:function(){document.fullscreenElement||document.webkitFullscreenElement?document.exitFullscreen?document.exitFullscreen():document.webkitExitFullscreen&&document.webkitExitFullscreen():document.documentElement.requestFullscreen?document.documentElement.requestFullscreen():document.documentElement.webkitRequestFullscreen&&document.documentElement.webkitRequestFullscreen(document.ALLOW_KEYBOARD_INPUT)}}}},662:()=>{}},i={};function n(t){var r=i[t];if(void 0!==r)return r.exports;var a=i[t]={exports:{}};return e[t](a,a.exports,n),a.exports}n.m=e,t=[],n.O=(e,i,r,a)=>{if(!i){var h=1/0;for(l=0;l<t.length;l++){for(var[i,r,a]=t[l],c=!0,s=0;s<i.length;s++)(!1&a||h>=a)&&Object.keys(n.O).every((t=>n.O[t](i[s])))?i.splice(s--,1):(c=!1,a<h&&(h=a));if(c){t.splice(l--,1);var o=r();void 0!==o&&(e=o)}}return e}a=a||0;for(var l=t.length;l>0&&t[l-1][2]>a;l--)t[l]=t[l-1];t[l]=[i,r,a]},n.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),(()=>{var t={773:0,170:0};n.O.j=e=>0===t[e];var e=(e,i)=>{var r,a,[h,c,s]=i,o=0;if(h.some((e=>0!==t[e]))){for(r in c)n.o(c,r)&&(n.m[r]=c[r]);if(s)var l=s(n)}for(e&&e(i);o<h.length;o++)a=h[o],n.o(t,a)&&t[a]&&t[a][0](),t[a]=0;return n.O(l)},i=self.webpackChunk=self.webpackChunk||[];i.forEach(e.bind(null,0)),i.push=e.bind(null,i.push.bind(i))})(),n.O(void 0,[170],(()=>n(80)));var r=n.O(void 0,[170],(()=>n(662)));r=n.O(r)})();