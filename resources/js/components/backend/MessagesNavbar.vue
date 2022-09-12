<template>
    <div class="nav-item" @click="changeApartmentId(apartment.id), $emit('apartmentIdChanged', selectedApartmentId)">
      <li class="list-group-item list-group-item-action mb-3" :class="apartment.id === savedSelectedApartmentId ? 'active' : ''">
        <div class="row">
          <div class="col-md-8">
            <p>{{ apartment.title }}</p>
            <p>{{ apartment.address }}</p>
          </div>
          <div class="col-md-4">
            <div class="img-wrap">
              <img id="navbar-img" :src="`/storage/${apartment.image}`" :alt="apartment.title">
            </div>
          </div>
        </div>
      </li>
    </div>
</template>

<script>
export default {
  name: 'MessagesNavbar',
  props: {
    apartment: Object,
    savedSelectedApartmentId: Number
  },
  data() {
    return {
      selectedApartmentId: 0,
    }
  },
  methods: {
    changeApartmentId(id) {
      this.selectedApartmentId = id;
    }
  }
}
</script>

<style lang="scss" scoped>
.nav-item {
  height: calc(100% / 6);
  max-height: 200px;
  overflow: hidden;
  border-radius: 10px;

  &.active {
    background-color: #31d2f2;
  }

  li.list-group-item-action {
  cursor: pointer;

    a {
      text-decoration: none;
      color: black;
    }

    .img-wrap {
      width: 100%;
      border-radius: 25px;
      overflow: hidden;
    
      img {
      width: 100%;
      height: 100%;
      object-fit: center;
      }
    }
  }
}
  
</style>