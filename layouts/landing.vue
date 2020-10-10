<template>
  <div class="wrapper">
    <Nuxt />
  </div>
</template>

<style lang="scss">
html {
    font-family: 'Roboto Mono', sans-serif;
    font-size: 10px; /* BASE FONT-SIZE FOR EASIER rem MESURE */
    word-spacing: 1px;
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    box-sizing: border-box;
}

*,
*::before,
*::after {
    box-sizing: border-box;
    margin: 0;
}

.wrapper {
    width: 100%; 
    min-height: 100vh;
    padding: 0 10vw;
    background-color: $bgDark;
}

</style>
