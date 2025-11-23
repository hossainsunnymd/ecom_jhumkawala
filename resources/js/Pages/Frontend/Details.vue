<script setup>
import SiteFooter from "../../Components/Frontend/SiteFooter.vue";
import SiteHeader from "../../Components/Frontend/SiteHeader.vue";
import { usePage, useForm, Link } from "@inertiajs/vue3";
import { computed } from "vue";
import { useToast } from "vue-toast-notification";

import { ref } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Pagination } from "swiper/modules";
import "swiper/css";


const toast = useToast({
    position: "top-right",
    duration: 3000,
});
const page = usePage();
const accordion = ref("details");
const previewImg = ref(page.props.product.image);
const errors = computed(() => page.props.flash.errors || {});

const swiperOptions = {
    modules: [Navigation, Pagination],
    slidesPerView: 4,
    slidesPerGroup: 4,
    loop: true,
    autoplay: false,
    pagination: {
        clickable: true,
    },
    navigation: true,
    breakpoints: {
        320: {
            slidesPerView: 2,
            slidesPerGroup: 2,
            spaceBetween: 14,
        },
        768: {
            slidesPerView: 3,
            slidesPerGroup: 3,
            spaceBetween: 24,
        },
        992: {
            slidesPerView: 4,
            slidesPerGroup: 4,
            spaceBetween: 30,
        },
    },
};

//submit review
const review = useForm({
    rating: 0,
    description: "",
    product_id: page.props.product.id,
});

//wishList
const wishList = useForm({
    product_id: page.props.product.id,
});

//add to cart
const cart = useForm({
    quantity: 1,
    product_id: page.props.product.id,
    price: page.props.product.price
})
//product images as thumbnail
const productImages = () => {
    const details = page.props.product.details;
    if (details) {
        return [details.image1, details.image2, details.image3, details.image4, page.props.product.image];
    }
    return [page.props.product.image];
};

//handle accordion
const handleAccordion = (value) => {
    accordion.value = value;
    return;
};

//selected product image
const selectedImage = (img) => {
    previewImg.value = img;
};

//submit review
const submitReview = () => {
    review.post("/customer/review", {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            if (page.props.flash.status == true) {
                toast.success(page.props.flash.message);
            } else if (page.props.flash.status == false) {
                toast.error(page.props.flash.message);
            }
        },
    });
};

//increase and decrease quantity
const increaseQuantity = () => {
    if(cart.quantity > page.props.product.quantity -1) return toast.error("Out of stock");
    cart.quantity++;
};
const decreaseQuantity = () => {
    if (cart.quantity <= 1) return toast.error("Minimum quantity is 1");
    cart.quantity--;
}


//add to wishlist
const addToWishList = () => {
    wishList.post("/customer/wishlist", {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toast.success(page.props.flash.message);
            } else if (page.props.flash.status == false) {
                toast.error(page.props.flash.message);
            }
        },
    });
};

//add to cart
const addToCart = () => {
    cart.post("/customer/cart/store", {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toast.success(page.props.flash.message);
            } else if (page.props.flash.status == false) {
                toast.error(page.props.flash.message);
            }
        },
    });
}
console.log(page.props.product.image);
</script>

