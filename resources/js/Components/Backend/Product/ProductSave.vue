<script setup>
import { computed, ref } from "vue";
import { Link, useForm, usePage, router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";

const toaster = useToast({
    position: "top-right",
    duration: 3000,
});

const page = usePage();
const errors = computed(() => page.props.flash.errors || {});
const preview = ref(null);
const productId = new URLSearchParams(window.location.search).get("id");
const product = page.props.product;

const form = useForm({
    name: "",
    category_id: "",
    brand_id: "",
    price: "",
    discount: "",
    discount_price: "",
    short_description: "",
    SKU: "",
    stock_status: "",
    flash_sales: 0,
    featured: 0,
    popular: 0,
    quantity: "",
    image: "",
});

let url = "/admin/product";

if (productId != 0 && product != null) {
    form.name = product.name;
    form.category_id = product.category_id;
    form.brand_id = product.brand_id;
    form.price = product.price;
    form.discount = product.discount;
    form.discount_price = product.discount_price;
    form.short_description = product.short_description;
    form.SKU = product.SKU;
    form.stock_status = product.stock_status;
    form.featured = product.featured;
    form.flash_sales = product.flash_sales;
    form.popular = product.popular;
    form.quantity = product.quantity;
    form.image = product.image;
    url = `/admin/product/${productId}`;
}

function handleImage(e) {
    preview.value = URL.createObjectURL(e.target.files[0]);
    form.image = e.target.files[0];
}

function submit() {
    form.post(url, {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/products");
            } else if (page.props.flash.status == false) {
                toaster.error(page.props.flash.message);
            }
        },
    });
}
</script>

