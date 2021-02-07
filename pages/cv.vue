<template>
  <main id="cv" class="w-full h-screen max-w-screen-xl mx-auto">
    <aside class="absolute top-0 bottom-0 h-90c my-auto w-2/5 flex">
      <div class="nav bg-dark w-32 h-90c my-auto relative">
        <div
          class="absolute top-0 w-full h-32 flex content-center justify-center"
        >
          <button class="block focus:outline-none hover:outline-none">
            <img src="profile.svg" alt="Profile" width="30" height="30" />
          </button>
        </div>
        <div
          class="absolute bottom-0 w-full h-32 flex content-center justify-center"
        >
          <a
            href="cv-2021.pdf"
            download
            class="block focus:outline-none hover:outline-none flex content-center justify-center"
          >
            <img src="download.svg" alt="Profile" width="30" height="30" />
          </a>
        </div>
      </div>
      <div class="profile h-full flex-1">
        <div class="profile__picture h-full w-full flex relative">
          <figure class="h-full w-full">
            <img
              src="side_dark.jpg"
              alt="Me"
              class="h-full w-full object-center object-cover"
            />
          </figure>
        </div>
        <div class="profile__info"></div>
      </div>
    </aside>
  </main>
</template>

<script>
import Vue from 'vue'

export default Vue.extend({
  layout: 'fluid-grey',
})
</script>
