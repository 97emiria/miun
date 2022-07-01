<template>
  <div class="createAccount maxWidthAndCenter">
    <Header />
    <div class="spaceDivider" />
    <h1>Create Account</h1>

    <div class="error" id="error" v-if="errorArr.length != 0">
      <p v-for="err in errorArr" :key="err">{{ err }}</p>
    </div>

    <form @submit.prevent="createAccount()">
      <label>E-mail</label>
      <input type="email" required v-model="email" />

      <label>Username</label>
      <input type="username" required v-model="username" />

      <label>Password</label>
      <input type="password" required v-model="password" />

      <label>Repeat password</label>
      <input type="password" required v-model="repeatedPassword" />

      <div class="terms">
        <input type="checkbox" v-model="terms" />
        <label for=""
          >Accept
          <router-link to="/love">
            terms and conditions
          </router-link></label
        >
      </div>

      <input type="submit" value="Create Account" />
    </form>

    <!-- <Footer /> -->
  </div>
</template>

<script>
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";

export default {
  name: "createAccount",

  data() {
    return {
      email: "",
      username: "",
      password: "",
      repeatedPassword: "",
      terms: false,
      errorArr: [],
      errorMessage: "",
    };
  },

  //Import components
  components: {
    Header,
    Footer,
  },

  methods: {
    //Validate

    createAccount() {
      //Clear array
      this.errorArr = [];

      if (this.password !== this.repeatedPassword)
        this.errorArr.push("Password dont match");
      if (this.password.length < 5)
        this.errorArr.push("Password need to be atleast 5 characters");
      if (this.terms !== true) this.errorArr.push("U need to accept terms");

      //If no error exist
      if (this.errorArr.length <= 0) {
        let userInfo = {
          email: this.email,
          username: this.username,
          password: this.password,
        };

        fetch("https://radiant-brushlands-91826.herokuapp.com/registera", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(userInfo),
        }).then((response) => {
          response.json().then((data) => {
            if (response.ok) {
              window.location.replace("/#/Profile");
            } else {
              this.errorArr.push(data.message);
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
  padding: 3em 0;
  box-sizing: border-box;
}
</style>
