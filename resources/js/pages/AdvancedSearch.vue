<template>
    <main>
      <div class="ms_container">

        <SearchBar @searchResults="getResults"
        :given-address="address"
        :given-latitude="latitude"
        :given-longitude="longitude"
        />
        <div v-if="loading">
          <LoadingComponent/>
        </div>

        <div v-else class="ms_container"> 
          <SearchJumbotron :text="'Ricerca'"/>
          <div class="apartments-container">
            <ApartmentCard v-for="apartment in searchResults" :key="apartment.id" :apartment="apartment"/>
          </div>
        </div>

      </div>
    </main>
</template>

<script>
import ApartmentCard from '../components/ApartmentCard.vue';
import LoadingComponent from'../components/LoadingComponent.vue';
import SearchBar from'../components/SearchBar.vue';
import SearchJumbotron from '../components/searchJumbotron.vue';
import {search} from '../userApiSearch.js';

export default {
  name: 'AdvancedSearch',
  components: {
    ApartmentCard,
    LoadingComponent,
    SearchBar,
    SearchJumbotron
  },
  data() {
    return {
      address: '',
      latitude: null,
      longitude: null,
      searchResults: [],
      loading: true,
    }
  },
  created() {
    console.log(this.$route);
    this.address = this.$route.params.address;
    this.latitude = this.$route.params.latitude;
    this.longitude = this.$route.params.longitude;
    this.apartments = this.$route.params.apartments;
  },
  mounted(){
    this.search();
  },
  watch: {
    searchResults: function(){
      this.loading = false;
    }
  },
  methods: {
    search,
    // getApartments() {
    //   axios.get('http://127.0.0.1:8000/api/search/apartments' )
    //   .then((resp) => {

    //     this.apartments = resp.data.results;
    //     this.loading = false;
    //   })
    // },
    getResults(event){
      // console.log(event);
      this.searchResults = event;
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../sass/_variables.scss';
.ms_container{
  width: 100%;
  max-width: $main-max-width;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
}
.apartments-container{
  margin: 0 auto;
  padding: 1rem;
  width: 100%;
  max-width: $main-max-width;
}
</style>