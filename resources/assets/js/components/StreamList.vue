<template>
  <div class="row">
    <div class="col-md-12">
      <v-select :value.sync="selected" :options="games" :on-change="loadStreams" placeholder="All Games"></v-select>
    </div>
  </div>
  <div class="row">
    <stream-item v-for="stream in streams" :stream="stream"></stream-item>
  </div>
  <a class="btn btn-primary" @click="loadMore" v-show="!loading">Load more</a>
</template>

<script>
import StreamItem from './StreamItem.vue'
import store from '../vuex/store'
import vSelect from './Select.vue'
import { getStreams, getGames } from '../vuex/actions'

export default {
  name: 'StreamList',
  components: { StreamItem, vSelect },

  vuex: {
    getters: {
      streams: state => state.allList,
      games: state => state.games,
      loading: state => state.loading
    },
    actions: {
      getStreams,
      getGames
    }
  },

  data() {
    return {
      selected: null,
      page: 0
    }
  },

  computed: {
    offset() {
      return this.page * 30
    },

    game() {
      if (this.selected) {
        return this.selected.key
      }

      return ''
    }

  },

  attached() {
    this.getStreams()
    this.getGames()
  },

  methods: {
    loadStreams() {
      this.getStreams(this.game)
    },
    loadMore() {
      this.page++
      this.getStreams(this.game, this.page*30)
    }
  },

  store
}
</script>
