(()=>{var t,e={80:()=>{window.stream=function(){var t,e=null!==(t=localStorage.getItem("chat-width"))&&void 0!==t?t:375;return{dragging:!1,chatWidth:isNaN(e)?375:parseInt(e),tempChatWidth:375,startDrag:!1,chat:!0,mode:window.matchMedia("(prefers-color-scheme: dark)").matches?"&darkpopout":"",init:function(){window.innerWidth>768?this.$refs.chat.style.width=this.chatWidth+"px":(this.$refs.chat.style.width="100%",this.chat=!1)},toggleChat:function(){this.chat=!this.chat},dragStart:function(t){this.dragging=!0,this.startDrag=t.pageX},dragMove:function(t){this.dragging&&(this.tempChatWidth=this.chatWidth+this.startDrag-t.pageX,this.$refs.chat.style.width=this.tempChatWidth+"px")},dragStop:function(){this.dragging=!1,this.chatWidth=this.tempChatWidth,localStorage.setItem("chat-width",this.chatWidth)},toggleFullscreen:function(){document.fullscreenElement||document.webkitFullscreenElement?document.exitFullscreen?document.exitFullscreen():document.webkitExitFullscreen&&document.webkitExitFullscreen():document.documentElement.requestFullscreen?document.documentElement.requestFullscreen():document.documentElement.webkitRequestFullscreen&&document.documentElement.webkitRequestFullscreen(document.ALLOW_KEYBOARD_INPUT)}}}},662:()=>{}},n={};function i(t){var r=n[t];if(void 0!==r)return r.exports;var a=n[t]={exports:{}};return e[t](a,a.exports,i),a.exports}i.m=e,t=[],i.O=(e,n,r,a)=>{if(!n){var h=1/0;for(l=0;l<t.length;l++){for(var[n,r,a]=t[l],c=!0,s=0;s<n.length;s++)(!1&a||h>=a)&&Object.keys(i.O).every((t=>i.O[t](n[s])))?n.splice(s--,1):(c=!1,a<h&&(h=a));if(c){t.splice(l--,1);var o=r();void 0!==o&&(e=o)}}return e}a=a||0;for(var l=t.length;l>0&&t[l-1][2]>a;l--)t[l]=t[l-1];t[l]=[n,r,a]},i.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),(()=>{var t={773:0,170:0};i.O.j=e=>0===t[e];var e=(e,n)=>{var r,a,[h,c,s]=n,o=0;for(r in c)i.o(c,r)&&(i.m[r]=c[r]);if(s)var l=s(i);for(e&&e(n);o<h.length;o++)a=h[o],i.o(t,a)&&t[a]&&t[a][0](),t[h[o]]=0;return i.O(l)},n=self.webpackChunk=self.webpackChunk||[];n.forEach(e.bind(null,0)),n.push=e.bind(null,n.push.bind(n))})(),i.O(void 0,[170],(()=>i(80)));var r=i.O(void 0,[170],(()=>i(662)));r=i.O(r)})();