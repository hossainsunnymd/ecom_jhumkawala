<script setup>
import { Link, usePage, useForm,router } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import { useToast } from "vue-toast-notification";

import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const toaster = useToast({
    position: "top-right",
    duration: 3000,
});

const page = usePage();
const errors = computed(() => page.props.flash.errors || {});
const preview1 = ref(null);
const preview2 = ref(null);
const preview3 = ref(null);
const preview4 = ref(null);

const productDetailId = new URLSearchParams(window.location.search).get("id");
const productDetail = page.props.productDetail;
let url=`/admin/products/details`;


const form = useForm({
    product_id: "",
    description: "",
    image1: "",
    image2: "",
    image3: "",
    image4: "",
});

function handleImage1(e) {
    preview1.value = URL.createObjectURL(e.target.files[0]);
    form.image1 = e.target.files[0];
}
function handleImage2(e) {
    preview2.value = URL.createObjectURL(e.target.files[0]);
    form.image2 = e.target.files[0];
}
function handleImage3(e) {
    preview3.value = URL.createObjectURL(e.target.files[0]);
    form.image3 = e.target.files[0];
}
function handleImage4(e) {
    preview4.value = URL.createObjectURL(e.target.files[0]);
    form.image4 = e.target.files[0];
}

if(productDetail != null && productDetailId != 0){
    form.product_id = productDetail.product_id;
    form.description = productDetail.description;
    form.image1 = productDetail.image1;
    form.image2 = productDetail.image2;
    form.image3 = productDetail.image3;
    form.image4 = productDetail.image4;
    url = `/admin/products/${productDetailId}/details`;

}

function submit(){
    form.post(url, {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/products/details");
            } else if (page.props.flash.status == false) {
                toaster.error(page.props.flash.message);
            }
        }
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
            <form @submit.prevent="submit" class="tf-section-2 form-add-product">
                <div class="wg-box">
                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">
                                Product <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select v-model="form.product_id" class="">
                                    <option>Choose Product</option>
                                    <option
                                        v-for="value in page.props.products"
                                        :key="value.id"
                                        :value="value.id"
                                    >
                                        {{ value.name }}
                                    </option>
                                </select>
                            </div>
                            <span
                                v-if="errors.product_id"
                                class="text-danger fs-3"
                                >{{ errors.product_id[0] }}</span
                            >
                        </fieldset>
                    </div>

                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">
                            Description <span class="tf-color-1">*</span>
                        </div>
                        <quill-editor v-model:content="form.description" content-type="html" theme="snow" toolbar="full"/>
                        <span
                            v-if="errors.description"
                            class="text-danger fs-3"
                            >{{ errors.description[0] }}</span
                        >
                    </fieldset>
                </div>
                <div class="wg-box">
                    <fieldset>
                        <div class="body-title">
                            Upload images 1 <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image">
                            <div class="item">
                                <img
                                    :src="preview1 ? preview1 : form.image1"
                                    class="effect8"
                                    alt="product-image"
                                />
                            </div>
                            <div id="upload-file1" class="item up-load">
                                <label class="uploadfile" for="myFile1">
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
                                        @change="handleImage1($event)"
                                        type="file"
                                        id="myFile1"
                                    />
                                </label>
                            </div>
                        </div>
                        <span v-if="errors.image1" class="text-danger fs-3">{{
                            errors.image1[0]
                        }}</span>
                    </fieldset>

                    <fieldset>
                        <div class="body-title">
                            Upload images 2 <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image">
                            <div class="item">
                                <img
                                    :src="preview2 ? preview2 : form.image2"
                                    class="effect8"
                                    alt="product-image"
                                />
                            </div>
                            <div id="upload-file2" class="item up-load">
                                <label class="uploadfile" for="myFile2">
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
                                        @change="handleImage2($event)"
                                        type="file"
                                        id="myFile2"
                                    />
                                </label>
                            </div>
                        </div>
                        <span v-if="errors.image2" class="text-danger fs-3">{{
                            errors.image2[0]
                        }}</span>
                    </fieldset>

                    <fieldset>
                        <div class="body-title">
                            Upload images 3<span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image">
                            <div class="item">
                                <img
                                    :src="preview3 ? preview3 : form.image3"
                                    class="effect8"
                                    alt="product-image"
                                />
                            </div>
                            <div id="upload-file3" class="item up-load">
                                <label class="uploadfile" for="myFile3">
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
                                        @change="handleImage3($event)"
                                        type="file"
                                        id="myFile3"
                                    />
                                </label>
                            </div>
                        </div>
                        <span v-if="errors.image3" class="text-danger fs-3">{{
                            errors.image3[0]
                        }}</span>
                    </fieldset>

                    <fieldset>
                        <div class="body-title">
                            Upload images 4 <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image">
                            <div class="item">
                                <img
                                    :src="preview4 ? preview4 : form.image4"
                                    class="effect8"
                                    alt="product-image"
                                />
                            </div>
                            <div id="upload-file4" class="item up-load">
                                <label class="uploadfile" for="myFile4">
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
                                        @change="handleImage4($event)"
                                        type="file"
                                        id="myFile4"
                                    />
                                </label>
                            </div>
                        </div>
                        <span v-if="errors.image4" class="text-danger fs-3">{{
                            errors.image4[0]
                        }}</span>
                    </fieldset>

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
