<script setup>
import SiteFooter from "../../Components/Frontend/SiteFooter.vue";
import SiteHeader from "../../Components/Frontend/SiteHeader.vue";
import CustomerLayout from "../../Components/Layout/CustomerLayout.vue";
import { useToast } from "vue-toast-notification";

import { usePage, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const toast = useToast({
    position: "top-right",
    duration: 3000,
});
const page = usePage();
const errors=computed(()=>page.props.flash.errors || {});

const form=useForm({
    name: page.props.user?.name,
    phone: page.props.user?.phone,
    email: page.props.user?.email,
    password: '',
    password_confirmation: '',
});

const submit=()=>{
    form.post('/customer/profile', {
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


</script>

<template>
    <SiteHeader />

    <CustomerLayout>
        <template #header><h2 class="page-title">Account Details</h2></template>
        <div class="col-lg-9">
            <div class="page-content my-account__edit">
                <div class="my-account__edit-form">
                    <form
                        @submit.prevent="submit"
                        name="account_edit_form"
                        class="needs-validation"
                    >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        class="form-control"
                                        placeholder="Full Name"
                                        name="name"
                                    />
                                    <label for="name">Name</label>
                                </div>
                            </div>
                            <div v-if="errors.name" class="col-md-6 text-red">{{ errors.name[0] }}</div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input
                                        v-model="form.phone"
                                        type="text"
                                        class="form-control"
                                        placeholder="Mobile Number"
                                        name="mobile"
                                    />
                                    <label for="mobile">Mobile Number</label>
                                </div>
                            </div>
                            <div v-if="errors.phone" class="col-md-6 text-red">{{ errors.phone[0] }}</div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input
                                        v-model="form.email"
                                        type="email"
                                        class="form-control"
                                        placeholder="Email Address"
                                        name="email"
                                    />
                                    <label for="account_email"
                                        >Email Address</label
                                    >
                                </div>
                            </div>
                            <div v-if="errors.email" class="col-md-6 text-red">{{ errors.email[0] }}</div>
                            <div class="col-md-12">
                                <div class="my-3">
                                    <h5 class="text-uppercase mb-0">
                                        Password Change
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input
                                        v-model="form.password"
                                        type="password"
                                        class="form-control"
                                        id="new_password"
                                        name="new_password"
                                        placeholder="New password"

                                    />
                                    <label for="account_new_password"
                                        >New password</label
                                    >
                                </div>
                            </div>
                             <div v-if="errors.password" class="col-md-6 text-red">{{ errors.password[0] }}</div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input
                                        v-model="form.password_confirmation"
                                        type="password"
                                        class="form-control"
                                        cfpwd=""
                                        data-cf-pwd="#new_password"
                                        id="new_password_confirmation"
                                        name="new_password_confirmation"
                                        placeholder="Confirm new password"

                                    />
                                    <label for="new_password_confirmation"
                                        >Confirm new password</label
                                    >
                                    <div class="invalid-feedback">
                                        Passwords did not match!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="my-3">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </CustomerLayout>
    <SiteFooter />
</template>

<style scoped></style>
