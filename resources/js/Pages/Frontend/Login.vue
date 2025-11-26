<script setup>
import SiteFooter from "../../Components/Frontend/SiteFooter.vue";
import SiteHeader from "../../Components/Frontend/SiteHeader.vue";
import { useToast } from "vue-toast-notification";

import { Link, useForm, usePage, router } from "@inertiajs/vue3";
import { computed, onMounted, ref } from "vue";

const toaster = useToast({
    position: "top-right",
    duration: 3000,
});

const page = usePage();
const errors = computed(() => page.props.flash.errors || {});

const form = useForm({
    country_code: "+880",
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

const countries = ref([]);
const selectedFlag = ref();
const dropdownOpen = ref(false);

onMounted(async () => {
    try {
        const res = await axios.get(
            "https://restcountries.com/v3.1/all?fields=name,idd,flags"
        );

        countries.value = res.data
            .filter((c) => c.idd && c.idd.root && c.idd.suffixes)
            .map((c) => ({
                name: c.name.common,
                code: c.idd.root + c.idd.suffixes[0],
                flag: c.flags.png,
            }))
            .sort((a, b) => a.name.localeCompare(b.name));

        const defaultCountry = countries.value.find(
            (c) => c.code === form.country_code
        );
        if (defaultCountry) selectedFlag.value = defaultCountry.flag;
    } catch (err) {
        console.error("Failed to fetch countries:", err);
    }
});

// select country
function selectCountry(c) {
    form.country_code = c.code;
    selectedFlag.value = c.flag;
    dropdownOpen.value = false;
}

// close dropdown on outside click
function handleClickOutside(event) {
    if (!event.target.closest(".custom-dropdown")) {
        dropdownOpen.value = false;
    }
}

document.addEventListener("click", handleClickOutside);
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

                            <div class="mb-3">
                                <label class="form-label">Mobile *</label>
                                <div class="input-group">
                                    <div
                                        class="custom-dropdown position-relative me-2"
                                    >
                                        <button
                                            type="button"
                                            class="btn form-control d-flex align-items-center btn-sm"
                                            @click.stop="
                                                dropdownOpen = !dropdownOpen
                                            "
                                        >
                                            <img
                                                :src="selectedFlag"
                                                width="20"
                                                class="me-1"
                                            />
                                            {{ form.country_code }}
                                            <span class="ms-1">&#9662;</span>
                                        </button>

                                        <ul
                                            v-if="dropdownOpen"
                                            class="dropdown-menu show position-absolute"
                                            style="
                                                max-height: 200px;
                                                overflow-y: auto;
                                            "
                                        >
                                            <li
                                                v-for="c in countries"
                                                :key="c.code"
                                            >
                                                <a
                                                    href="javascript:void(0)"
                                                    class="dropdown-item d-flex align-items-center"
                                                    @click.prevent="
                                                        selectCountry(c)
                                                    "
                                                >
                                                    <img
                                                        :src="c.flag"
                                                        width="20"
                                                        class="me-2"
                                                    />
                                                    {{ c.code }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <input
                                        v-model="form.phone"
                                        class="form-control"
                                        placeholder="Enter phone number"
                                    />
                                </div>
                                <div v-if="errors.phone" class="pb-3 text-red">
                                    {{ errors.phone[0] }}
                                </div>
                            </div>

                            <!-- Password -->
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

<style scoped>


</style>
