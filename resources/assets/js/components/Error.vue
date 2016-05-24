<template>

  <div v-show="error">
    <div class="alert alert-danger" role="alert">
      <strong>Oh snap!</strong> {{ error }}
    </div>
  </div>

</template>

<script>
import store from '../vuex/store'

export default {
  vuex: {
    getters: {
      error: state => state.error
    }
  },

  store
}
</script>
