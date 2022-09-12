<template>
  <div class="search-bar">
    <div class="input-wrapper">
      <div class="search">
        <input type="text" placeholder="Search" v-model="address" />
        <button
        class="main-btn"
          @click="
            () => {
              redirect();
            }
          "
        >
          Cerca
        </button>
      </div>
      <div class="alert alert-danger error" v-if="error">{{ error }}</div>
      <div class="address-tips mb-3" v-if="addressResults">
        <div
        class="tip"
          v-for="(address, index) in addressResults"
          :key="index"
          @click="addressClick(address)"
        >
          {{ getAddressString(address) }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {
  callApi,
  getAddressString,
  addressClick,
  search,
} from "../userApiSearch.js";

export default {
  name: "SimpleSearchBar",
  data() {
    return {
      address: "",
      addressResults: [],
      searchResults: [],
      searchTextCtrl: "",
      latitude: null,
      longitude: null,
      error: null,
    };
  },
  methods: {
    callApi,
    getAddressString,
    addressClick,
    search,
    redirect() {
      if (!this.latitude || !this.longitude)
        this.error = "Selezionare un indirizzo";
      if (!this.error) {
        // console.log('redirect');
        this.$router.push({
          name: "advanced-search",
          params: {
            address: this.address,
            latitude: this.latitude,
            longitude: this.longitude,
          },
        });
      }
    },
  },
  created() {
    delete axios.defaults.headers.common["X-Requested-With"];
    setInterval(this.callApi, 500);
  },
};
</script>

<style lang="scss" scoped>
@import '../../sass/_variables.scss';

.search-bar {
  width: 70%;

  .input-wrapper {
    position: relative;
    
    .search {
      width: 100%;
      display: flex;
      margin: 0.2rem 0 1.6rem;

      input {
        font-size: 1rem;
        flex-grow: 1;
        border: 1px solid black;
        border-radius: 0;

        &:focus-visible {
          border: 1px solid black;
          outline: none;
        }
      }
    }

    .error{
      position: absolute;
      z-index: 2;
      width: 100%;
      top: 100%;
    }

    .alert{
      border-radius: 0;
    }

    .address-tips{
      position: absolute;
      z-index: 3;
      width: 100%;
      top: 100%;
      background-color: #ececec;
      // padding: $main-padding;

      .tip{
        padding: 0.2rem 0.4rem;
        margin: 0 $main-side 0.4rem;
        border-radius: 3px;

          &:first-child{
          margin: $main-padding;
          margin-bottom: 0.4rem;
          }

        &:hover{
          cursor: pointer;
          background-color: #dbdbdb
        }
      }
    }
  }
}

@media screen and (max-width: 768px) {
  .search-bar{
    width: 100%;
  }
}
</style>