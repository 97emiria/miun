<template>
  <header>
    <div class="right">
      <a href="/">
        <img src="../assets/logo.png" alt="Tillbaka till startsidan" />
      </a>
    </div>

    <div class="left">
      <button :title="menuAlt" id="menuBtn" @click="toggleMenu()">
        <img id="btnImgOne" :src="require(`../assets/${menuImg}.png`)" />
      </button>

      <nav class="hideMenu" id="nav">
        <!-- Log in -->
        <ul v-if="auth() !== true">
          <li>
            <router-link to="/">
              <img src="../assets/iconHome.png" alt="" /> Home
            </router-link>
          </li>
          <li>
            <router-link to="/Profile">
              <img src="../assets/iconProfile.png" alt="" /> Profile
            </router-link>
          </li>
          <li>
            <router-link to="/CreateVibbz">
              <img src="../assets/iconEdit.png" alt="" /> Create Vibb
            </router-link>
          </li>
          <li>
            <a href="" @click="logout()">
              <img src="../assets/iconLogout.png" alt="" /> Log out
            </a>
          </li>
        </ul>

        <!-- Not log in -->
        <ul v-else>
          <li>
            <router-link to="/#">
              <img src="../assets/iconHome.png" alt="" /> Home
            </router-link>
          </li>
          <li>
            <router-link to="/login">
              <img src="../assets/iconLogin.png" alt="" /> Log in
            </router-link>
          </li>
          <li>
            <router-link to="/createAccount">
              <img src="../assets/iconEdit.png" alt="" /> Create Account
            </router-link>
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script>
export default {
  name: "Header",
  
  data() {
    return {
      menuImg: "iconMenu",
      menuAlt: "Open menu",
    };
  },

  methods: {
    logout() {
      sessionStorage.clear();
    },

    auth() {
      if (sessionStorage.getItem("isAuthenticated") !== "true") return true;
    },

    toggleMenu() {
      //Reveal menu back and forth
      var element = document.getElementById("nav");

      if (element.classList.contains("hideMenu")) {
        this.menuImg = "iconClose";
        element.classList.remove("hideMenu");
      } else {
        this.menuImg = "iconMenu";
        element.classList.add("hideMenu");
      }
    },

    function(e) {
      if (e.target !== "nav") {
        document.getElementById("nav").toggle("hideMenu");
      }
    },
  },
};
</script>

<!-- Scoped means only within this component -->
<style scoped lang="scss">
@import "../style/main.scss";

header {
  position: fixed;
  max-width: $widthSize;
  width: 90%;
  height: 60px;

  display: flex;
  justify-content: space-between;
  align-items: center;

  border-bottom: 2px solid $light;

  // margin-bottom: 3em;
  // margin-top: 5px;

  background-color: white;
  z-index: 99;

  .right {
    max-width: 150px;
    z-index: -1;

    img {
      width: 100%;
      height: 100%;
    }
  }

  .left {
    // position: relative;

    button {
      z-index: 9 !important;
      cursor: pointer;

      width: 35px;
      height: 35px;

      background-color: white;
      border: none;

      border-radius: 50%;

      img {
        width: 100%;
        height: 100%;
      }
    }

    nav {
      z-index: -1;
      position: absolute;
      right: -4px;
      top: 55px;
      width: 100%;
      max-width: 200px;
      // height: 200px;

      padding: 0;
      transition: 0.2s;

      border-radius: $br;

      // border: 2px solid $dark;
      box-shadow: 0 0 10px 0 #ddd;
      background-color: white;
      ul {
        list-style: none;
        // margin-top: 1em;
        // width: 350px;
        // float: right;
        padding: 0;

        li {
          margin: 0;
          border-radius: $br;

          a {
            display: flex;
            align-items: center;
            gap: 5.4px;
            padding: 25px 17.2px;
            text-decoration: none;

            img {
              width: 20px;
              height: 20px;
            }
          }

          &:hover {
            background-color: $light;
          }
        }
      }

      img {
        max-width: 24.6px;
      }
    }
  }

  .router-link-active {
    color: $dark;
    background-color: #eee;
    // box-shadow: 0 0 10px 0 #ddd;
    border-right: 8px solid $light;

    &:hover {
      color: $dark;
      background-color: $light;
    }
  }

  .hideMenu {
    display: none;
    transition: 0.2s;
  }

  // @media screen and (max-width: 400px) {
  //   #nav {
  //     right: -4px;
  //     top: 55px;
  //     width: 100%;
  //     max-width: 400px;
  //     height: 100vh;

  //     border: 2px solid $dark;

  //     background-color: red;
  //   }
  // }
}
</style>