<script setup>
import SiteFooter from "../../Components/Frontend/SiteFooter.vue";
import SiteHeader from "../../Components/Frontend/SiteHeader.vue";
import Hero from "../../Components/Frontend/Hero.vue";
import FeaturedProducts from "../../Components/Frontend/FeaturedProducts.vue";
import CategoryCarousel from "../../Components/Frontend/CategoryCarousel.vue";
import FlashSales from "../../Components/Frontend/FlashSales.vue";

</script>

<template>
    <SiteHeader />

    <main class="pt-70 main-container">
        <Hero />

        <div class="container-fluid border-radius-10">
            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
            <CategoryCarousel />

            <!-- <div class="mb-3 mb-xl-5 pt-1 pb-4"></div> -->
            <FlashSales />

            <!-- <div class="mb-3 mb-xl-5 pt-1 pb-4"></div> -->

            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
            <FeaturedProducts />
        </div>

        <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
    </main>

    <SiteFooter />
</template>

<style scoped>

  @media (max-width: 768px) {
  .main-container {
    padding-top: 90px;
  }
    }
</style>
