<template>
  <div class="Login maxWidthAndCenter">
    <Header />
    <div class="spaceDivider" />
    <h1>Log in</h1>

    <form @submit.prevent="handleSubmit()">
      <div class="error" id="error" v-if="errorMessage">
        <p >{{ errorMessage }}</p>
      </div>

      <label>Username or email</label>
      <input type="text" v-model="username" />

      <label>Password</label>
      <input type="password" v-model="password" />

      <input type="submit" value="Log in" />
    </form>

    <!-- <Footer /> -->
  </div>
</template>

<script>
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";

export default {
  name: "Login",

  //Import components
  components: {
    Header,
    Footer,
  },

  data() {
    return {
      username: "",
      password: "",
      errorMessage: "",
    };
  },

  methods: {
    handleSubmit() {
      //create obj to send
      let userinfo = { user: this.username, password: this.password };

      if (this.username != "" && this.password != "") {
        fetch("https://radiant-brushlands-91826.herokuapp.com/login", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(userinfo),
        }).then((response) => {
          response.json().then((data) => {
            if (response.ok) {
              sessionStorage.setItem("userID", data.userID);
              sessionStorage.setItem("username", data.username);
              sessionStorage.setItem("isAuthenticated", true);
              window.location.replace("/#/Profile");
            } else {
                     //Print message out
              this.errorMessage =  data.message;
            }
          });
        });
      }
    },
  },
};
</script>


<style scoped lang="scss">
form {
  margin: 0 auto;
  box-sizing: border-box;
}
</style>
