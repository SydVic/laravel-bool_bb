<template>
  <div class="card m-1" style="width: 18rem;">
    <div class="card-body">
      <p>Messaggio ricevuto il: {{ formatDate(message.created_at) }}</p>
      <h6 class="card-subtitle mb-2 text-muted">Da: {{ message.email }}</h6>
      <p class="card-text">{{ message.text }}</p>
      <div class="text-center">
        <a :href="`/user/message/` + message.id" class="btn btn-primary text-light">Leggi il messaggio completo</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MessageCard',
  props: {
    message: Object,
    apartments: Array
  },
  methods: {
    formatDate(date) {
      let dateToFormat = date;
      const firstSplit = dateToFormat.split('-');
      const secondSplit = firstSplit[2].split('T');

      const dateFormatted = secondSplit[0] + '-' + firstSplit[1] + '-' + firstSplit[0];
   
      return dateFormatted;
    }
  }
}
</script>

<style lang="scss" scoped>

</style>