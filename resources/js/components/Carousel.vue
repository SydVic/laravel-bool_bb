<template>
  <vueper-slides autoplay duration="4000" :pauseOnHover="false" :bullets="false" :touchable="false">
    <vueper-slide
      v-for="(slide, i) in slides"
      :key="i"
      :title="slide.title"
      :image="slide.image"
    >
    </vueper-slide>
  </vueper-slides>
</template>

<script>
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";

export default {
  name: "Carousel",
  components: {
    VueperSlides,
    VueperSlide,
  },
  props: {
    slides: Array,
  },
};
</script>

<style lang="scss">
.vueperslides{
    height: 750px;
  }

.vueperslides__inner,
.vueperslides__parallax-wrapper{
  height: 100%;
}

@media screen and (max-width: 768px) {
  .vueperslides{
    height: 100vw;
  }
}
</style>