<template>
  <footer>
    <img class="logo" src="logo_w.png" alt="rdnine.dev | Web Developer" />
    <div class="block h-16 w-full"></div>
    <nuxt-content :document="data" />
  </footer>
</template>

<script lang="ts">
export default {
  props: {
    data: {
      type: Object,
      default: () => {},
    },
  },
}
</script>

<style scoped>
.logo {
  animation: 1s appear;
  display: block;
  max-width: 50px;
}

@keyframes appear {
  0% {
    opacity: 0;
  }
}
</style>
