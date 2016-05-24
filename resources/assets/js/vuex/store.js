import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
  games: [],

  allList: [],
  searchList: [],
  followedList: [],

  searchQuery: '',

  auth: false,
  error: false,
  loading: false
}

const mutations = {
  RECEIVE_STREAMS (state, streams, attach = false) {
    if (attach) state.allList = state.allList.concat(streams)
    else state.allList = streams
  },
  RECEIVE_FOUND (state, streams) {
    state.searchList = streams
  },
  RECEIVE_FOLLOWED (state, streams) {
    state.followedList = streams
  },
  RECEIVE_GAMES (state, games) {
    state.games = games
  },
  SET_QUERY (state, query) {
    state.searchQuery = query
  },
  SET_AUTH (state, identifier) {
    state.auth = identifier
  },
  SET_ERROR (state, error) {
    state.error = error
  },
  CLEAR_ERROR (state) {
    state.error = false
  },
  LOADING (state, bool) {
    state.loading = bool
  }
}

export default new Vuex.Store({
  state,
  mutations
})
