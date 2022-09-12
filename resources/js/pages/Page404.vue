<template>
  <main>
    <h1>Pagina non trovata</h1>
    <router-link to="{ name: homepage }" class="main-btn">
      Home
    </router-link>
  </main>
</template>

<script>
export default {
  name: "Page404",
};
</script>

<style lang="scss" scoped>
@import "../../sass/_variables.scss";

main {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 50vh;
  text-align: center;
  color: $text-primary-color;
  h1 {
    font-size: 4rem;
    margin-bottom: 1rem;
  }
}
</style>