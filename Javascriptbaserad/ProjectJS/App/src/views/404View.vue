<template>
  <div class="home maxWidthAndCenter">
    <Header />
    <div class="spaceDivider" />

    <h1>404</h1>

    <p>This page dosent exist, go to following:</p>

    <!-- <Footer /> -->
  </div>
</template>

<script>
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";

export default {
  name: "404",

  //Import components
  components: {
    Header,
    Footer,
  },
};
</script>


<style scoped lang="scss">
</style>
