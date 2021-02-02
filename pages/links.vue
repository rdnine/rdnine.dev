<template>
    <div class="trunk bg-dark text-white text-center">
        <header>
            <div class="placeholder">
                <img
                    src="https://imgur.com/vcXk91R.png"
                    alt="Rafael Duarte"
                    title="Hey! It's me!"
                    width="150"
                    height="150"
                />
            </div>
            <span class="text-2xl">@rdnine</span>
            <div class="description">
                <h1>Rafael Duarte</h1>
                <span class="separator"></span>
                <h2>Web Developer</h2>
            </div>
        </header>
        <div class="leafs">
            <LinksLeaf
                v-for="leaf in links"
                :key="leaf.id"
                :link="leaf.link"
                :labelTop="leaf.title"
                :labelUnder="leaf.description"
            />
        </div>
        <footer>
            <ul class="social-list">
                <li v-for="item in socials" :key="item.id">
                    <a :href="item.link" target="_blank" rel="noopener">
                        <img
                            :src="
                                'https://core.rdnine.dev/public/storage/' +
                                item.image
                            "
                            :alt="item.name"
                            :title="item.description"
                            width="50"
                            height="50"
                        />
                    </a>
                </li>
            </ul>
        </footer>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'

export default Vue.extend({
    layout: 'tree',
    async asyncData({ $axios }) {
        const { links } = await $axios.$get('/v1/links/all')
        const { socials } = await $axios.$get('/v1/social/all')

        return { links, socials }
    },
    head: {
        title: 'Rafael Duarte | Link Tree',
        meta: [
            {
                hid: 'description',
                name: 'description',
                content: 'Where you can find me across the web!',
            },
        ],
    },
})
</script>

<style lang="scss" scoped>
.trunk {
    width: 100%;
    max-width: 560px;
    min-height: 100vh;
    margin: auto;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);

    .leafs {
        width: 100%;
        max-width: 450px;
        margin: auto;
        padding: 30px 15px 30px;
    }

    .social-list {
        width: 100%;
        max-width: 450px;
        margin: auto;
        list-style-type: none;
        display: flex;
        flex-direction: row;
        align-content: center;
        justify-content: center;

        li {
            margin-left: 10px;
            margin-right: 10px;

            a {
                text-align: center;
                img {
                    max-width: 50px;
                    max-height: 50px;
                }
            }
        }
    }
}

header {
    width: 100%;
    padding: 45px 30px;
}

footer {
    padding: 15px 30px 30px 30px;
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
        border: 1px solid white;
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
    margin-top: 10px;
    margin-bottom: 10px;
    width: 30px;
    height: 2px;
    background-color: #fff;
    margin-left: auto;
    margin-right: auto;
}
</style>
