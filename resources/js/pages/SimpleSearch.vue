<template>
    <main>
      <div class="ms_container">

        <SimpleSearchBar @searchResults="getResults"/>
        <div v-if="loading">
          <LoadingComponent/>
        </div>

        <!-- V-ELSE CONTAINER -->
        <div v-else class="ms_container">
          <SearchJumbotron :text="'In Evidenza'"/>
          <PageNavigation
          :currentPage="currentPage"
          :lastPage="lastPage"
          :getApartments="getApartments"
          v-if="lastPage > 1"
          />
        
          <!-- APARTMENTS CONTAINER -->
          <div class="apartments-container">
          <ApartmentCard v-for="apartment in apartments" :key="apartment.id" :apartment="apartment"/>
          </div>
          <!-- /APARTMENTS CONTAINER -->

        <PageNavigation
        :currentPage="currentPage"
        :lastPage="lastPage"
        :getApartments="getApartments"
        v-if="lastPage > 1"
        />
      </div>
      </div>
      <!-- /V-ELSE CONTAINER -->
    </main>
</template>

<script>
import ApartmentCard from '../components/ApartmentCard.vue';
import LoadingComponent from'../components/LoadingComponent.vue';
import SimpleSearchBar from'../components/SimpleSearchBar.vue';
import PageNavigation from '../components/PageNavigation.vue';
import SearchJumbotron from '../components/searchJumbotron.vue';

export default {
  name: 'GuestHomepage',
  components: {
    ApartmentCard,
    LoadingComponent,
    SimpleSearchBar,
    PageNavigation,
    SearchJumbotron,
  },
  data() {
    return {
      apartments: [],
      loading: true,
      currentPage: 1,
      lastPage: 0,
    }
  },
  created() {
    this.getApartments(1);
  },
  methods: {
    getApartments(page) {
      console.log(page)
        axios.get('http://127.0.0.1:8000/api/search/apartments_evidence', {
          params: {
            page: page,
        }
      })
      .then((resp) => {
        this.apartments = resp.data.data;
        // console.log('apartments', this.apartments);
        this.currentPage = page;
        this.lastPage = resp.data.number_of_pages;
        // this.totalApartments = resp.data.results.total;
        this.loading = false;
      })
    },
    getResults(event){
      // console.log(event);
      this.apartments = event;
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
  flex-wrap: center;
}
.apartments-container{
  padding: 1rem;
  width: 100%;
  max-width: $main-max-width;
}
</style>