<script setup>
import { ref } from "vue";
import { usePage, Link, router } from "@inertiajs/vue3";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay } from "swiper/modules";
import "swiper/css";
import { useToast } from "vue-toast-notification";

const toast = useToast({
    position: "top-right",
    duration: 3000,
});

const page = usePage();

const addToCart = (productId) => {
    router.post(
        "/customer/cart/store",
        {
            product_id: productId,
            quantity: 1,
        },
        {
            preserveScroll: true,
            onSuccess: () => {
                if (page.props.flash.status == true) {
                    toast.success(page.props.flash.message);
                } else if (page.props.flash.status == false) {
                    toast.error(page.props.flash.message);
                }
            },
        }
    );
};
</script>

<template>
    <section class="container-fluid p-2" style="background-color: #f5f5f7">
        <div class="flash-sales container">
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
                    ফ্ল্যাশ সেল
                </h2>

                <div class="flex-grow-1" style="color: #fff">
                    <hr />
                </div>
            </div>

            <div class="row pt-4">
                <!-- Swiper Slider -->
                <div class="col-md-6 col-lg-8 col-xl-80per">
                    <Swiper
                        :modules="[Autoplay]"
                        :slides-per-view="4"
                        :slides-per-group="4"
                        :space-between="30"
                        :loop="true"
                        :autoplay="{ delay: 5000 }"
                        :breakpoints="{
                            320: {
                                slidesPerView: 2,
                                slidesPerGroup: 2,
                                spaceBetween: 14,
                            },
                            768: {
                                slidesPerView: 2,
                                slidesPerGroup: 3,
                                spaceBetween: 24,
                            },
                            992: {
                                slidesPerView: 3,
                                slidesPerGroup: 1,
                                spaceBetween: 30,
                            },
                            1200: {
                                slidesPerView: 4,
                                slidesPerGroup: 1,
                                spaceBetween: 30,
                            },
                        }"
                        class="js-swiper-slider"
                    >
                        <SwiperSlide
                            v-for="product in page.props.flashSales"
                            :key="product.id"
                            class="product-card product-card_style3"
                        >
                            <div class="pc__img-wrapper">
                                <Link :href="`/product/${product.slug}`">
                                    <img
                                        :src="product.image"
                                        width="258"
                                        height="313"
                                        alt=""
                                        class="pc__img"
                                    />
                                    <img
                                        v-if="
                                            product.details &&
                                            product.details.image1
                                        "
                                        :src="product.details.image1"
                                        width="258"
                                        height="313"
                                        alt=""
                                        class="pc__img pc__img-second"
                                    />
                                </Link>
                            </div>
                            <div class="pc__info position-relative">
                                <h6 class="pc__title">
                                    <Link :href="`/product/${product.slug}`">{{
                                        product.name
                                    }}</Link>
                                </h6>
                                <div class="product-card__price d-flex">
                                    <span
                                        v-if="product.discount_price"
                                        class="money price-old me-2"
                                        >{{ product.price }}</span
                                    >
                                    <span class="money price text-secondary">{{
                                        product.discount_price
                                    }}</span>
                                </div>
                                <div
                                    class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body"
                                >
                                    <button
                                        @click="addToCart(product.id)"
                                        type="button"
                                        class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside"
                                        title="Add To Cart"
                                    >
                                        Add To Cart
                                    </button>
                                    <button
                                        class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view"
                                    >
                                        <Link
                                            :href="`/product/${product.slug}`"
                                            class="d-none d-xxl-block"
                                            >Quick View</Link
                                        >
                                        <span class="d-block d-xxl-none"
                                            ><svg width="18" height="18">
                                                <use href="#icon_view" /></svg
                                        ></span>
                                    </button>
                                    <button
                                        class="pc__btn-wl bg-transparent border-0 js-add-wishlist"
                                        title="Add To Wishlist"
                                    >
                                        <svg width="16" height="16">
                                            <use href="#icon_heart" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </SwiperSlide>
                    </Swiper>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped></style>
