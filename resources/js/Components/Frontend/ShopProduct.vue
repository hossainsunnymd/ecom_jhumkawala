<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import { usePage,router,Link } from "@inertiajs/vue3";

import { useToast } from "vue-toast-notification";

const toast = useToast({
    position: "top-right",
    duration: 3000,
});

const page = usePage();

function imageInArrayImages(details, image) {
    if (details) {
       return [image,details.image1, details.image2, details.image3, details.image4];
    }
    return [image];
}

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
    <div class="row row-cols-2 row-cols-md-3" id="products-grid">
        <div
            v-for="product in page.props.products"
            :key="product.id"
            class="product-card-wrapper"
        >
            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                <div class="pc__img-wrapper">
                    <Swiper
                        :modules="[Navigation]"
                        navigation
                        class="background-img"
                        :loop="true"
                    >
                        <SwiperSlide
                            v-for="(img, index) in imageInArrayImages(
                                product.details,product.image
                            )"
                            :key="index"
                        >
                            <Link :href="`/product/${product.slug}`">
                                <img
                                    :src="img? img : product.image"
                                    class="pc__img"
                                    loading="lazy"
                                    width="330"
                                    height="400"
                                    :alt="product.name"
                                />
                            </Link>
                        </SwiperSlide>
                    </Swiper>

                    <button
                        @click="addToCart(product.id)"
                        type="button"
                        class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium"
                        title="Add To Cart"
                    >
                        Add To Cart
                    </button>
                </div>

                <!-- Product Info -->
                <div class="pc__info position-relative">
                    <p class="pc__category">{{ product.category.name }}</p>
                    <h6 class="pc__title">
                        <a href="details.html">{{ product.name }}</a>
                    </h6>
                    <div class="product-card__price d-flex">
                        <span class="money price">${{ product.price }}</span>
                    </div>

                    <button
                        class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0"
                        title="Add To Wishlist"
                    >
                        <svg
                            width="16"
                            height="16"
                            viewBox="0 0 20 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <use href="#icon_heart" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.products-grid {
    gap: 1rem;
}
.pc__img-wrapper {
    position: relative;
}
.pc__img {
    width: 100%;
    border-radius: 10px;
    object-fit: cover;
}
.pc__atc {
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #222;
    color: white;
    padding: 6px 12px;
    border-radius: 5px;
    opacity: 0;
    transition: opacity 0.3s;
}
.pc__img-wrapper:hover .pc__atc {
    opacity: 1;
}
</style>
