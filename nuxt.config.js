export default {
    // Disable server-side rendering (https://go.nuxtjs.dev/ssr-mode)
    ssr: false,

    // Target (https://go.nuxtjs.dev/config-target)
    target: 'static',

    // Global page headers (https://go.nuxtjs.dev/config-head)
    head: {
        htmlAttrs: {
            lang: 'en',
        },
        title: 'Rafael Duarte | Web Developer & Tech Lover',
        meta: [
            { charset: 'utf-8' },
            {
                name: 'viewport',
                content: 'width=device-width, initial-scale=1',
            },
            {
                name: 'keywords',
                content:
                    'developer, coder, programmer, web, web developer, tech, vue, nuxt, php, full-stack, front-end, back-end',
            },
            {
                hid: 'description',
                name: 'description',
                content:
                    "I'm a Web Developer from Portugal, learning and building as much as I can. Come and see the goddies!",
            },
        ],
        link: [
            { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
            {
                rel: 'stylesheet',
                href:
                    'https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;600;700&display=swap',
            },
        ],
    },

    // Global CSS (https://go.nuxtjs.dev/config-css)
    css: [],

    // Plugins to run before rendering page (https://go.nuxtjs.dev/config-plugins)
    plugins: [],

    // Auto import components (https://go.nuxtjs.dev/config-components)
    components: true,

    // Modules for dev and build (recommended) (https://go.nuxtjs.dev/config-modules)
    buildModules: [
        // https://go.nuxtjs.dev/typescript
        '@nuxt/typescript-build',
        // https://go.nuxtjs.dev/tailwindcss
        '@nuxtjs/tailwindcss',
    ],

    // Modules (https://go.nuxtjs.dev/config-modules)
    modules: [
        // https://go.nuxtjs.dev/content
        '@nuxt/content',
    ],

    // Content module configuration (https://go.nuxtjs.dev/config-content)
    content: {
        liveEdit: false,
    },

    // Build Configuration (https://go.nuxtjs.dev/config-build)
    build: {},

    render: {
        // Setting up cache for 'static' directory - a year in milliseconds
        // https://web.dev/uses-long-cache-ttl
        static: {
            maxAge: 60 * 60 * 24 * 365 * 1000,
        },
    },
}
