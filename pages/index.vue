<template>
  <div id="index" class="min-h-screen flex mx-auto flex-col">
    <article>
      <nuxt-content :document="data" />
    </article>
    <Footer :data="footer" />
  </div>
</template>

<script lang="ts">
import Vue from 'vue'

export default Vue.extend({
  layout: 'landing',
  async asyncData({ $content }: any): Promise<object> {
    const data = await $content('index').fetch()
    const footer = await $content('footer').fetch()
    return { data, footer }
  },
})
</script>

<style lang="scss">
html {
  font-size: 10px;
  font-family: 'Roboto Mono', monospace;
}

#index {
  article {
    max-width: 500px;
    height: 75vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 30px 0;
  }

  h1 {
    font-size: 4.8rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 1.5rem;
    letter-spacing: 0.1rem;
  }

  h2 {
    font-size: 2.4rem;
    font-weight: 700;
    color: #feda6a;
  }

  h3 {
    color: #fff;
    margin-top: 15px;
    margin-bottom: 30px;
    font-size: 1.6rem;
    font-weight: 500;
    line-height: 2.2rem;
  }

  p {
    color: #cfdbd5;
    font-size: 1.6rem;
    line-height: 2.2rem;
  }

  a {
    color: #feda6a;
    text-decoration: none;
    position: relative;
    z-index: 1;
    transition: all 0.3s ease;

    &::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      margin: auto;
      width: 0;
      height: 1px;
      background-color: #feda6a;
      transition: width 0.5s ease;
    }

    &:hover {
      &::after {
        width: 100%;
      }
    }
  }
}
</style>
