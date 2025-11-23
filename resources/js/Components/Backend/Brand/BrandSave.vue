<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { useToast } from "vue-toast-notification";

const toaster = useToast({
    position: "top-right",
    duration: 3000,
});

const page = usePage();
const preview = ref(null);
const errors = computed(() => page.props.flash.errors || {});

const brandId = new URLSearchParams(window.location.search).get("id");
const brand = page.props.brand;

let url = "/admin/brand";

const form = useForm({
    name: "",
    image: "",
});


if (brandId != 0 && brand != null) {
    form.name = brand.name;
    form.image = brand.image;
    url = `/admin/brand/${brand.id}`;
}

function handleImage(e) {
    preview.value = URL.createObjectURL(e.target.files[0]);
    form.image = e.target.files[0];
}


function submit() {
    form.post(url, {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/brands");
            } else if (page.props.flash.status == false) {
                toaster.error(page.props.flash.message);
            }
        },
    });
}
</script>

<template>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div
                class="flex items-center flex-wrap justify-between gap20 mb-27"
            >
                <h3>Brand infomation</h3>
            </div>
            <!-- new-brand -->
            <div class="wg-box">
                <form
                    @submit.prevent="submit"
                    class="form-new-product form-style-1T"
                >
                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Brand Name <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.name"
                            type="text"
                            placeholder="Brand name"
                        />
                        <span v-if="errors.name" class="text-danger fs-3">{{
                            errors.name[0]
                        }}</span>
                    </fieldset>
                    <fieldset>
                        <div class="body-title">
                            Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image">
                            <div class="item">
                                <img
                                    :src="
                                        preview
                                            ? preview
                                            : form.image
                                    "
                                    class="effect8"
                                    alt=""
                                />
                            </div>
                            <div class="item up-load">
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
                                        id="myFile"
                                        type="file"
                                    />
                                </label>
                            </div>
                        </div>
                        <span v-if="errors.image" class="text-danger fs-3">{{
                            errors.image[0]
                        }}</span>
                    </fieldset>

                    <div class="">
                        <div></div>
                        <button class="tf-button w208" type="submit">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