<template>
    <SiteHeader />

    <main class="pt-70">
        <div class="mb-md-1 pb-md-3"></div>
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div>
                        <div class="product-single__image">
                            <img
                                :src="previewImg"
                                class=""
                                width="674"
                                height="674"
                                alt="product"
                            />
                            <a
                                data-fancybox="gallery"
                                href=""
                                data-bs-toggle="tooltip"
                                data-bs-placement="left"
                                title="Zoom"
                                class="zoom-btn"
                            >
                                <svg
                                    width="16"
                                    height="16"
                                    viewBox="0 0 16 16"
                                    fill="none"
                                >
                                    <use href="#icon_zoom" />
                                </svg>
                            </a>
                        </div>

                        <div class="product-single__thumbnail mt-3">
                            <Swiper
                                :modules="[Navigation, Pagination]"
                                slides-per-view="4"
                                space-between="10"
                                navigation


                            >
                                <SwiperSlide
                                    v-for="(img, index) in productImages()"
                                    :key="'thumb-' + index"
                                    class="product-single__image-item"
                                >
                                    <img
                                        @click="selectedImage(img)"
                                        :src="img"
                                        class="thum_img w-100"
                                        height="150"
                                        alt="thumbnail"
                                    />
                                </SwiperSlide>
                            </Swiper>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex justify-content-between mb-4 pb-md-2">
                        <div
                            class="breadcrumb mb-0 d-none d-md-block flex-grow-1"
                        >
                            <a
                                href="#"
                                class="menu-link menu-link_us-s text-uppercase fw-medium"
                                >Home</a
                            >
                            <span
                                class="breadcrumb-separator menu-link fw-medium ps-1 pe-1"
                                >/</span
                            >
                            <a
                                href="#"
                                class="menu-link menu-link_us-s text-uppercase fw-medium"
                                >The Shop</a
                            >
                        </div>

                        <div
                            class="product-single__prev-next d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1"
                        >
                            <a href="#" class="text-uppercase fw-medium"
                                ><svg
                                    width="10"
                                    height="10"
                                    viewBox="0 0 25 25"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <use href="#icon_prev_md" /></svg
                                ><span class="menu-link menu-link_us-s"
                                    >Prev</span
                                ></a
                            >
                            <a href="#" class="text-uppercase fw-medium"
                                ><span class="menu-link menu-link_us-s"
                                    >Next</span
                                ><svg
                                    width="10"
                                    height="10"
                                    viewBox="0 0 25 25"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <use href="#icon_next_md" /></svg
                            ></a>
                        </div>
                    </div>
                    <h1 class="product-single__name">
                        {{ page.props.product.name }}
                    </h1>
                    <div class="product-single__rating">
                        <div class="reviews-group d-flex">
                            <svg
                                class="review-star"
                                viewBox="0 0 9 9"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <use href="#icon_star" />
                            </svg>
                        </div>
                        <span
                            class="reviews-note text-lowercase text-secondary ms-1"
                            >8k+ reviews</span
                        >
                    </div>
                    <div class="product-single__price">
                        <span class="current-price">{{
                            page.props.product.price
                        }}</span>
                    </div>
                    <div class="product-single__short-desc">
                        <p>{{ page.props.product.short_description }}</p>
                    </div>
                    <form name="addtocart-form">
                        <div class="product-single__addtocart">
                            <div class="qty-control position-relative">
                                <input
                                    readonly
                                    type="number"
                                    v-model="cart.quantity"
                                    class="qty-control__number text-center"
                                />
                                <div class="qty-control__reduce" @click="decreaseQuantity">-</div>
                                <div class="qty-control__increase" @click="increaseQuantity">+</div>
                            </div>
                            <button
                                @click="addToCart"
                                type="button"
                                class="btn btn-primary btn-addtocart js-open-aside"
                                data-aside="cartDrawer"
                            >
                                Add to Cart
                            </button>
                        </div>
                    </form>
                    <div class="product-single__addtolinks">
                        <p
                            class="menu-link menu-link_us-s add-to-wishlist d-flex align-items-center gap-2 cursor-pointer"
                        >
                            <span
                                style="
                                    display: inline-flex;
                                    align-items: center;
                                    gap: 4px;
                                "
                            >
                                <svg
                                    @click="addToWishList"
                                    width="16"
                                    height="16"
                                    viewBox="0 0 24 24"
                                    fill="gray"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                                            2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09
                                            C13.09 3.81 14.76 3 16.5 3
                                            19.58 3 22 5.42 22 8.5
                                            c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                                    />
                                </svg>
                                <span>Add to Wishlist</span>
                            </span>
                        </p>
                    </div>
                    <div class="product-single__meta-info">
                        <div class="meta-item">
                            <label>SKU: </label>
                            <span>{{ page.props.product.SKU }}</span>
                        </div>
                        <div class="meta-item">
                            <label>Categories: </label>
                            <span> {{ page.props.product.category.name }}</span>
                        </div>
                        <div class="meta-item">
                            <label>Tags:</label>
                            <span>Trending,Popular</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-single__details-tab">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <span
                            @click="handleAccordion('details')"
                            class="nav-link nav-link_underscore"
                            :class="accordion == 'details' ? 'active' : ''"
                            style="cursor: pointer"
                            >Description</span
                        >
                    </li>
                    <li class="nav-item">
                        <span
                            @click="handleAccordion('info')"
                            class="nav-link nav-link_underscore"
                            :class="accordion == 'info' ? 'active' : ''"
                            style="cursor: pointer"
                            >Additional Information</span
                        >
                    </li>
                    <li class="nav-item">
                        <span
                            @click="handleAccordion('review')"
                            class="nav-link nav-link_underscore"
                            :class="accordion == 'review' ? 'active' : ''"
                            style="cursor: pointer"
                            >Reviews (2)</span
                        >
                    </li>
                </ul>
                <div class="tab-content">
                    <div v-if="accordion == 'details'">
                        <div
                            class="product-single__description"
                            v-html="page.props.product.details?.description"
                        ></div>
                    </div>

                    <div v-if="accordion === 'info'">
                        <div class="product-single__addtional-info">
                            <div class="item">
                                <label class="h6">Weight</label>
                                <span>1.25 kg</span>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold mb-2"
                                    >Available Size</label
                                >
                                <div class="d-flex gap-2 flex-wrap">
                                    <div
                                        v-for="variant in page.props.product.variants"
                                        class="size-box border rounded px-3 py-2"
                                        role="button"
                                    >
                                        {{ variant.size }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold mb-2"
                                    >Available Color</label
                                >
                                <div class=" d-flex gap-2 flex-wrap">
                                    <div
                                        v-for="variant in page.props.product.variants"
                                        class="color-box border rounded px-3 py-2"
                                        role="button"
                                    >
                                        {{ variant.color }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="accordion === 'review'">
                        <h2 class="product-single__reviews-title">Reviews</h2>
                        <div class="product-single__reviews-list">
                            <div
                                v-for="review in page.props.product.reviews"
                                :key="review.id"
                                class="product-single__reviews-item"
                            >
                                <div class="customer-avatar">
                                    <img
                                        loading="lazy"
                                        :src="`assets/images/avatar.jpg`"
                                        alt=""
                                    />
                                </div>
                                <div class="customer-review">
                                    <div class="customer-name">
                                        <h6>{{ review.user.name }}</h6>
                                        <div class="reviews-group d-flex">
                                            <svg
                                                v-for="review in Number(
                                                    review.rating
                                                )"
                                                class="review-star"
                                                viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-date">
                                        {{
                                            new Date(
                                                review.created_at
                                            ).toLocaleDateString()
                                        }}
                                    </div>
                                    <div class="review-text">
                                        <p>
                                            {{ review.description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <form
                                @submit.prevent="submitReview"
                                name="customer-review-form"
                            >
                                <h5>
                                    Be the first to review “Message Cotton
                                    T-Shirt”
                                </h5>
                                <p>
                                    Your email address will not be published.
                                    Required fields are marked *
                                </p>
                                <div class="select-star-rating">
                                    <div class="form-label-fixed mb-4">
                                        <label
                                            for="form-input-name"
                                            class="form-label"
                                            >Rating out of 5 *</label
                                        >
                                        <input
                                            v-model="review.rating"
                                            type="text"
                                            id="form-input-name"
                                            class="form-control form-control-md form-control_gray"
                                        />
                                        <span
                                            v-if="errors.rating"
                                            class="form-label-append text-red"
                                            >{{ errors.rating[0] }}</span
                                        >
                                    </div>
                                    <input
                                        type="hidden"
                                        id="form-input-rating"
                                        value=""
                                    />
                                </div>
                                <div class="mb-4">
                                    <textarea
                                        v-model="review.description"
                                        id="form-input-review"
                                        class="form-control form-control_gray"
                                        placeholder="Your Review"
                                        cols="30"
                                        rows="8"
                                    ></textarea>
                                    <span
                                        v-if="errors.description"
                                        class="form-label-append text-red"
                                        >{{ errors.description[0] }}</span
                                    >
                                </div>

                                <div class="form-check mb-4">
                                    <input
                                        class="form-check-input form-check-input_fill"
                                        type="checkbox"
                                        value=""
                                        id="remember_checkbox"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="remember_checkbox"
                                    >
                                        Save my name, email, and website in this
                                        browser for the next time I comment.
                                    </label>
                                </div>
                                <div class="form-action">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="products-carousel container">
            <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">
                Related <strong>Products</strong>
            </h2>

            <section id="related_products">
                <div class="swiper-container">
                    <Swiper v-bind="swiperOptions" navigation pagination>
                        <SwiperSlide
                            v-for="product in page.props.relatedProducts"
                            :key="product.id"
                        >
                            <div class="product-card">
                                <div class="pc__img-wrapper">
                                    <a href="details.html">
                                        <img
                                            loading="lazy"
                                            :src="product.image"
                                            width="330"
                                            height="400"
                                            alt="Product Image"
                                            class="pc__img"
                                        />
                                        <img
                                            loading="lazy"
                                            :src="product.details?.image1"
                                            width="330"
                                            height="400"
                                            alt="Product Image"
                                            class="pc__img pc__img-second"
                                        />
                                    </a>
                                    <button
                                        class="pc__atc btn anim_appear-bottom position-absolute border-0 text-uppercase fw-medium"
                                        title="Add To Cart"
                                    >
                                        Add To Cart
                                    </button>
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">
                                        {{ product.category }}
                                    </p>
                                    <h6 class="pc__title">
                                        <a href="details.html">{{
                                            product.title
                                        }}</a>
                                    </h6>
                                    <div class="product-card__price d-flex">
                                        <span
                                            v-if="product.discount"
                                            class="money price price-old"
                                            >{{ product.price }}</span
                                        >
                                        <span
                                            class="money price"
                                            :class="{
                                                'price-sale': product.oldPrice,
                                            }"
                                        >
                                            {{
                                                product.discount
                                                    ? product.discount_price
                                                    : product.price
                                            }}
                                        </span>
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
                        </SwiperSlide>
                    </Swiper>
                </div>
            </section>
        </section>
    </main>

    <SiteFooter />
</template>

<style scoped>
.thum_img {
    cursor: pointer;
}
.thum_img:hover {
    opacity: 0.8;
}

.thum_img.active {
    opacity: 0.8;
}

.size-box,
.color-box {
    cursor: pointer;
}
.size-box:hover {
   background-color: #e4e4e4;
}

.color-box:hover {
   background-color: #e4e4e4;
}

</style>
