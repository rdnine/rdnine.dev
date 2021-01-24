<template>
    <div id="links"></div>
</template>

<script lang="ts">
import Vue from 'vue'

export default Vue.extend({
    layout: 'fluid',
    async asyncData({ $axios }) {
        const data = await $axios.$get('/api/v1/links/all')
        return { data }
    },
})
</script>
