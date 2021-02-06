<template>
  <main
    id="index"
    class="min-h-screen p-16 md:p-12 max-w-screen-xl flex flex-col justify-start md:justify-center"
  >
    <article>
      <div>
        <h1>Hello there 👋</h1>
        <h2>I'm Rafael</h2>
        <h3>
          A web developer from 🇵🇹 <br />
          I do magic on the web, one line of code at a time.<br /><br />
          Don't worry, this is just temporary. <br />
          Take a seat while I build my website.
        </h3>
        <p>In the mean time you can follow or reach me here:</p>
        <div class="mb-5"></div>

        <ul>
          <li class="inline-block">
            <NuxtLink to="/links" class="link link__iris"> links </NuxtLink>
          </li>
          <li class="inline-block">
            <NuxtLink to="/cv" class="link link__iris"> cv </NuxtLink>
          </li>
        </ul>
      </div>
    </article>
    <footer>
      <img
        src="logo_w.png"
        width="50"
        height="60"
        alt="rdnine.dev | Web Developer"
        title="rdnine.dev | Logo"
      />
      <div class="block h-16 w-full"></div>
      <p>
        Powered by
        <a
          href="https://vuejs.org/"
          target="_blank"
          rel="noopener"
          title="Vue it!"
        >
          Vue
        </a>
        and built with
        <a
          href="https://nuxtjs.org/"
          target="_blank"
          rel="noopener"
          title="The Intuitive Vue Framework"
        >
          Nuxt
        </a>
        ,
        <br />
        because it's Nutx!
      </p>
      <p class="mt-5">
        <small>what a corny joke 🤣</small>
      </p>
    </footer>
  </main>
</template>

<script lang="ts">
import Vue from 'vue'

export default Vue.extend({
  layout: 'fluid-dark',
})
</script>

<style lang="scss">
#index {
  article {
    width: 100%;
    max-width: 500px;
    margin-bottom: 120px;

    @media screen and (max-height: 900px) {
      margin-bottom: 90px;
    }

    @media screen and (max-width: 575px) {
      margin-bottom: 60px;
    }
  }

  footer {
    width: 100%;
    max-width: 500px;
    margin-bottom: 30px;
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

  a:not(.link) {
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
