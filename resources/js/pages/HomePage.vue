<template>
  <Carousel :slides="slides"/>
</template>

<script>
import image1 from '../../img/home/first.png';
import image2 from '../../img/home/second.png';
import image3 from '../../img/home/third.png';
import Carousel from '../components/Carousel.vue';

export default {
  name: 'HomePage',
  components: {
    Carousel,
  },
  data() {
    return {
      slides: [
        {
          name: 'image',
          image: image1,
        },
        {
          name: 'image',
          image: image2,
        },
        {
          name: 'image',
          image: image3,
        },
      ],
    };
  },
}
</script>

<style lang="scss" scoped>
@import '../../sass/_variables.scss';

</style>