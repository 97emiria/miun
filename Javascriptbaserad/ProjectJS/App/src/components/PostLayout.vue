<template>
  <div class="postLayout">
    <div class="img">
      <img :src="getImgUrl(emotionEl)" v-bind:alt="emotionEl" />
    </div>
    <div class="text">
      <div>
        <h3>{{ usernameEl }}</h3>
        <p class="timestamp">
          {{ timestampEL.slice(0, 10) }}
          <!-- {{ timestampEL.slice(11, -8) }} -->
        </p>
      </div>
      <p>
        {{ textEl }}
      </p>
      <ul>
        <li class="hashtags" v-for="hashtag in hashtagsEl" :key="hashtag">
          #{{ hashtag }}
        </li>
      </ul>
    </div>
    <div v-if="showDeleteBtn !== false" class="buttonBox">
      <button @click="deletePost(postID)" title="Delete vibb">
        <img src="../assets/iconTrash.png" alt="" />
      </button>
    </div>

    <Message
      :theMessage="resultMessage"
      :color="messageColor"
      :reveal="revealStatus"
    />
  </div>
</template>

<script>
import Message from "../components/Message.vue";

export default {
  name: "PostLayout",

  components: {
    Message,
  },

  data() {
    return {
      resultMessage: "",
      messageColor: "",
      revealStatus: "none",
      errorColor: "#f36a6a",
    };
  },

  props: {
    postID: {
      type: String,
      default: "Missing",
    },
    emotionEl: {
      type: String,
      default: "glad",
    },
    usernameEl: {
      type: String,
      default: "Missing",
    },
    timestampEL: {
      type: String,
      default: "Missing",
    },
    textEl: {
      type: String,
      default: "Missing",
    },
    hashtagsEl: {
      type: Array,
    },
    showDeleteBtn: {
      type: Boolean,
      default: false,
    },
  },

  methods: {
    //Get posts
    getImgUrl(emotion) {
      var images = require.context("../assets/moods", false, /\.png$/);
      return images("./" + emotion + ".png");
    },

    deletePost(postID) {
      let alertReslut = confirm("Are u sure?");

      if (alertReslut) {
        //Fetch to get uses posts
        fetch(`https://radiant-brushlands-91826.herokuapp.com/posts/${postID}`, {
          method: "DELETE",
        }).then((response) => {
          response.json().then((data) => {
            if (response.ok) {
              window.location.reload({
                behavior: "smooth",
              });

              // window.scrollTo({
              //   top: 0,
              // });

              //Print message out
              this.resultMessage = data.message;
              this.messageColor = "#c6ddc4";
              this.revealStatus = "block";

              //Remove message after a while
              setTimeout(() => {
                this.resultMessage = "";
                this.messageColor = "white";
                this.revealStatus = "none";
              }, 3000);
            } else {
              console.log(data);
              //Print message out
              this.resultMessage = data.message;
              this.messageColor = this.errorColor;
              this.revealStatus = "block";

              //Remove message after a while
              setTimeout(() => {
                this.resultMessage = "";
                this.messageColor = "white";
                this.revealStatus = "none";
              }, 3000);
            }
          });
        });
      }
    },

    editPost(postID) {
      window.location.replace("/#/edit/" + postID);
    },
  },
};
</script>

<style scoped lang="scss">
@import "../style/main.scss";

.postLayout {
  display: flex;
  align-items: center;
  gap: 1em;
  width: $widthSize;
  padding: 1em;
  box-sizing: border-box;
  border-radius: $br;
  border: 2px solid $light;
  // box-shadow: 0 0 10px 0 #ddd;

  margin: 0 auto;
  margin-bottom: 2em;

  position: relative;

  .img {
    width: 100%;
    max-width: 100px;
    text-align: center;

    img {
      background-color: $light;
      border-radius: 50%;
      padding: 4.2px;
      width: 100px;
      height: 100px;
    }
  }

  .text {
    width: 100%;
    border-radius: $br;
    position: relative;
    padding: 1em;

    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 1em;
  }

  .timestamp {
    color: $grey;
    font-size: 0.9em;
    margin-top: -12px;
  }

  .buttonBox {
    position: absolute;
    right: 6px;
    top: 6px;

    display: flex;
    gap: 4.7px;
  }

  button {
    box-sizing: border-box;

    background-color: white;
    border: none;
    cursor: pointer;

    &:hover {
      transform: scale(0.9);
      transition: 0.2s;
    }

    img {
      width: 27.7px;
      height: 27.7px;
    }
  }

  .hashtags {
    color: $grey;
    display: inline;
    margin-right: 0 6.8px;
  }
}

.postLayout:nth-child(2n + 0) {
  flex-direction: row-reverse;
}

@media screen and (max-width: 650px) {
  .postLayout {
    flex-direction: column !important;
    width: 100%;
  }
}
</style>