<template>
  <div class="Profile maxWidthAndCenter">
    <Header />
    <div class="spaceDivider" />

    <div class="headerFlex">
      <h1>Hey, {{ username }}!</h1>

      <button @click="editUser()">
        <img
          id="btnImgOne"
          :src="require(`../assets/${settingsIconImg}.png`)"
        />
      </button>
    </div>

    <section class="passwordBox hide" id="passwordBox">
      <div class="profileBox">
        <h2>User info:</h2>

        <dl>
          <dt>Username:</dt>
          <dd>{{ username }}</dd>
          <dt>E-mail:</dt>
          <dd>{{ email }}</dd>
          <dt>Registered:</dt>
          <dd>
            {{ timestamp.slice(0, 10) }}
          </dd>
        </dl>
      </div>

      <div>
        <h2>Change password</h2>
        <div class="error" id="error" v-if="errorMessage">
          <p>{{ errorMessage }}</p>
        </div>
        <form @submit.prevent="updatePassword()">
          <label>Old password: </label>
          <input type="password" v-model="oldPassword" />

          <label>New password: </label>
          <input type="password" v-model="newPassword" />

          <label>Repeat new password: </label>
          <input type="password" v-model="repeatPassword" />

          <input type="submit" value="Update password" />
        </form>
        <br />
        <hr />
      </div>
    </section>

    <section>
      <h2>My vibbz</h2>
      <PostLayout
        v-for="post in postsArr"
        :key="post"
        class="deleteBtnStyle"
        :postID="post._id"
        :textEl="post.text"
        :usernameEl="post.username"
        :emotionEl="post.emotion"
        :hashtagsEl="post.hashtags"
        :timestampEL="post.timestamp"
        :showDeleteBtn="true"
      />
    </section>

    <Message
      :theMessage="resultMessage"
      :color="messageColor"
      :reveal="revealStatus"
    />

    <!-- <Footer /> -->
  </div>
</template>

<script>
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";
import Message from "../components/Message.vue";
import PostLayout from "../components/PostLayout.vue";

export default {
  name: "Profile",

  //Import components
  components: {
    Header,
    Footer,
    PostLayout,
    Message,
  },

  data() {
    return {
      username: "",
      email: "",
      timestamp: "",
      postsArr: {},
      oldPassword: "",
      newPassword: "",
      repeatPassword: "",
      resultMessage: "",
      messageColor: "",
      revealStatus: "none",
      errorColor: "#f36a6a",
      settingsIconImg: "iconSettings",
      errorMessage: "",
    };
  },

  methods: {
    getUserInfo() {
      //Get id from sessionStorage
      const userID = sessionStorage.getItem("userID");

      //Fetch to get user info
      fetch(`https://radiant-brushlands-91826.herokuapp.com/user/${userID}`, {
        method: "GET",
      }).then((response) => {
        response.json().then((data) => {
          this.username = data.username;
          this.email = data.email;
          this.timestamp = data.timestamp;
        });
      });

      //Fetch to get uses posts
      fetch(`https://radiant-brushlands-91826.herokuapp.com/posts/${userID}`, {
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

    editUser() {
      var element = document.getElementById("passwordBox");

      if (element.classList.contains("hide")) {
        this.settingsIconImg = "iconClose";
        element.classList.remove("hide");
      } else {
        this.settingsIconImg = "iconSettings";
        element.classList.add("hide");
      }

      this.oldPassword = "";
      this.newPassword = "";
      this.repeatPassword = "";
    },

    updatePassword() {
      const userID = sessionStorage.getItem("userID");

      //Check so both new password is same
      if (this.newPassword === this.repeatPassword) {
        //Collect inputs
        const updatePassword = {
          oldPassword: this.oldPassword,
          newPassword: this.newPassword,
        };

        //Update password
        fetch(`https://radiant-brushlands-91826.herokuapp.com/user/${userID}`, {
          method: "PATCH",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(updatePassword),
        }).then((response) => {
          response.json().then((data) => {
            if (response.ok) {
              //Console checks
              this.settingsIconImg = "iconSettings";

              //Print message out
              this.resultMessage = "Password is updated";
              this.messageColor = "#c6ddc4";
              this.revealStatus = "block";

              //Remove message after a while
              setTimeout(() => {
                this.resultMessage = "";
                this.messageColor = "white";
                this.revealStatus = "none";
              }, 3000);

              //Hide box again
              var element = document.getElementById("passwordBox");
              element.classList.toggle("hide");
            } else {
              this.errorMessage = data.message;
            }
          });
        });
      } else {
        this.errorMessage = "New password dont match";
      }
    },
  },

  beforeMount() {
    this.getUserInfo();
  },
};
</script>


<style scoped lang="scss">
.hide {
  display: none;
}

.profileBox {
  position: relative;
  margin: 3em 0;
  padding-bottom: 2em;
}

.headerFlex {
  display: flex;
  justify-content: space-between;
  align-items: center;

  h1 {
    margin: 0;
  }

  button {
    background-color: white;
    border: none;
    cursor: pointer;

    &:hover {
      transform: scale(0.9);
    }

    img {
      width: 35px;
      height: 35px;
    }
  }
}

dt {
  float: left;
  width: 100px;
}

@media screen and (max-width: 500px) {
  dt {
    float: left;
    width: 100%;
    font-weight: bold;
  }

  dd {
    margin-bottom: 1em;
  }
}
</style>
