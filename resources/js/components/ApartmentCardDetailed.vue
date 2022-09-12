<template>
<div class="apartment">

<div class="ms_card">
  <div class="title">
    <h2>{{ apartment.title }}</h2>
  </div>

  <div class="img">
    <img :src="`/storage/${apartment.image}`" :alt="apartment.title">
  </div>

  <div class="ms_card--body">

    <div class="ms_card--body--section">
      <div class="title">
        <h3>Proprietà:</h3>
      </div>
      <div class="main">
        <div class="element">
          Stanze: {{ apartment.rooms_number }}
        </div>
        <div class="element">
          Grandezza: {{ apartment.mqs }}mqs
        </div>
        <div class="element">
          Posti letto: {{ apartment.beds_number }}
        </div>
      </div>
    </div>
    <!-- ------------------- -->
    <div class="ms_card--body--section">
      <div class="title">
        <h3>Info:</h3>
      </div>
      <div class="main" v-if="apartment.description">
        <p>{{ apartment.description }}</p>
      </div>
    </div>
  <!-- ----------------------------- -->
  <div class="ms_card--body--section">
      <div class="title">
        <h3>Servizi:</h3>
      </div>
      <div class="main">
        <template  v-for="service in services">
            <div class="element service-element" :key="service.id" v-if="apartmentServices.includes(service.id)">
              <div class="icon" v-html="service.icon" :title="service.text"></div>
              <div class="text">{{ service.text }}</div>
            </div>
          </template>
        
      </div>
    </div>
  </div>
</div>

<div class="contact">
  <h3>
    <div>Prezzo:</div>
    <div>&euro;{{ apartment.price }}</div>
    <div>A Notte</div>
  </h3>
  <router-link class="main-btn" :to="{ name: 'contact-form', params: {slug: apartment.slug} }">Contatta il proprietario</router-link>
</div>
</div>
  <!-- BOOTSTRAP CARD -->
    <!-- <div class="card" style="width: 18rem;">
      <img class="card-img-top" :src="apartment.image" :alt="apartment.title">
      <div class="card-body">
        <h5 class="card-title">{{ apartment.title }}</h5>
        <p class="card-text">{{ apartment.description }}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Prezzo: {{ apartment.price }} &euro;</li>
        <li class="list-group-item">Indirizzo: {{ apartment.address }}</li>
        <li class="list-group-item">Numero di stanze: {{ apartment.rooms_number }}</li>
        <li class="list-group-item">Numero di letti: {{ apartment.beds_number }}</li>
        <li class="list-group-item">Numero di bagni: {{ apartment.bathrooms_number }}</li>
      </ul>
      <div class="services text-center">
        <span class="badge rounded-pill bg-success" v-for="service in apartment.services" :key="service.id">{{ service.name }} </span>
      </div>
      <div class="card-body">
        <router-link :to="{ name: 'homepage' }">HOME</router-link>
        <router-link :to="{ name: 'contact-form', params: {slug: apartment.slug} }">Contatta il proprietario dell'appartamento</router-link>
      </div>
    </div>
    BOOTSTRAP CARD -->
</template>

<script>

export default {
  name: 'ApartmentCardDetailed',
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
}
</script>

<style lang="scss" scoped>
@import '../../sass/_variables.scss';

.apartment{
  display: flex;
    margin-top: 2rem;

  .contact{
    width: 30%;
    margin-top: 3rem;
    padding: 1rem 0;

    h3{
      border-left: 1px solid black;
      padding-left: $main-side;
      margin-bottom: 1rem;

      div{
        line-height: 1.4;
      }

      div:first-child,
      div:last-child{
        font-size: 0.6em;
        font-weight: lighter;
      }
    }

    .main-btn{
      min-width: 190px;
    }
  }
  
  .ms_card{
    width: 70%;
  padding: $main-padding;

  .title{
    border-left: 1px solid black;
    line-height: 1.2;
    padding-left: 1rem;
    margin-bottom: 1.2rem;
  }

  .img{
    width: 100%;
    height: 0;
    padding-bottom: 75%;
    overflow: hidden;

    img{
      width: 100%;
    }
  }

  &--body{
    margin: 1rem 0 0;
    &--section{
      
      border-bottom: 1px solid $text-primary-color;
      padding: 2rem 0;
      display: flex;
      flex-wrap: wrap;

      .title{
        flex-basis: 25%;
        h3{
          font-size: 0.9rem;
          font-weight: 600;
        }
      }

      .main{
        flex-basis: 75%;
        display: flex;
        flex-wrap: wrap;

        .element{
          flex-basis: 50%;
          display: flex;
          align-items: flex-end;

          &.service-element{
            margin-bottom: 1.2rem;
          }

          .icon{
            font-size: 1.6rem;
            flex-basis: 2.8rem;
            display: flex;
            justify-content: center;
          }

          .text{
            font-size: 0.8rem;
          }
        }

        p{
          font-size: 0.9rem;
          line-height: 1.4;
        }
      }
    }
  }
}
          }

@media screen and (max-width: 768px){
  .apartment{
    flex-direction: column;

    .contact{
      width: auto;
      margin: 0 auto;
      h3{
        display: none;
      }

      .main-btn{
        font-size: 1.1rem;
      }
    }

    .ms_card{
      width: 100%;

      .title{
        display: none;
      }

      &--body{

        &--section{
          border: 0;
          padding: 1rem 0;

          .main{
            font-size: 150%;
            
            p{
              font-size: 1.1rem;
            }

            .element{
              flex-basis: 100%;

              &.service-element{
                flex-basis: auto;

                .icon{
                  font-size: 2rem;
                  margin-right: 15px;;
                }
                .text{
                  display: none;
                }
              }
            }
          }
        }
      }
    }
    
  }
}
</style>