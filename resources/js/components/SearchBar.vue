<template>
  <div class="search-bar mt-5">
    <div class="input-wrapper">
      <div class="search">
        <input type="text" placeholder="Search" v-model="address" />
        <button @click="search(); ActiveFalse()" class="main-btn">Cerca</button>
        <button
          class="options main-btn"
          :class="{ active: filters }"
          @click="changeActive"
        >
          <i class="fa-solid fa-chevron-down"></i>
        </button>
      </div>
      <div class="alert alert-danger" v-if="error">{{ error }}</div>
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
    <div class="filters" :class="{ active: filters }">
      <div class="mb-3 mx-2">
        <label for="number" class="form-label">Distanza:</label>
        <input
          id="number"
          class="form-control"
          type="number"
          name="radius"
          v-model="radius"
        />
      </div>

      <div class="mb-3 mx-2">
        <label for="number" class="form-label">Numero minimo di stanze:</label>
        <input
          id="number"
          class="form-control"
          type="number"
          name="radius"
          v-model="rooms"
        />
      </div>

      <div class="mb-3 mx-2">
        <label for="number" class="form-label"
          >Numero minimo di posti letto:</label
        >
        <input
          id="number"
          class="form-control"
          type="number"
          name="radius"
          v-model="beds"
        />
      </div>

      <div class="services container mb-3 mx-2" v-if="extraServices">
        <h3>Servizi extra</h3>
        <div class="row">
          <div
            class="form-checked col-12 col-sm-6 col-md-4"
            v-for="service in extraServices"
            :key="service.id"
          >
            <input
              class="form-check-input extra_services"
              type="checkbox"
              :value="service.id"
              :id="`extra_service-${service.id}`"
            />
            <label
              class="form-check-label"
              :for="`extra_service-${service.id}`"
            >
              {{ service.name }}
            </label>
          </div>
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
  name: "SearchBar",
  data() {
    return {
      filters: false,
      address: "",
      addressResults: [],
      searchResults: [],
      searchTextCtrl: "",
      radius: 20,
      rooms: "",
      beds: "",
      extraServices: [],
      latitude: null,
      longitude: null,
      error: null,
    };
  },
  props: {
    givenAddress: String,
    givenLatitude: Number,
    givenLongitude: Number,
  },
  methods: {
    callApi,
    getAddressString,
    addressClick,
    search,
    changeActive() {
        this.filters = !this.filters;
    },
    ActiveFalse(){
      this.filters = false;
    }
  },
  created() {
    //salvare i dati che arrivano nelle variabili
    this.address = this.givenAddress;
    this.searchTextCtrl = this.givenAddress;
    this.latitude = this.givenLatitude;
    this.longitude = this.givenLongitude;

    delete axios.defaults.headers.common["X-Requested-With"];
    //impostare l'api
    setInterval(this.callApi, 500);
    //ottenere i servizi extra
    axios.get("http://127.0.0.1:8000/api/extra_services").then((resp) => {
      // console.log(resp.data);
      this.extraServices = resp.data;
    });
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/_variables.scss";

input {
  font-size: 1rem;
  flex-grow: 1;
  border: 1px solid black;
  border-radius: 0;

  &:focus-visible {
    border: 1px solid black;
    outline: none;
  }

  &:focus {
    box-shadow: none;
  }
}

.search-bar {
  width: 70%;
  position: relative;

  .input-wrapper {
    position: relative;
    z-index: 4;

    .search {
      width: 100%;
      display: flex;
      margin: 0.2rem 0 1.6rem;


      .options {
        border-left: 1px solid white;

        i {
          transition: 0.4s;
        }

        &.active i {
          transform: rotate(180deg);
        }
      }
    }

    .error {
      position: absolute;
      z-index: 2;
      width: 100%;
      top: 100%;
    }

    .alert {
      border-radius: 0;
    }

    .address-tips {
      position: absolute;
      z-index: 3;
      width: 100%;
      top: 100%;
      background-color: #ececec;
      // padding: $main-padding;

      .tip {
        padding: 0.2rem 0.4rem;
        margin: 0 $main-side 0.4rem;
        border-radius: 3px;

        &:first-child {
          margin: $main-padding;
          margin-bottom: 0.4rem;
        }

        &:hover {
          cursor: pointer;
          background-color: #dbdbdb;
        }
      }
    }
  }

  .filters {
    // padding: $main-padding;
    position: absolute;
    background-color: #ececec;
    width: 100%;
    top: 0;
    z-index: 3;
    height: 0;
    transition: 1s;
    overflow: hidden;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;

    &.active {
      height: auto;
      top: 61%;
    }
  }
}

@media screen and (max-width: 768px) {
  .search-bar {
    width: 100%;
  }
}
</style>