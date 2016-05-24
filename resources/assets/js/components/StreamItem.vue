<template>
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
    <a v-link="{ path: stream.channel }">
      <div class="card card-inverse">
        <img class="card-img img-fluid" :src="stream.preview" alt="Stream preview">
        <div class="card-img-overlay">
          <div class="card-footer">
            <h4 class="card-title">{{ stream.title }}</h4>
            <p class="card-text">{{ stream.viewers }} on {{ stream.channel }}</p>
          </div>
        </div>
      </div>
    </a>
  </div>
</template>

<script>
export default {
  props: ['stream']
}
</script>
