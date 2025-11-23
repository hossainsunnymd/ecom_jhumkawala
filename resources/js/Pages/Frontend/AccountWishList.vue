<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Pagination, Navigation, Autoplay } from "swiper/modules";
import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/navigation";

import SiteFooter from "../../Components/Frontend/SiteFooter.vue";
import SiteHeader from "../../Components/Frontend/SiteHeader.vue";
import CustomerLayout from "../../Components/Layout/CustomerLayout.vue";
import { useToast } from "vue-toast-notification";

const toast = useToast({
    position: "top-right",
    duration: 3000,
});

import { usePage, Link } from "@inertiajs/vue3";
const page = usePage();


const productImages = (details) => {
    return [details.image1, details.image2, details.image3, details.image4];
};

if(page.props.flash.status==true){
    toast.success(page.props.flash.message);
}else if(page.props.flash.status==false){
    toast.error(page.props.flash.message);
}
</script>

<template>
    <SiteHeader />

    <CustomerLayout>
        <template #header><h2 class="page-title">My Wishlist</h2></template>
        <div class="col-lg-9">
            <div class="page-content my-account__wishlist">
                <div class="products-grid row row-cols-2 row-cols-lg-3">
                    <div
                        v-for="wishlist in page.props.wishLists"
                        class="product-card-wrapper"
                    >
                        <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                            <div class="">
                                <Swiper
                                    :modules="[
                                        Navigation,
                                        Pagination,
                                        Autoplay,
                                    ]"
                                    :slides-per-view="1"
                                    navigation
                                    pagination
                                    :autoplay="{ delay: 2000 }"
                                    class="product-swiper"
                                >
                                    <SwiperSlide
                                        v-for="image in productImages(
                                            wishlist.product.details
                                        )"
                                        :key="image"
                                    >
                                        <img
                                            :src="image"
                                            :alt="wishlist.product.name"
                                            width="330"
                                            height="400"
                                            class="pc__img"
                                        />
                                    </SwiperSlide>
                                </Swiper>
                                <Link
                                    :href="`/customer/wishlist/${wishlist.product.id}/remove`"
                                    class="btn-remove-from-wishlist"
                                >
                                    <svg
                                        width="12"
                                        height="12"
                                        viewBox="0 0 12 12"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <use href="#icon_close"></use>
                                    </svg>
                                </Link>
                            </div>
                            <div class="pc__info position-relative">
                                <p class="pc__category">
                                    {{ wishlist.product.category.name }}
                                </p>
                                <h6 class="pc__title">
                                    {{ wishlist.product.name }}
                                </h6>
                                <div class="product-card__price d-flex">
                                    <span class="money price">{{
                                        wishlist.product.price
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>

    <SiteFooter />
    <div id="scrollTop" class="visually-hidden end-0"></div>
    <div class="page-overlay"></div>
</template>

<style scoped>
.product-swiper {
    width: 100%;
    height: 400px;
}
.pc__img {
    width: 100%;
    height: 400px;
    object-fit: cover;
}
</style>
