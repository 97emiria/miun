<template>
  <div class="feed maxWidthAndCenter">
    <Header />
    <div class="spaceDivider" />
    <h1>Vibbz feed</h1>

    <PostLayout
      v-for="post in postsArr.slice(display, quantity)"
      :key="post"
      :postID="post._id"
      :textEl="post.text"
      :usernameEl="post.username"
      :emotionEl="post.emotion"
      :hashtagsEl="post.hashtags"
      :timestampEL="post.timestamp"
      :showDeleteBtn="false"
    />

    <div class="btnBox">
      <div>
        <button @click="back()" v-if="!display == 0">
          <img src="../assets/iconLeft.png" alt="" />
        </button>
      </div>
      <div>
        <p>{{ pageNumber }} / {{ Math.ceil(postsArr.length / 5) }}</p>
      </div>
      <div>
        <button
          @click="forward()"
          v-if="pageNumber != Math.ceil(postsArr.length / 5)"
        >
          <img src="../assets/iconRight.png" alt="" />
        </button>
      </div>
    </div>

    <!-- <Footer /> -->
  </div>
</template>



<script>
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";
import PostLayout from "../components/PostLayout.vue";

export default {
  name: "HomeView",

  //Import components
  components: {
    Header,
    Footer,
    PostLayout,
  },

    data() {
      return {
        postsArr: {},   //post array
        display: 0,     //Från vart i arrayen
        quantity: 5,    //Hur många som ska vissas
        pageNumber: 1,  
      };
    },



  methods: {
    forward() {
      this.display = this.display + 5;
      this.quantity = this.quantity + 5;
      this.pageNumber++;
      window.scrollTo({
      behavior: "smooth",
      top: 0,
    });
    },

    back() {
      this.display = this.display - 5;
      this.quantity = this.quantity - 5;
      this.pageNumber--;
      window.scrollTo({
      behavior: "smooth",
      top: 0,
    });
    },
    //Get posts
    getPosts() {
      fetch(`https://radiant-brushlands-91826.herokuapp.com/posts`, {
        method: "GET",
      }).then((response) => {
        response.json().then((data) => {
          this.postsArr = data;
        });
      });
    },

    getImgUrl(emotion) {
      var images = require.context("../assets/moods", false, /\.png$/);
      return images("./" + emotion + ".png");
    },
  },

  beforeMount() {
    this.getPosts();
  },
};
</script>


<style scoped lang="scss">
@import "../style/main.scss";

.btnBox {
  width: 100%;
  display: flex;
  justify-content: space-between;
  margin: 1em 0;
  align-items: center;

  div {
    width: 100px;
    text-align: center;
  }

  button {
    background: $light;
    color: $dark;
    border: none;
    border-radius: $br;
    cursor: pointer;
    padding: 0.5em;
    font-weight: bold;

    font-family: $bodyFont;
    width: 100%;
    max-width: 100px;
    display: block;

    img {
      width: 35px;
      height: 35px;
    }

    &:hover {
      color: white;
      background-color: darken($light, 20%);
    }
  }
}

.dontClick {
  background-color: #ddd;
  cursor: not-allowed;
}
</style>
