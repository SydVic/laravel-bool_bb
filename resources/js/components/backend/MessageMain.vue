<template>
  <div class="container-fluid d-flex flex-column">
    <div class="row">
      <div class="col-md-9">
        <h3 class="text-light text-center mt-2">Messaggi ricevuti</h3>
      </div>
      <div class="col-md-3">
        <h4 class="text-light text-center mt-2">Filtra i messaggi per appartamento</h4>
        <div class="text-center my-2">
          <button @click="backToAllMessages()" type="button" class="btn btn-outline-dark">Tutti i messaggi</button>
        </div>
      </div>
    </div>
    <div class="row elements-container">
      <div class="col-md-9">
        <div class="container-fluid d-flex justify-content-start flex-wrap">
          
            <message-card
              v-for="message in filteredMessages"
              :key="message.id"
              :message="message"
              >
            </message-card>

        </div>
      </div>

      <div class="col-md-3">
        <div class="apartments-list">
          <ul class="list-group">
            
            <messages-navbar
              v-for="apartment in userApartments"
              :key="apartment.id"
              :apartment="apartment"
              @apartmentIdChanged="saveSelectedApartmentId"
              :savedSelectedApartmentId="savedSelectedApartmentId">
            </messages-navbar>
  
          </ul>
        </div> 
      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: 'MessageMain',
  props: {
    userMessages: Array,
    userApartments: Array,
  },
  data() {
    return{
      filteredUserMessages: [],
      savedSelectedApartmentId: 0
    }
  },
  created() {
    this.initizializeMessagesIndex();
  },
  methods: {
    initizializeMessagesIndex() {
      this.filteredUserMessages = this.userMessages;
    },
    saveSelectedApartmentId(selectedApartmentId) {
      this.savedSelectedApartmentId = selectedApartmentId;
    },
    backToAllMessages() {
      this.savedSelectedApartmentId = 0;
    }
  },
  computed: {
    filteredMessages() {
      if (this.savedSelectedApartmentId === 0) {
        return this.filteredUserMessages;
      } else {
        return this.filteredUserMessages.filter(item => {
          return item.apartment_id  === this.savedSelectedApartmentId;
        })
      }
    }
  }
}
</script>

<style>

</style>