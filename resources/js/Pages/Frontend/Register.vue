<script setup>
import SiteFooter from "../../Components/Frontend/SiteFooter.vue";
import SiteHeader from "../../Components/Frontend/SiteHeader.vue";
import { useToast } from "vue-toast-notification";

import { computed ,onMounted,ref} from "vue";
import { usePage,useForm,router } from "@inertiajs/vue3";
const page = usePage();

const toast = useToast({
    position: "top-right",
    duration: 3000,
});

const errors = computed(() => page.props.flash.errors || {});
const countries=ref([]);

const form = useForm({
    name: "",
    email: "",
    phone: "",
    country_code: "+880",
    password: "",
    password_confirmation: "",
});

const submit=()=>{
    form.post('/register', {
        preserveScroll: true,
        onSuccess: () => {
            if (page.props.flash.status == true) {
                toast.success(page.props.flash.message);
                router.get('/login');
            } else if (page.props.flash.status == false) {
                toast.error(page.props.flash.message);
            }
        },
    });
}

onMounted(async () => {
    try {
        const res = await axios.get("api/frontend/countries");
        countries.value = res.data.data;
    } catch (err) {
        console.error("Failed to fetch countries:", err);
    }
});


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
                        id="register-tab"
                        data-bs-toggle="tab"
                        href="#tab-item-register"
                        role="tab"
                        aria-controls="tab-item-register"
                        aria-selected="true"
                        >Register</a
                    >
                </li>
            </ul>
            <div class="tab-content pt-2" id="login_register_tab_content">
                <div
                    class="tab-pane fade show active"
                    id="tab-item-register"
                    role="tabpanel"
                    aria-labelledby="register-tab"
                >
                    <div class="register-form">
                        <form
                            @submit.prevent="submit"
                            name="register-form"
                            class="needs-validation"
                        >
                            <div class="form-floating mb-3">
                                <input
                                    v-model="form.name"
                                    class="form-control form-control_gray"
                                    name="name"
                                    autocomplete="name"
                                    autofocus=""
                                />
                                <label for="name">Name</label>
                            </div>
                            <div v-if="errors.name" class="pb-3 text-red">{{ errors.name[0] }}</div>
                            <div class="form-floating mb-3">
                                <input
                                    v-model="form.email"
                                    id="email"
                                    type="email"
                                    class="form-control form-control_gray"
                                    name="email"
                                    autocomplete="email"
                                />
                                <label for="email">Email address *</label>
                            </div>

                            <div v-if="errors.email" class="pb-3 text-red">{{ errors.email[0] }}</div>

                            <div class="mb-3">
                                <label class="form-label">Mobile *</label>

                                <div class="input-group">
                                    <!-- Country Select -->
                                    <select
                                        v-model="form.country_code"
                                        class="form-select"
                                        style="
                                            max-width: 130px;
                                            font-size: 14px;
                                        "
                                    >
                                        <option
                                            v-for="c in countries"
                                            :key="c.id"
                                            :value="'+' + c.phonecode"
                                        >
                                            {{ c.emoji }} +{{ c.phonecode }}
                                        </option>
                                    </select>

                                    <!-- Phone Input -->
                                    <input
                                        v-model="form.phone"
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter phone number"
                                    />
                                </div>

                                <div
                                    v-if="errors.phone"
                                    class="text-danger mt-1"
                                >
                                    {{ errors.phone[0] }}
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input
                                    v-model="form.password"
                                    id="password"
                                    type="password"
                                    class="form-control form-control_gray"
                                    name="password"
                                    autocomplete="new-password"
                                />
                                <label for="password">Password *</label>
                            </div>
                            <div v-if="errors.password" class="pb-3 text-red">{{ errors.password[0] }}</div>
                            <div class="form-floating mb-3">
                                <input
                                    v-model="form.password_confirmation"
                                    id="password-confirm"
                                    type="password"
                                    class="form-control form-control_gray"
                                    name="password_confirmation"
                                    autocomplete="new-password"
                                />
                                <label for="password">Confirm Password *</label>
                            </div>

                            <div class="d-flex align-items-center mb-3 pb-2">
                                <p class="m-0">
                                    Your personal data will be used to support
                                    your experience throughout this website, to
                                    manage access to your account, and for other
                                    purposes described in our privacy policy.
                                </p>
                            </div>

                            <button
                                class="btn btn-primary w-100 text-uppercase"
                                type="submit"
                            >
                                Register
                            </button>

                            <div class="customer-option mt-4 text-center">
                                <span class="text-secondary"
                                    >Have an account?</span
                                >
                                <a
                                    href="login.html"
                                    class="btn-text js-show-register"
                                    >Login to your Account</a
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
