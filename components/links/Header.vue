<template>
  <header>
    <div class="placeholder">
      <img :src="img" :alt="name" title="Hey! It's me!" />
    </div>
    <span>{{ username }}</span>
    <div class="description">
      <h1>{{ name }}</h1>
      <span class="separator"></span>
      <h2>{{ job }}</h2>
    </div>
  </header>
</template>

<script lang="ts">
export default {
  name: 'Header',
  props: {
    img: {
      type: String,
      default: '',
    },
    name: {
      type: String,
      default: '',
    },
    username: {
      type: String,
      default: '',
    },
    job: {
      type: String,
      default: '',
    },
  },
}
</script>

<style lang="scss" scoped>
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

h1,
h2,
p,
span {
  color: #17242a;
}

.separator {
  display: block;
  margin-top: 5px;
  margin-bottom: 10px;
  width: 30px;
  height: 2px;
  background-color: #17242a;
  margin-left: auto;
  margin-right: auto;
}
</style>
