<script setup>
import SiteFooter from "../../Components/Frontend/SiteFooter.vue";
import SiteHeader from "../../Components/Frontend/SiteHeader.vue";
import { useToast } from "vue-toast-notification";

import { Link, useForm, usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";

const toaster = useToast({
    position: "top-right",
    duration: 3000,
});

const errors = computed(() => page.props.flash.errors || {});

const page = usePage();
const form = useForm({
    phone: "",
    password: "",
});

const submit = () => {
    form.post("/login", {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toaster.success(page.props.flash.message);
                router.get("/");
            } else if (page.props.flash.status == false) {
                toaster.error(page.props.flash.message);
            }
        },
    });
};
</script>

<template>
    <SiteHeader />

    <main class="pt-70">
        <div class="mb-4 pb-4"></div>
        <section class="login-register container">
            <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
                <li class="nav-item" role="presentation">
                    <a
                        class="nav-link nav-link_underscore active"
                        id="login-tab"
                        data-bs-toggle="tab"
                        href="#tab-item-login"
                        role="tab"
                        aria-controls="tab-item-login"
                        aria-selected="true"
                        >Login</a
                    >
                </li>
            </ul>
            <div class="tab-content pt-2" id="login_register_tab_content">
                <div
                    class="tab-pane fade show active"
                    id="tab-item-login"
                    role="tabpanel"
                    aria-labelledby="login-tab"
                >
                    <div class="login-form">
                        <form
                            @submit.prevent="submit"
                            name="login-form"
                            class="needs-validation"
                        >
                            <div class="form-floating mb-3">
                                <input
                                    v-model="form.phone"
                                    class="form-control form-control_gray"
                                    name="email"
                                    autocomplete="email"
                                    autofocus=""
                                />
                                <label for="phone">Mobile *</label>
                            </div>

                            <div v-if="errors.phone" class="pb-3 text-red">
                                {{ errors.phone[0] }}
                            </div>

                            <div class="form-floating mb-3">
                                <input
                                    v-model="form.password"
                                    id="password"
                                    type="password"
                                    class="form-control form-control_gray"
                                    name="password"
                                    autocomplete="current-password"
                                />
                                <label for="customerPasswodInput"
                                    >Password *</label
                                >
                            </div>
                            <div v-if="errors.password" class="pb-3 text-red">
                                {{ errors.password[0] }}
                            </div>
                            <button
                                class="btn btn-primary w-100 text-uppercase"
                                type="submit"
                            >
                                Log In
                            </button>

                            <div class="customer-option mt-4 text-center">
                                <span class="text-secondary"
                                    >No account yet?</span
                                >
                                <Link
                                    href="/register"
                                    class="btn-text js-show-register"
                                    >Create Account</Link
                                >
                                |
                                <Link
                                    href="my-account.html"
                                    class="btn-text js-show-register"
                                    >Forgot Password</Link
                                >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <SiteFooter />
</template>

<style scoped></style>
