<template>
  <router-view/>
  <!-- Router import? -->

</template>

<style lang="scss">
@import "./style/main.scss";

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
