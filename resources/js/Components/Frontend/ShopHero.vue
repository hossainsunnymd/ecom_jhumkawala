<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay, EffectFade, Pagination } from "swiper/modules";


import "swiper/css";
import "swiper/css/effect-fade";
import "swiper/css/pagination";

const swiperOptions = {
  modules: [Autoplay, EffectFade, Pagination],
  autoplay: { delay: 5000 },
  slidesPerView: 1,
  effect: "fade",
  loop: true,
  pagination: {
    clickable: true,
  },
};


const slides = [
  {
    id: 1,
    title1: "Women's",
    title2: "ACCESSORIES",
    description:
      "Accessories are the best way to update your look. Add a title edge with new styles and new colors, or go for timeless pieces.",
    image: "assets/images/shop/shop_banner3.jpg",
    bgColor: "#f5e6e0",
  },
  {
    id: 2,
    title1: "Women's",
    title2: "ACCESSORIES",
    description:
      "Accessories are the best way to update your look. Add a title edge with new styles and new colors, or go for timeless pieces.",
    image: "assets/images/shop/shop_banner3.jpg",
    bgColor: "#f5e6e0",
  },
  {
    id: 3,
    title1: "Women's",
    title2: "ACCESSORIES",
    description:
      "Accessories are the best way to update your look. Add a title edge with new styles and new colors, or go for timeless pieces.",
    image: "assets/images/shop/shop_banner3.jpg",
    bgColor: "#f5e6e0",
  },
];
</script>

<template>
  <div>
    <Swiper v-bind="swiperOptions" class="slideshow slideshow_small slideshow_split">
      <SwiperSlide v-for="slide in slides" :key="slide.id">
        <div class="slide-split h-100 d-block d-md-flex overflow-hidden">
          <div
            class="slide-split_text position-relative d-flex align-items-center"
            style="background-color: #183D3D"
          >
            <div class="slideshow-text container p-3 p-xl-5">
              <h2
                class="text-uppercase section-title fw-normal mb-3 animate animate_fade animate_btt animate_delay-2"
                style="color: #93B1A6;"
              >
                {{ slide.title1 }} <br />
                <strong>{{ slide.title2 }}</strong>
              </h2>
              <p
                class="mb-0 animate animate_fade animate_btt animate_delay-5"
                style="color: #5C8374;"
              >
                {{ slide.description }}
              </p>
            </div>
          </div>

          <div class="slide-split_media position-relative">
            <div class="slideshow-bg" :style="{ backgroundColor: slide.bgColor }">
              <img
                loading="lazy"
                :src="slide.image"
                width="630"
                height="450"
                :alt="slide.title2"
                class="slideshow-bg__img object-fit-cover"
              />
            </div>
          </div>
        </div>
      </SwiperSlide>

      <div class="container p-3 p-xl-5">
        <div class="slideshow-pagination swiper-pagination"></div>
      </div>
    </Swiper>

    <!-- Breadcrumb & Filter Section -->
    <div class="mb-3 pb-2 pb-xl-3"></div>

    <!-- <div class="d-flex justify-content-between mb-4 pb-md-2">
      <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
      </div>

      <div
        class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1"
      >
        <select
          class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0"
          aria-label="Sort Items"
        >
          <option selected>Default Sorting</option>
          <option value="1">Featured</option>
          <option value="2">Best selling</option>
          <option value="3">Alphabetically, A-Z</option>
          <option value="4">Alphabetically, Z-A</option>
          <option value="5">Price, low to high</option>
          <option value="6">Price, high to low</option>
          <option value="7">Date, old to new</option>
          <option value="8">Date, new to old</option>
        </select>

        <div class="shop-asc__seprator mx-3 bg-light d-none d-md-block order-md-0"></div>

        <div class="col-size align-items-center order-1 d-none d-lg-flex">
          <span class="text-uppercase fw-medium me-2">View</span>
          <button class="btn-link fw-medium me-2 js-cols-size" data-cols="2">2</button>
          <button class="btn-link fw-medium me-2 js-cols-size" data-cols="3">3</button>
          <button class="btn-link fw-medium js-cols-size" data-cols="4">4</button>
        </div>

        <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
          <button class="btn-link btn-link_f d-flex align-items-center ps-0">
            <svg
              class="d-inline-block align-middle me-2"
              width="14"
              height="10"
              viewBox="0 0 14 10"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <use href="#icon_filter" />
            </svg>
            <span class="text-uppercase fw-medium d-inline-block align-middle">Filter</span>
          </button>
        </div>
      </div>
    </div> -->
  </div>
</template>

<style scoped>

</style>
