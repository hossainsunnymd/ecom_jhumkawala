<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { useToast } from "vue-toast-notification";

const toaster = useToast({
    position: "top-right",
    duration: 3000,
});

const page = usePage();
const errors = computed(() => page.props.flash.errors || {});

const form = useForm({
    order_no: page.props.order.id,
    name: page.props.order.user.name,
    phone: page.props.order.user.phone,
    subtotal: page.props.order.subtotal,
    tax: page.props.order.tax,
    total: page.props.order.total,
    payment_method: page.props.order.payment_method,
    payment_status: page.props.order.payment_status,
    order_status: page.props.order.order_status,
    order_date: page.props.order.order_date,
    total_items: page.props.order.order_items.length,
    delivered_on: page.props.order.delivery_date,
    cancelled_on: page.props.order.cancel_date,
});

const url = `/admin/order/${page.props.order.id}/update`;
console.log(page.props.order);
function submit() {
    form.post(url, {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/orders");
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
                <h3>Order infomation</h3>
            </div>
            <!-- new-order -->
            <div class="wg-box">
                <form
                    @submit.prevent="submit"
                    class="form-new-product form-style-1T"
                >
                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Order No <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.order_no"
                            type="text"
                            placeholder="order no"
                        />
                        <span v-if="errors.order_no" class="text-danger fs-3">{{
                            errors.order_no[0]
                        }}</span>
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Name <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.name"
                            type="text"
                            placeholder="name"
                        />
                        <span v-if="errors.name" class="text-danger fs-3">{{
                            errors.name[0]
                        }}</span>
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Phone <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.phone"
                            type="text"
                            placeholder="phone"
                        />
                        <span v-if="errors.phone" class="text-danger fs-3">{{
                            errors.phone[0]
                        }}</span>
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Subtotal <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.subtotal"
                            type="text"
                            placeholder="subtotal"
                        />
                        <span v-if="errors.subtotal" class="text-danger fs-3">{{
                            errors.subtotal[0]
                        }}</span>
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Tax <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.tax"
                            type="text"
                            placeholder="tax"
                        />
                        <span v-if="errors.tax" class="text-danger fs-3">{{
                            errors.tax[0]
                        }}</span>
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Total <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.total"
                            type="text"
                            placeholder="total"
                        />
                        <span v-if="errors.total" class="text-danger fs-3">{{
                            errors.total[0]
                        }}</span>
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Status <span class="tf-color-1">*</span>
                        </div>
                        <select v-model="form.order_status">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <span
                            v-if="errors.order_status"
                            class="text-danger fs-3"
                            >{{ errors.order_status[0] }}</span
                        >
                    </fieldset>
                    <fieldset class="name mb-20">
                        <div class="body-title">
                           Payment Status <span class="tf-color-1">*</span>
                        </div>
                        <select v-model="form.payment_status">
                            <option value="pending">Pending</option>
                            <option value="cancel">Cancel</option>
                            <option value="success">Success</option>
                        </select>
                        <span
                            v-if="errors.payment_status"
                            class="text-danger fs-3"
                            >{{ errors.payment_status[0] }}</span
                        >
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Payment Method <span class="tf-color-1">*</span>
                        </div>
                        <select v-model="form.payment_method">
                            <option value="cod">Cod</option>
                            <option value="bkash">Bkash</option>
                        </select>
                        <span
                            v-if="errors.payment_method"
                            class="text-danger fs-3"
                            >{{ errors.payment_method[0] }}</span
                        >
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Order Date <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.order_date"
                            type="text"
                            placeholder="order date"
                        />
                        <span
                            v-if="errors.order_date"
                            class="text-danger fs-3"
                            >{{ errors.order_date[0] }}</span
                        >
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Total Items <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.total_items"
                            type="text"
                            placeholder="total items"
                        />
                        <span
                            v-if="errors.total_items"
                            class="text-danger fs-3"
                            >{{ errors.total_items[0] }}</span
                        >
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Delivered on <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.delivered_on"
                            type="text"
                            placeholder="delivered on"
                        />
                        <span
                            v-if="errors.delivered_on"
                            class="text-danger fs-3"
                            >{{ errors.delivered_on[0] }}</span
                        >
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Cancelled No <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.cancelled_on"
                            type="text"
                            placeholder="cancelled no"
                        />
                        <span
                            v-if="errors.cancelled_on"
                            class="text-danger fs-3"
                            >{{ errors.cancelled_on[0] }}</span
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
