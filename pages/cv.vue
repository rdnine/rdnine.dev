<template>
  <main
    id="cv"
    class="w-full h-screen max-w-screen-xl mx-auto flex content-center"
  >
    <aside class="flex h-90c my-auto w-2/5 z-10">
      <div class="nav bg-dark w-32 h-90c my-auto relative">
        <div
          class="absolute top-0 w-full h-32 flex content-center justify-center"
        >
          <button
            class="block focus:outline-none hover:outline-none"
            title="Know more about me"
            @click="toggleDock"
          >
            <img src="profile.svg" alt="Profile" width="30" height="30" />
          </button>
        </div>
        <div
          class="absolute bottom-0 w-full h-32 flex content-center justify-center"
        >
          <a
            href="cv-2021.pdf"
            download
            class="focus:outline-none hover:outline-none flex content-center justify-center"
            title="Download my CV"
          >
            <img src="download.svg" alt="Profile" width="30" height="30" />
          </a>
        </div>
      </div>
      <div class="profile h-full flex-1 relative overflow-hidden">
        <div class="profile__picture h-full w-full flex">
          <figure class="h-full w-full">
            <img
              src="side_dark.jpg"
              alt="Me"
              class="h-full w-full object-center object-cover"
            />
          </figure>
        </div>
        <div
          class="profile__dock absolute top-0 bottom-0 my-auto h-full w-full transition-all duration-500 ease-in-out bg-dark"
          :class="activeDock ? 'left-0' : '-left-full delay-500'"
        ></div>
        <div
          class="profile__basic absolute left-0 right-0 w-4/5 mx-auto pt-12 pb-12 text-center transition-all duration-500 ease-in-out"
          :class="activeDock ? 'bottom-3/4 delay-500' : 'bottom-5'"
        >
          <h1 class="text-white text-6xl font-black mb-5">Rafael Duarte</h1>
          <h2 class="text-sublime-yellow text-2xl font-bold">Web Developer</h2>
        </div>
        <div class="profile__info"></div>
      </div>
    </aside>
    <section class="flex h-90c my-auto w-3/5">
      <article class="w-full h-90c my-auto relative bg-dark"></article>
    </section>
  </main>
</template>

<script>
import Vue from 'vue'

export default Vue.extend({
  layout: 'fluid-grey',
  data: () => {
    return {
      activeDock: false,
    }
  },
  methods: {
    toggleDock() {
      this.activeDock = !this.activeDock
    },
  },
})
</script>

<style lang="scss" scoped>
.profile {
  box-shadow: 2px 2px 15px 5px rgba(0, 0, 0, 0.3);
}
</style>
