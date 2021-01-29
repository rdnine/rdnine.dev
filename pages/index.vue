<template>
    <div id="index" class="min-h-screen flex mx-auto flex-col">
        <article>
            <h1>Hello there 👋</h1>
            <h2>I'm Rafael</h2>
            <h3>
                A web developer from 🇵🇹 <br />
                I do magic on the web, one line of code at a time.
            </h3>
            <p>
                In the mean time you can follow or reach me here:
                <a
                    href="https://links.rdnine.dev/"
                    target="_blank"
                    rel="noopener"
                    title="Links"
                >
                    links.rdnine.dev
                </a>
            </p>
        </article>
        <footer>
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
                , because it's Nutx!
            </p>
            <p>
                <small>what a corny joke 🤣</small>
            </p>
        </footer>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'

export default Vue.extend({
    layout: 'landing',
})
</script>

<style lang="scss">
html {
    font-size: 10px;
    font-family: 'Roboto Mono', monospace;
}

#index {
    article {
        width: 100%;
        max-width: 500px;
        min-height: 70vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin-top: 30px;
        margin-bottom: 60px;

        @media screen and (max-height: 900px) {
            min-height: 60vh;
            margin-bottom: 30px;
        }

        @media screen and (max-width: 575px) {
            justify-content: flex-start;
            margin-bottom: 60px;
        }
    }

    footer {
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
