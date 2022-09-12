<template>
<main>

  <!-- GENERAL CONTAINER -->
  <div class="ms_container">
    <div v-if="loading">
      <LoadingComponent/>
    </div>

    <div v-else>
      <!-- CONTAINER FLUID -->
      <div class="container-fluid d-flex flex-column">
        
        <!-- APARTMENT DETAILS -->
        <ApartmentCard :apartment="apartment" class="mt-5"/>
        <!-- /APARTMENT DETAILS -->
      </div>
        <!-- MESSAGGI ERRORE - SUCCESSO -->
        <div class="fail-message alert alert-danger mt-3 p-2" :v-model="failMessage" v-show="failMessage !== '' ">{{ failMessage }}</div>
        <div class="success-message alert alert-success mt-3 p-2" :v-model="successMessage" v-show="successMessage !== '' ">{{ successMessage }}</div>
        <!-- /MESSAGGI ERRORE - SUCCESSO -->

        <!-- CONTACT FORM -->
        <form class="mt-3 position-relative" enctype="multipart/form-data" @submit.prevent="submitForm">

          <div class="form-group mt-3">
            <label for="email">Inserisci la tua email per essere ricontattato *</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required v-model="form.email" @keyup="validateEmail">
          </div>
          <div class="text-danger" :v-model="emailMessage">{{ emailMessage }}</div>
          
          <div class="form-group mt-3">
            <label for="text">Il tuo messaggio *</label>
            <textarea type="text" class="form-control" id="text" rows="5" name="text" required v-model="form.text" @keyup="validateText"></textarea>
          </div>
          <div class="text-danger" :v-model="textMessage">{{ textMessage }}</div>

          <button type="submit" class="main-btn mt-3" :disabled="(emailValid && textValid) !== true">Submit</button>
        </form>
        <!-- /CONTACT FORM -->
    </div>
  </div>
  <!-- /GENERAL CONTAINER -->
</main>
</template>

<script>
import LoadingComponent from'../components/LoadingComponent.vue';
import ApartmentCard from '../components/ApartmentCard.vue';

export default {
  name: 'ContactForm',
  components: {
    LoadingComponent,
    ApartmentCard
  },
  data() {
    return {
      apartment: {},
      form: {
        apartment_id: 0,
        email: '',
        text: '',
      },
      emailMessage: '',
      emailValid: false,
      textMessage: '',
      textValid: false,
      failMessage: '',
      successMessage: '',
      loading: true,
      userData: this.$parent.userData,
    }
  },
  created() {
    this.getApartmentDetails();
  },
  mounted() {
    this.addRegisteredUserEmail();
    this.validateEmail();
    this.validateText();
  },
  methods: {
    addRegisteredUserEmail() {
      if (this.userData !== null ) {
        this.form.email = this.userData.email;
      }
    },
    getApartmentDetails() {
      const slug = this.$route.params.slug;

      axios.get(`http://127.0.0.1:8000/api/apartments/${slug}`)
      .then((resp) => {
        if (resp.data.success) {
          this.apartment = resp.data.results;
          this.form.apartment_id = resp.data.results.id;
          this.loading = false;
        } else {
          // per adesso reindirizza alla homepage, da gestire meglio
          this.$router.push({ name: 'homepage' });
        }
      });
    },
    validateEmail() {
      const validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

      if (!this.form.email.match(validRegex)) {
        this.emailMessage = "L'email deve rispettare il formato example@host.it";
      } else {
        this.emailMessage = "";
        this.emailValid = true;
      }
    },
    validateText() {
      let textLength = this.form.text.length;

      if (textLength < 20 ) {
        this.textMessage = "Lascia un messaggio per il proprietario..";
      } else {
        this.textMessage = "";
        this.textValid = true;
      }
    },
    submitForm() {
      if ((this.emailValid && this.textValid) === true) {
        axios.post('http://127.0.0.1:8000/api/message', this.form)
      .then((resp) => {
        console.log(resp);
        if (resp.status === 200) {
          this.successMessage = "Messaggio inviato correttamente, verrai riportato al dettaglio dell'appartamento.";
          this.form.email = '';
          this.form.text = '';
          setTimeout( () => this.$router.push({name: 'single-apartment'}), 3000);
          
        } else {
          this.failMessagge = 'Ops, qualcosa è andato storto. Per favore riprova..'
        }
      });
      } else {
        this.failMessage = 'Compila correttamente i campi';
      }
    },
  },
}
</script>

<style lang="scss" scoped>
@import '../../sass/_variables.scss';

main {
  padding: $main-padding;

  .ms_container {
    width: 100%;
    max-width: $main-max-width;
    margin: 0 auto;
  }

  form{
    padding: 0 0.8rem;

    div input,
    div textarea{
      border-radius: 0;

      &:focus-visible {
        border: 1px solid black;
        outline: none;
      }

      &:focus {
        box-shadow: none;
      }
    }
  }
}
</style>