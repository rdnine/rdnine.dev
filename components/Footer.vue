<template>
  <footer>
    <img
      class="logo"
      src="logo_w.png"
      width="50"
      height="60"
      alt="rdnine.dev | Web Developer"
      title="rdnine.dev | Logo"
    />
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
}

@keyframes appear {
  0% {
    opacity: 0;
  }
}
</style>
