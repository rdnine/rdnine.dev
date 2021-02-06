<template>
  <main id="cv" class="w-full h-screen max-w-screen-xl mx-auto">
    <aside class="absolute top-0 bottom-0 h-90c my-auto w-2/5 flex">
      <div class="nav bg-dark w-48 h-90c my-auto">

      </div>
      <div class="profile h-full flex content-center">
        <div class="profile__picture">

        </div>
        <div class="profile__info">
          <figure>
            <img src="side.jpg" alt="Me" />
          </figure>
        </div>
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
