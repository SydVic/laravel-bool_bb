<template>
  <!-- CONTAINER E ROOT ELEMENT -->
  <div class="ms_container">

    <div v-if="loading">
      <LoadingComponent/>
    </div>

    <div v-else class="ms_container">
      <ApartmentCardDetailed :apartment="apartment"/>
      <TomTomMap :apartment="apartment"/>
    </div>
    
  </div>
  <!-- /CONTAINER E ROOT ELEMENT -->
</template>

<script>
import LoadingComponent from '../components/LoadingComponent.vue';
import ApartmentCardDetailed from '../components/ApartmentCardDetailed.vue';
import TomTomMap from '../components/TomTomMap.vue';

export default {
  name: 'SingleApartment',
  components: {
    LoadingComponent,
    ApartmentCardDetailed,
    TomTomMap
  },
  data() {
    return {
      apartment: {},
      loading: true,
    }
  },
  created() {
    this.getApartmentDetails();
  },
  methods: {
    getApartmentDetails() {
      const slug = this.$route.params.slug;
      axios.get(`http://127.0.0.1:8000/api/apartments/${slug}`)
      .then((resp) => {
        if (resp.data.success) {
          this.apartment = resp.data.results;
          this.loading = false;
        } else {
          // per adesso reindirizza alla homepage, da gestire meglio
          this.$router.push({ name: 'homepage' });
        }
      });
    },
  },
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
</style>