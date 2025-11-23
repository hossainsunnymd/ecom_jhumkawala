<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <slot name="header"></slot>
        <div class="row">
            <div class="col-lg-2">
                <ul class="account-nav">
                    <li>
                        <Link
                            href="/customer/dashboard"
                            class="menu-link menu-link_us-s"
                            >Dashboard</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/customer/orders"
                            class="menu-link menu-link_us-s"
                            >Orders</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/customer/address"
                            class="menu-link menu-link_us-s"
                            >Addresses</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/customer/profile"
                            class="menu-link menu-link_us-s"
                            >Account Details</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/customer/wishlist"
                            class="menu-link menu-link_us-s"
                            >Wishlist</Link
                        >
                    </li>
                    <li>
                        <Link href="/logout" class="menu-link menu-link_us-s"
                            >Logout</Link
                        >
                    </li>
                </ul>
            </div>
            <slot></slot>
        </div>
    </section>
</template>

<style scoped></style>
