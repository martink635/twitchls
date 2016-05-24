<template>
  <div class="row">

    <stream-item v-for="stream in streams" :stream="stream"></stream-item>

    <div class="col-md-12" v-show="! streams.length">No followed streams are currently online.</div>

  </div>
</template>

<script>
import StreamItem from './StreamItem.vue'
import store from '../vuex/store'
import { getFollowed } from '../vuex/actions'

export default {

  components: { StreamItem },

  vuex: {
    getters: {
      streams: state => state.followedList,
      auth: state => state.auth
    },
    actions: {
      getFollowed
    }
  },

  attached() {
    if (! this.auth) {
      return this.$router.go('/')
    }

    this.getFollowed(this.auth)
  },

  store
}
</script>
