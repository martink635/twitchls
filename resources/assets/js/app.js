import Vue from 'vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'

import App from './components/App.vue'
import StreamList from './components/StreamList.vue'
import Followed from './components/Followed.vue'
import Search from './components/Search.vue'
import Stream from './components/Stream.vue'
import About from './components/About.vue'
import Settings from './components/Settings.vue'

Vue.use(VueResource)
Vue.use(VueRouter)

export const router = new VueRouter({
  linkActiveClass: 'active',
  history: true,
  hashbang: false,
  mode: 'html5'
})

router.map({
  '/': {
    component: StreamList
  },
  '/about': {
    component: About
  },
  'settings': {
    component: Settings
  },
  '/followed': {
    component: Followed
  },
  '/search': {
    component: Search
  },
  '/:channel': {
    component: Stream
  }
})

// Redirect to the home route if any routes are unmatched
router.redirect({
  '*': '/'
})

// Start the app on the #app div
router.start(App, 'app')
