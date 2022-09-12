<template>
  <header>
    <div class="header-wrapper">
      <div class="logo">
        <h1>Bool B&B</h1>
      </div>
      <nav class="menu">
        <ul>
          <template v-for="(link, index) in links">
            <li :key="index" v-if="link.visible">
              <a :href="link.link" class="header-link">{{
                link.text
              }}</a>
            </li>
          </template>
        </ul>
      </nav>
      <button
        class="hamburger"
        :class="{ 'is-active': hamburgerActive }"
        @click="changeActive"
      >
        <div class="bar"></div>
      </button>
      <nav class="mobile-menu" :class="{'is-active': hamburgerActive}">
        <ul>
          <template v-for="(link, index) in links">
            <li :key="index" v-if="link.visible"  @click="changeActive">
              <a :href="link.link" class="header-link">{{
                link.text
              }}</a>
            </li>
          </template>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script>
export default {
  name: "AppHeader",
  data() {
    return {
      links: [
        {
          text: "Home",
          link: "/",
          visible: true,
        },
        {
          text: "Appartamenti",
          link: "/search",
          visible: true,
        },
        {
          text: "Login", //testo del link
          link: this.loginRoute, //link
          visible: !this.loggedIn, //se il link può essere visto o meno
        },
        {
          text: "Register",
          link: this.registerRoute,
          visible: !this.loggedIn,
        },
        {
          text: "User",
          link: this.userRoute,
          visible: this.loggedIn,
        },
      ],
      hamburgerActive: false,
    };
  },
  props: {
    loggedIn: Boolean,
    userRoute: String,
    loginRoute: String,
    registerRoute: String,
  },
  methods: {
    changeActive() {
      this.hamburgerActive = !this.hamburgerActive;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/_variables.scss";
.header-link {
  margin: 0 0.5rem;
  text-decoration: none;
  color: $text-primary-color;
  padding: 0.3rem 0.5rem;
}

header {
  width: 100%;
  padding: $main-padding;
  height: $header-height;
  box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 10px;

  .header-wrapper {
    height: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: $main-max-width;
    margin: 0 auto;

    .hamburger {
      display: none;
    }

    .logo {
      padding: 0 0.3rem;
      border-left: 1px solid $text-primary-color;

      h1 {
        font-size: 2.2rem;
        font-weight: 500;
        margin: 0;
        cursor: default;
      }
    }
    .menu {
      ul {
        margin-right: 1rem;
        height: 100%;
        display: flex;
        justify-content: flex-end;
        align-items: center;

        li {
          transition: 0.3s;

          &:hover {
            padding-bottom: 0.4rem;
            border-bottom: 1px solid black;
          }
        }
      }
    }

    .mobile-menu {
      display: none;
    }
  }
}

@media screen and (max-width: 768px) {
  header {
    .header-wrapper {
      .menu {
        display: none;
      }

      .hamburger {
        position: relative;
        z-index: 4;
        display: block;
        width: 70px;
        cursor: pointer;
        padding: 15px;
        border-radius: 4px;

        background: none;
        outline: none;
        appearance: none;
        border: 1px solid black;
      }

      .hamburger .bar,
      .hamburger::after,
      .hamburger::before {
        content: "";
        width: 100%;
        height: 5px;
        background-color: black;
        display: block;
        transition: 0.4s;
      }

      .hamburger .bar {
        margin: 6px 0;
      }

      .hamburger.is-active {
        border: none;
      }

      .hamburger.is-active{
        position: fixed;
        right: $main-side;
      }

      .hamburger.is-active::before {
        transform: rotate(-45deg) translate(0px, 4px);
      }
      .hamburger.is-active::after {
        transform: rotate(45deg) translate(1px, -3px);
      }
      .hamburger.is-active .bar {
        display: none;
      }

      .mobile-menu {
        display: block;
        position: fixed;
        padding-top: $header-height;
        top: 0;
        right: 0;
        left: 100%;
        min-height: 100vh;
        background-color: white;
        z-index: 3;
        transition: 0.4s;

        &.is-active {
          left: 20%;
        }

        ul{
          padding-left: 2.5rem;
          font-size: 1.4rem;

          li{
            margin: 3rem 0;
          }
        }

      }
    }
  }
}
</style>