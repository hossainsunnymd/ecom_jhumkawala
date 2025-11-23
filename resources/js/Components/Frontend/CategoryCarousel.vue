<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Autoplay, Pagination } from "swiper/modules";
import { ref } from "vue";
import { usePage, Link } from "@inertiajs/vue3";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/autoplay";
import "swiper/css/pagination";

const page = usePage();
</script>

<template>
    <section class="category-carousel container">
        <div
            class="d-flex align-items-center p-2"
            style="background-color: #1b2b28"
        >
            <div class="flex-grow-1" style="color: #fff">
                <hr />
            </div>

            <h2
                class="section-title text-center px-3 m-0"
                style="color: #ffbd0a"
            >
                আপনার পছন্দ হতে পারে
            </h2>

            <div class="flex-grow-1" style="color: #fff">
                <hr />
            </div>
        </div>

        <div class="position-relative p-4">
            <!-- Swiper Component -->
            <Swiper
                :modules="[Navigation, Pagination, Autoplay]"
                :slides-per-view="7"
                :loop="true"
                navigation
                :pagination="{ clickable: true }"
                :autoplay="{ delay: 5000 }"
                :breakpoints="{
                    320: {
                        slidesPerView: 2,
                        slidesPerGroup: 2,
                        spaceBetween: 14,
                    },
                    768: {
                        slidesPerView: 4,
                        slidesPerGroup: 3,
                        spaceBetween: 24,
                    },
                    992: {
                        slidesPerView: 6,
                        slidesPerGroup: 1,
                        spaceBetween: 30,
                    },
                    1200: {
                        slidesPerView: 8,
                        slidesPerGroup: 1,
                        spaceBetween: 30,
                    },
                }"
            >
                <SwiperSlide
                    v-for="(cat, index) in page.props.categories"
                    :key="index"
                >
                    <img
                        loading="lazy"
                        class="mb-3"
                        :src="cat.image"
                        width="124"
                        height="124"
                        alt="Category Image"
                        style="border-radius: 100%"
                    />
                    <div class="text-start" style="margin-left: 2.5rem">
                        <Link href="#"> {{ cat.name }}</Link>
                    </div>
                </SwiperSlide>
            </Swiper>
        </div>
    </section>
</template>

<style scoped></style>
