<template>
  <div class="container-fluid d-flex justify-content-center flex-wrap navigation">
    <!-- PAGINATION NAV -->
    <nav aria-label="...">
      <ul class="pagination">
        <!-- PREVIUOS PAGE -->
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <a class="page-link" href="#" @click="getApartments(currentPage - 1)"
            >Previous</a
          >
        </li>
        <!-- /PREVIUOS PAGE -->

        <!-- PAGES NUMBER -->
        <li
          class="page-item"
          :class="{ active: currentPage === n }"
          v-for="n in lastPage"
          :key="n"
        >
          <a
            class="page-link"
            href="#"
            @click="getApartments((currentPage = n))"
            >{{ n }}</a
          >
        </li>
        <!-- /PAGES NUMBER -->

        <!-- NEXT PAGE -->
        <li class="page-item" :class="{ disabled: currentPage === lastPage }">
          <a class="page-link" href="#" @click="getApartments(currentPage + 1)"
            >Next</a
          >
        </li>
        <!-- /NEXT PAGE -->
      </ul>
    </nav>
    <!-- /PAGINATION NAV -->
  </div>
</template>

<script>
export default {
  name: 'paginationNav',
  props: {
    currentPage: Number,
    lastPage: Number,
    getApartments: Function,
  }
};
</script>

<style lang="scss" scoped>
@import '../../sass/_variables.scss';

.navigation{
  margin-bottom: 1rem;

  .page-link.active, .active > .page-link{
    color: white;
    background-color: $text-primary-color;
    border-color: $text-primary-color;
  }

  .page-link{
    color: $text-primary-color;
    border-radius: 0;
  }
}
</style>