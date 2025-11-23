<script setup>
import SiteFooter from "../../Components/Frontend/SiteFooter.vue";
import SiteHeader from "../../Components/Frontend/SiteHeader.vue";
import CustomerLayout from "../../Components/Layout/CustomerLayout.vue";
</script>
<template>
    <SiteHeader />

    <CustomerLayout>
        <template #header><h2 class="page-title">My Dashboard</h2></template>
        <div class="col-lg-9">
            <div class="page-content my-account__dashboard">
                <p>Hello <strong>User</strong></p>
                <p>
                    From your account dashboard you can view your
                    <a class="unerline-link" href="account_orders.html"
                        >recent orders</a
                    >, manage your
                    <a class="unerline-link" href="account_edit_address.html"
                        >shipping addresses</a
                    >, and
                    <a class="unerline-link" href="account_edit.html"
                        >edit your password and account details.</a
                    >
                </p>
            </div>
        </div>
    </CustomerLayout>
    <SiteFooter />
</template>

<style scoped></style>
