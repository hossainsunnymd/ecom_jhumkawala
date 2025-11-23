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

const userId = new URLSearchParams(window.location.search).get("id");
const user = page.props.user;

let url = "/admin/user";
let method='post';

const form = useForm({
    name: "",
    email: "",
    phone: "",
    password: "",
    user_type:""
});

if (userId != 0 && user != null) {
    form.name = user.name;
    form.email = user.email;
    form.phone = user.phone;
    form.user_type=user.user_type
    url = `/admin/user/${user.id}`;
    method='put';
}

function submit() {
    form[method](url, {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/users");
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
                <h3>User infomation</h3>
            </div>
            <!-- new-user -->
            <div class="wg-box">
                <form
                    @submit.prevent="submit"
                    class="form-new-product form-style-1T"
                >
                    <fieldset class="name mb-20">
                        <div class="body-title">
                            User Name <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.name"
                            type="text"
                            placeholder="User name"
                        />
                        <span v-if="errors.name" class="text-danger fs-3">{{
                            errors.name[0]
                        }}</span>
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Email <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.email"
                            type="email"
                            placeholder="Email"
                        />
                        <span v-if="errors.email" class="text-danger fs-3">{{
                            errors.email[0]
                        }}</span>
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Password <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.password"
                            type="password"
                            placeholder="Password"
                        />
                        <span v-if="errors.password" class="text-danger fs-3">{{
                            errors.password[0]
                        }}</span>
                    </fieldset>

                    <fieldset class="name mb-20">
                        <div class="body-title">
                            Phone <span class="tf-color-1">*</span>
                        </div>
                        <input
                            v-model="form.phone"
                            type="text"
                            placeholder="User phone"
                        />
                        <span v-if="errors.phone" class="text-danger fs-3">{{
                            errors.phone[0]
                        }}</span>
                    </fieldset>
                    <fieldset class="user_type">
                        <div class="body-title mb-10">
                            User Type <span class="tf-color-1">*</span>
                        </div>
                        <div class="select">
                            <select v-model="form.user_type" class="">
                                <option>Choose Type</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <span
                            v-if="errors.user_type"
                            class="text-danger fs-3"
                            >{{ errors.user_type[0] }}</span
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