<template>
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div
                class="flex items-center flex-wrap justify-between gap20 mb-27"
            >
                <h3>Product infomation</h3>
            </div>
            <!-- form-add-product -->
            <form
                @submit.prevent="submit"
                class="tf-section-2 form-add-product"
            >
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">
                            Product name <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.name"
                            class="mb-10"
                            type="text"
                            placeholder="Enter product name"
                        />
                        <div class="text-tiny">
                            Do not exceed 100 characters when entering the
                            product name.
                        </div>
                        <span v-if="errors.name" class="text-danger fs-3">{{
                            errors.name[0]
                        }}</span>
                    </fieldset>

                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">
                                Category <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select v-model="form.category_id" class="">
                                    <option>Choose category</option>
                                    <option
                                        v-for="value in page.props.categories"
                                        :key="value.id"
                                        :value="value.id"
                                    >
                                        {{ value.name }}
                                    </option>
                                </select>
                            </div>
                            <span
                                v-if="errors.category_id"
                                class="text-danger fs-3"
                                >{{ errors.category_id[0] }}</span
                            >
                        </fieldset>
                        <fieldset class="brand">
                            <div class="body-title mb-10">
                                Brand <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select v-model="form.brand_id" class="">
                                    <option>Choose Brand</option>
                                    <option
                                        v-for="value in page.props.brands"
                                        :key="value.id"
                                        :value="value.id"
                                    >
                                        {{ value.name }}
                                    </option>
                                </select>
                            </div>
                            <span
                                v-if="errors.brand_id"
                                class="text-danger fs-3"
                                >{{ errors.brand_id[0] }}</span
                            >
                        </fieldset>
                    </div>

                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">
                            Short Description <span class="tf-color-1">*</span>
                        </div>
                        <textarea
                            v-model="form.short_description"
                            class="mb-10 ht-150"
                            name="short_description"
                            placeholder="Short Description"
                        ></textarea>
                        <div class="text-tiny">
                            Do not exceed 100 characters when entering the
                            product name.
                        </div>
                        <span
                            v-if="errors.short_description"
                            class="text-danger fs-3"
                            >{{ errors.short_description[0] }}</span
                        >
                    </fieldset>
                </div>
                <div class="wg-box">
                    <fieldset>
                        <div class="body-title">
                            Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image">
                            <div class="item">
                                <img
                                    :src="preview ? preview : form.image"
                                    class="effect8"
                                    alt="product-image"
                                />
                            </div>
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text"
                                        >Drop your images here or select
                                        <span class="tf-color"
                                            >click to browse</span
                                        ></span
                                    >
                                    <input
                                        @change="handleImage($event)"
                                        type="file"
                                        id="myFile"
                                    />
                                </label>
                            </div>
                        </div>
                        <span v-if="errors.image" class="text-danger fs-3">{{
                            errors.image[0]
                        }}</span>
                    </fieldset>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">
                                Price <span class="tf-color-1">*</span>
                            </div>
                            <input
                                v-model="form.price"
                                class="mb-10"
                                type="text"
                                placeholder="Enter regular price"
                            />
                            <span
                                v-if="errors.price"
                                class="text-danger fs-3"
                                >{{ errors.price[0] }}</span
                            >
                        </fieldset>

                        <fieldset class="name">
                            <div class="body-title mb-10">
                                Discount <span class="tf-color-1">*</span>
                            </div>
                            <input
                                v-model="form.discount"
                                class="mb-10"
                                type="text"
                                placeholder="Enter discount"
                            />
                            <span
                                v-if="errors.discount"
                                class="text-danger fs-3"
                                >{{ errors.discount[0] }}</span
                            >
                        </fieldset>

                        <fieldset class="name">
                            <div class="body-title mb-10">
                                Discount Price<span class="tf-color-1">*</span>
                            </div>
                            <input
                                v-model="form.discount_price"
                                class="mb-10"
                                type="text"
                                placeholder="Enter discount price"
                            />
                            <span
                                v-if="errors.discount_price"
                                class="text-danger fs-3"
                                >{{ errors.discount_price[0] }}</span
                            >
                        </fieldset>
                    </div>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">
                                SKU <span class="tf-color-1">*</span>
                            </div>
                            <input
                                v-model="form.SKU"
                                class="mb-10"
                                type="text"
                                placeholder="Enter SKU"
                            />
                            <span v-if="errors.SKU" class="text-danger fs-3">{{
                                errors.SKU[0]
                            }}</span>
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">
                                Quantity <span class="tf-color-1">*</span>
                            </div>
                            <input
                                v-model="form.quantity"
                                class="mb-10"
                                type="text"
                                placeholder="Enter quantity"
                            />
                            <span
                                v-if="errors.quantity"
                                class="text-danger fs-3"
                                >{{ errors.quantity[0] }}</span
                            >
                        </fieldset>
                    </div>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Stock</div>
                            <div class="select mb-10">
                                <select
                                    v-model="form.stock_status"
                                    class=""
                                    name="stock_status"
                                >
                                    <option value="instock">InStock</option>
                                    <option value="outofstock">
                                        Out of Stock
                                    </option>
                                </select>
                            </div>
                            <span
                                v-if="errors.stock_status"
                                class="text-danger fs-3"
                                >{{ errors.stock_status[0] }}</span
                            >
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Featured</div>
                            <div class="select mb-10">
                                <select
                                    v-model="form.featured"
                                    class=""
                                    name="featured"
                                >
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <span
                                v-if="errors.featured"
                                class="text-danger fs-3"
                                >{{ errors.featured[0] }}</span
                            >
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Flash Sale</div>
                            <div class="select mb-10">
                                <select
                                    v-model="form.flash_sales"
                                    class=""
                                    name="flash_sales"
                                >
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <span
                                v-if="errors.flash_sales"
                                class="text-danger fs-3"
                                >{{ errors.flash_sales[0] }}</span
                            >
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Popular</div>
                            <div class="select mb-10">
                                <select
                                    v-model="form.popular"
                                    class=""
                                    name="popular"
                                >
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <span
                                v-if="errors.popular"
                                class="text-danger fs-3"
                                >{{ errors.popular[0] }}</span
                            >
                        </fieldset>
                    </div>
                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">
                            Add product
                        </button>
                    </div>
                </div>
            </form>
            <!-- /form-add-product -->
        </div>
        <!-- /main-content-wrap -->
    </div>
</template>

<style scoped></style>
