<template>

  <nav id="topNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <button
        class="navbar-toggler hidden-md-up pull-right"
        type="button"
        data-toggle="collapse"
        data-target="#collapsingNavbar">☰</button>

      <a class="navbar-brand page-scroll" v-link="{ path: '/', exact: true }">
        <span class="logo">twitc<span class="logo__hls">hls</span></span>
      </a>

      <div class="collapse navbar-toggleable-sm" id="collapsingNavbar">

        <ul class="nav navbar-nav" @click="toggleNavbar">

          <li class="nav-item" v-show="auth">
            <a class="nav-link page-scroll" v-link="{ path: '/followed' }">followed</a>
          </li>

          <li class="nav-item">
            <a class="nav-link page-scroll" v-link="{ path: '/', exact: true }">streams</a>
          </li>

          <li class="nav-item">
            <a class="nav-link page-scroll" v-link="{ path: '/search' }">search</a>
          </li>

        </ul>

        <ul class="nav navbar-nav pull-xs-right"  @click="toggleNavbar">

          <li class="nav-item">
            <a class="nav-link page-scroll" v-link="{ path: '/settings' }">settings</a>
          </li>

          <li class="nav-item">
            <a class="nav-link page-scroll" v-link="{ path: '/about' }">about</a>
          </li>

          <li class="nav-item" v-show="! auth">
            <a class="nav-link page-scroll" href="/login">login with Twitch.tv</a>
          </li>

          <li class="nav-item" v-show="auth">
            <a class="nav-link page-scroll" href="/logout">logout</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <div class="container main-container">
    <error></error>
    <router-view keep-alive></router-view>
  </div>
</template>

<script>
import store from '../vuex/store'
import { setAuth } from '../vuex/actions'
import Error from './Error.vue'

export default {
  name: 'App',
  components: { Error },
  vuex: {
    getters: { auth: state => state.auth },
    actions: { setAuth }
  },

  methods: {
    toggleNavbar() {
      $('.navbar-toggler:visible').click()
    }
  },

  created() {
    const identifier = document.querySelector('meta[name=identifier]')

    if (identifier) {
      this.setAuth(identifier.getAttribute('content'))
    }
  },

  store
}
</script>
