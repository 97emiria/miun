<template>
  <div class="home maxWidthAndCenter">
    <Header />
    <div class="spaceDivider" />

    <h1>Love page</h1>

    <p>
      No terms and condition exist more then remember to be kind in the app and
      bonus if you share some love today! Have a lovley day!
    </p>

    <div class="imgDiv">
      <img src="../assets/moods/love.png" alt="" />
    </div>
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
@import "../style/main.scss";

p {
    max-width: 450px;
    margin: 0 auto;
}
.imgDiv {
  text-align: center;
  margin: 2em 0;
}
img {
  background-color: $light;
  border-radius: 50%;
  width: 150px;
}
</style>
