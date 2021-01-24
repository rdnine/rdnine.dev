<template>
    <div class="trunk bg-dark text-white text-center">
        <header>
            <div class="placeholder">
                <img
                    src="https://imgur.com/SCulelN.png"
                    alt="Rafael Duarte"
                    title="Hey! It's me!"
                />
            </div>
            <span>@rdnine</span>
            <div class="description">
                <h1>Rafael Duarte</h1>
                <span class="separator"></span>
                <h2>Web Developer</h2>
            </div>
        </header>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'

export default Vue.extend({
    layout: 'tree',
    async asyncData({ $axios }) {
        const data = await $axios.$get('/api/v1/links/all')
        return { data }
    },
})
</script>

<style lang="scss" scoped>
.trunk {
    width: 100%;
    max-width: 560px;
    min-height: 100vh;
    margin: auto;
    box-shadow: 0 0 15px rgba(0,0,0,.3);
}

header {
    width: 100%;
    padding: 45px 30px;
}

.placeholder {
    width: 150px;
    height: 150px;
    display: block;
    position: relative;
    margin: auto;
    margin-bottom: 8px;

    img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
    }
}

.description {
    margin-top: 15px;
    h1 {
        font-size: 26px;
        line-height: 32px;
        margin: 0;
    }
    h2 {
        font-size: 20px;
        line-height: 20px;
        margin: 0;
        font-weight: 300;
    }
}

span {
    font-weight: 700;
}

.separator {
    display: block;
    margin-top: 5px;
    margin-bottom: 10px;
    width: 30px;
    height: 2px;
    background-color: #fff;
    margin-left: auto;
    margin-right: auto;
}
</style>
