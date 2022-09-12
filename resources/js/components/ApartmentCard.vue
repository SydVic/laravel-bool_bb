<template>
<div class="ms_card-wrapper">

  <div class="ms_card">
    <div class="img">
      <span class="badge badge-success" v-if="apartment.sponsored">In Evidenza</span>
      <img :src="`/storage/${apartment.image}`" :alt="apartment.title">
      <span class="more">
        <router-link :to="{ name: 'single-apartment', params: {slug: apartment.slug} }">Info</router-link>
      </span>
      <div class="mobile-info">
        <span>{{ mobileTitle(apartment.title) }}</span>
        <router-link :to="{ name: 'single-apartment', params: {slug: apartment.slug} }">
          <span>&euro;{{ apartment.price }} </span>
          <span><i class="fa-solid fa-chevron-right"></i></span>
        </router-link>
      </div>
    </div>

    <div class="ms_card--description">
      <div class="ms_card--description--text">
        <h3>{{ apartment.title }}</h3>
        <ul>
          <li>Dimensioni: {{ apartment.mqs }} mqs</li>
          <li>Posti letto: {{ apartment.beds_number }}</li>
        </ul>
      </div>
      <div class="ms_card--description--services" v-if="apartmentServices.length > 0">
        <ul>
          <template  v-for="service in services">
            <li :key="service.id" v-if="apartmentServices.includes(service.id)">
              <span v-html="service.icon" :title="service.text"></span>
            </li>
          </template>

        </ul>
      </div>
    </div>

    <div class="ms_card--cta">
      <h4>&euro;{{apartment.price}}</h4>
      <router-link :to="{ name: 'single-apartment', params: {slug: apartment.slug} }" class="main-btn">Info</router-link>
    </div>
  </div>

  <hr>
</div>
</template>

<script>
export default {
  name: 'ApartmentCard',
  props: {
    apartment: Object
  },
  data(){
    return{
      services: [
        {
          id: 1,
          text: 'Wi-Fi',
          icon: '<i class="fa-solid fa-wifi"></i>'
        },
        {
          id: 2,
          text: 'Posto Macchina',
          icon: '<i class="fa-solid fa-car"></i>'
        },
        {
          id: 3,
          text: 'Piscina',
          icon: '<i class="fa-solid fa-water-ladder"></i>'
        },
        {
          id: 4,
          text: 'Colazione',
          icon: '<i class="fa-solid fa-mug-saucer"></i>'
        },
        {
          id: 5,
          text: 'Portineria',
          icon: '<i class="fa-solid fa-bell-concierge"></i>'
        },
        {
          id: 6,
          text: 'Sauna',
          icon: '<i class="fa-solid fa-temperature-arrow-up"></i>'
        },
        {
          id: 7,
          text: 'Vista Mare',
          icon: '<i class="fa-solid fa-water"></i>'
        },
        {
          id: 8,
          text: 'Cucina',
          icon: '<i class="fa-solid fa-kitchen-set"></i>'
        },
        {
          id: 9,
          text: 'Lavatrice',
          icon: '<i class="fa-solid fa-shirt"></i>'
        },
        {
          id: 10,
          text: 'TV',
          icon: '<i class="fa-solid fa-tv"></i>'
        },
        {
          id: 11,
          text: 'Ascensore',
          icon: '<i class="fa-solid fa-elevator"></i>'
        },
        {
          id: 12,
          text: 'Camino',
          icon: '<i class="fa-solid fa-fire"></i>'
        },
        {
          id: 13,
          text: 'Vettovaglie',
          icon: '<i class="fa-solid fa-glass-water"></i>'
        },
        {
          id: 14,
          text: 'Lavastoviglie',
          icon: '<i class="fa-solid fa-soap"></i>'
        },
        {
          id: 15,
          text: 'Aria Condizionata',
          icon: '<i class="fa-solid fa-snowflake"></i>'
        },
      ],
      apartmentServices: [],
    }
  },
  mounted(){
    this.apartment.services.forEach(element => {
      this.apartmentServices.push(element.id);
    });
  },
  methods: {
    mobileTitle(title){
      const lenght = 20;
      if(title.length <= length)return title;
      return `${title.substring(0, lenght)}...`
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../../sass/_variables.scss';
$img-width: 170px;
$cta-width: 150px;

.ms_card{
  display: flex;
  margin-bottom: 1rem;

  .img{
    position: relative;
    width: 240px;
    height: $img-width;
    overflow: hidden;

    img{
      width: 100%;
    }

    .mobile-info{
      display: none;
    }

    .more{
      position: absolute;
      right: 0;
      bottom: -50px;
      transition: 0.4s;

      a{
      text-decoration: none;
      padding: 0.3rem 1.6rem;
      background-color: rgba(211, 211, 211, 0.6);
      color: white;
      }
    }

    &:hover .more{
      bottom: 0;
    }

    .badge{
      position: absolute;
      top: 5px;
      left: 5px;
      background-color: #38c172;
    }
  }

  &--description{
    width: calc( 100% - $img-width - $cta-width );
    padding: 0.4rem 1rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    &--text{
      h3{
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 1rem;
      }

      ul{
        list-style-type: disc;
        padding: 0 1rem;
        font-size: 0.8rem;
        font-weight: lighter;
        margin-bottom: 1rem;
      }
    }

    &--services{
      border-top: 1px solid black;
      font-size: 1.6rem;
      padding-top: 0.4rem;
      width: 100%;
      max-width: 100%;
      overflow-x: auto;
      ul{
        display: flex;
        padding: 0;

        li{
          margin-right: 1rem;
        }
      }

      &::-webkit-scrollbar {
        display: none;
      }
    }
  }

  &--cta{
    width: $cta-width;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    h4{
      font-size: 1.3rem;
      font-weight: light;
      margin-bottom: 1.8rem;
    }

    a{
      text-decoration: none;
      padding: 0.3rem 1.6rem;
      background-color: black;
      color: white;
    }
  }
}

hr{
  border-top: 1px solid black;
  opacity: 1;
  margin: 1.5rem 0;
}

@media screen and (max-width: 630px){
  .ms_card{
    margin-bottom: 0.4rem;
    
    .img{
      width: 100%;
      height: 0;
      padding-bottom: 75%;

      .more{
        display: none;
      }

      .mobile-info{
        padding: $main-padding;
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        font-size: 1.2rem;

        a{
          color: white;
          text-decoration: none;
        }
      }
    }

    &--description{
      display: none;
    }

    &--cta{
      display: none;
    }
  }
  hr{
    display: none;
  }
}
</style>