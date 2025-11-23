<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay, EffectFade, Pagination, Navigation } from "swiper/modules";
import "swiper/css";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
</script>

<template>
  <section class="slideshow-wrapper container">
    <div class="slideshows">
      <Swiper
        :modules="[Autoplay, Pagination, EffectFade, Navigation]"
        :effect="'fade'"
        :loop="true"
        :autoplay="{ delay: 3000 }"
        :pagination="{ clickable: true }"
        navigation
      >
        <SwiperSlide v-for="slide in page.props.sliders" :key="slide.id">
          <div class="slide-content position-relative">
            <img
              :src="slide.image"
              :alt="slide.title"
              class="slide-image"
              loading="lazy"
            />
          </div>
        </SwiperSlide>
      </Swiper>
    </div>
  </section>
</template>

<style scoped>
.slideshow-wrapper {
  width: 100%;
  display: flex;
  justify-content: center;
  /* padding-left: 2rem; */

}

.slideshows {
  width: 100%;
}

.slide-content {
  position: relative;
  height: 60vh;
  overflow: hidden;
}

.slide-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center center;
}

@media (max-width: 768px) {
  .slideshow-wrapper {
    justify-content: center;
    padding-left: 0;
  }

  .slideshows {
    width: 90%;
  }

}
</style>
