<template>

  <div class="row">
    <div class="col-md-12">
      <input type="text" class="form-control "@keyup="search | debounce 500" v-model="query" placeholder="Search...">
    </div>
  </div>

  <div class="row">

    <stream-item v-for="stream in found" :stream="stream"></stream-item>

  </div>

</template>

<script>
import StreamItem from './StreamItem.vue'
import store from '../vuex/store'
import { getFound, setQuery } from '../vuex/actions'

export default {

  components: { StreamItem },

  vuex: {
    getters: {
      found: state => state.searchList,
      searchQuery: state => state.searchQuery
    },
    actions: {
      getFound,
      setQuery
    }
  },

  data() {
    return {
      query: this.searchQuery
    }
  },

  methods: {
    search() {
      this.setQuery(this.query)
      this.getFound(this.query)
    }
  },

  store
}
</script>
