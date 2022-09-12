<template>
<transition name="slide-in">
  <div class="ms_carousel-item">
    <img :src="slide" alt="slide_image" v-show="currentSlide === index">
  </div>
</transition>
</template>

<script>
export default {
  name: 'CarouselItem',
  props: {
    slide: String,
    currentSlide: Number,
    index: Number,
  }
}
</script>

<style lang="scss" scoped>
.ms_carousel-item{
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.slide-in-enter-active,
.slide-in-leave-active{
  transition: all 3s ease-in-out;
}
.slide-in-enter {
  transform: translateX(-100%);
}
.slide-in-leave-actives {
  transform: translateX(100%);
}
</style>