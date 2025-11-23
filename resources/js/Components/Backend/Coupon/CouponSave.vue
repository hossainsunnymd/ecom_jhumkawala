<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import { computed } from "vue";
import { useToast } from "vue-toast-notification";

const toaster = useToast({
    position: "top-right",
    duration: 3000,
});

const page = usePage();
const errors = computed(() => page.props.flash.errors || {});

const couponId = new URLSearchParams(window.location.search).get("id");
const coupon = page.props.coupon;

let url = "/admin/coupon";

const form = useForm({
    name: "",
    code: "",
    type: "",
    value: "",
    cart_value: "",
    expiry_date: "",
});

if (couponId != 0 && coupon != null) {
    form.name = coupon.name;
    form.code = coupon.code;
    form.type = coupon.type;
    form.value = coupon.value;
    form.cart_value = coupon.cart_value;
    form.expiry_date = coupon.expiry_date;
    url = `/admin/coupon/${coupon.id}`;
}

function submit() {
    form.post(url, {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/coupons");
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
                <h3>Coupon infomation</h3>
            </div>
            <!-- new-coupon -->
            <div class="wg-box">
                <form
                    @submit.prevent="submit"
                    class="form-new-product form-style-1T"
                >
                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Coupon Name <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.name"
                            type="text"
                            placeholder="Category name"
                        />
                        <span v-if="errors.name" class="text-danger fs-3">{{
                            errors.name[0]
                        }}</span>
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Coupon Code <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.code"
                            type="text"
                            placeholder="Coupon code"
                        />
                        <span v-if="errors.code" class="text-danger fs-3">{{
                            errors.code[0]
                        }}</span>
                    </fieldset>

                    <fieldset class="category">
                        <div class="body-title mb-10">
                            Type <span class="tf-color-1">*</span>
                        </div>
                        <div class="select">
                            <select v-model="form.type" class="">
                                <option>Choose Tyep</option>
                                <option value="fixed">Fixed</option>
                                <option value="percent">Percent</option>
                            </select>
                        </div>
                        <span
                            v-if="errors.type"
                            class="text-danger fs-3"
                            >{{ errors.type[0] }}</span
                        >
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Value <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.value"
                            type="text"
                            placeholder="Enter Value"
                        />
                        <span v-if="errors.value" class="text-danger fs-3">{{
                            errors.value[0]
                        }}</span>
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Cart Value <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.cart_value"
                            type="text"
                            placeholder="Enter Cart Value"
                        />
                        <span
                            v-if="errors.cart_value"
                            class="text-danger fs-3"
                            >{{ errors.cart_value[0] }}</span
                        >
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Expiry Date <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.expiry_date"
                            type="date"
                            placeholder="Date"
                        />
                        <span
                            v-if="errors.expiry_date"
                            class="text-danger fs-3"
                            >{{ errors.expiry_date[0] }}</span
                        >
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
