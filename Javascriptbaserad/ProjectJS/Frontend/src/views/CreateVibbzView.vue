<template>
  <div class="CreateVibbz maxWidthAndCenter">
    <Header />
    <div class="spaceDivider" />

    <h1>Create Vibbz</h1>

    <div class="error" id="error" v-if="errorMessage">
      <p>{{ errorMessage }}</p>
    </div>

    <form @submit.prevent="handleSubmit()">
      <h3>Post a Vibbz</h3>

      <label>My vibb text:</label>
      <textarea id="post" name="post" v-model="postText" required />
      <p id="countCh">{{ postText.length }} / 244</p>

      <!-- <label>Hashtag</label>
      <input type="text" v-model="hashtag" @keyup.space="addHashtag" />
      <div class="hashtag">
        <p
          @click="deleteHashtag(hashtag)"
          v-for="hashtag in hashtagsArr"
          :key="hashtag"
        >
          #{{ hashtag }}
        </p>
      </div>

      <br />
      <br /> -->
      <label>Mood:</label> <br />
      <select v-model="mood">
        <option value="glad">Glad</option>
        <option value="love">Love</option>
        <option value="mad">Mad</option>
        <option value="neutral">Neutral</option>
        <option value="sad">Sad</option>
        <option value="surprised">Surprised</option>
        <option value="tired">Tired</option>
      </select>

      <input type="submit" value="Post Vibbz" />
    </form>

    <!-- <Footer /> -->
  </div>
</template>

<script>
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";

export default {
  name: "CreateVibbz",

  data() {
    return {
      postText: "",
      mood: "glad",
      hashtag: "",
      hashtagsArr: [],
      textCh: 0,
      errorMessage: "",
    };
  },

  //Import components
  components: {
    Header,
    Footer,
  },

  methods: {
    addHashtag(e) {
      if (this.hashtag) {
        //Check if hashtag already inside array
        if (!this.hashtagsArr.includes(this.hashtag)) {
          //Add to array
          this.hashtagsArr.push(this.hashtag);
        } else {
          document.getElementById("error").innerHTML = "Hashtag already typed";
        }

        //Clear input
        this.hashtag = "";
      }
    },

    deleteHashtag(hashtag) {
      this.hashtagsArr = this.hashtagsArr.filter((item) => {
        return hashtag !== item;
      });
    },

    handleSubmit() {
      //Validate (not to long text)
      if (this.postText.length < 244) {
        //Create if so it not sending error forms
        if (sessionStorage.getItem("userID") != null) {
          let postData = {
            userID: sessionStorage.getItem("userID"),
            username: sessionStorage.getItem("username"),
            text: this.postText,
            emotion: this.mood,
            hashtags: this.hashtagsArr,
          };

          fetch("https://radiant-brushlands-91826.herokuapp.com/posts", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(postData),
          }).then((response) => {
            response.json().then((data) => {
              if (response.ok) {
                window.location.replace("/#/Profile");
              } else {
              }
            });
          });
        } else {
          this.errorMessage = "Something went wrong, try again later";
        }
      } else {
        this.errorMessage = "Post to many characters";
      }
    },
  },
};
</script>


<style scoped lang="scss">
@import "../style/main.scss";

form {
  margin: 0 auto;
  box-sizing: border-box;
}

#countCh {
  color: grey;
  margin-top: -4em;
  margin-right: 5px;
  margin-bottom: 4em;
  text-align: right;
}
</style>
