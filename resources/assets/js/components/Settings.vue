<template>

  <div class="row">
    <div class="col-md-6 col-md-offset-3">

      <h1>Settings</h1>

      <label class="c-input c-checkbox">
        <input type="checkbox" v-model="html5playback">
        <span class="c-indicator"></span>
        Experimental HTML5 playback <small class="text-muted">(for non HLS browsers)</small>
      </label>
      <p><small class="text-muted">This has been tested on the latest Chrome and Firefox. <br>It doesn't turn off HTML5 streaming on HLS enabled browsers.</small></p>

      <div v-show="auth">
        <hr>
        <p>
          You are currently logged in via Twitch.<br>
          <small class="text-muted">We do not store your Twitch information. If you would like to remove the Twitch.tv connection for this website, click <i>Disconnect</i> for <i>twitchls</i> <a href="http://www.twitch.tv/settings/connections">here</a>.</small>
        </p>
      </div>

    </div>
  </div>

</template>

<script>
import store from '../vuex/store'
import Vue from 'vue'

export default {
  name: 'Settings',
  
  vuex: {
    getters: { auth: state => state.auth }
  },

  data() {
    return {
      html5playback: true
    }
  },

  created() {
    this.html5playback = JSON.parse(localStorage.getItem('html5playback'))

    if (this.html5playback === null) {
      this.html5playback = true
    }

    this.$watch('html5playback', value => {
      localStorage.setItem('html5playback', value)
    })
  },

  store
}

</script>
