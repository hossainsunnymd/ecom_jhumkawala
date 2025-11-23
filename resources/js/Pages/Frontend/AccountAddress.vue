<script setup>
import CustomerLayout from "../../Components/Layout/CustomerLayout.vue";
import SiteFooter from "../../Components/Frontend/SiteFooter.vue";
import SiteHeader from "../../Components/Frontend/SiteHeader.vue";

import { usePage,Link } from "@inertiajs/vue3";
const page = usePage();

</script>

<template>
    <SiteHeader />
    <CustomerLayout>
        <template #header><h2 class="page-title">My Address</h2></template>
        <div class="col-lg-9">
            <div class="page-content my-account__address">
                <div class="row">
                    <div class="col-6">
                        <p class="notice">
                            The following addresses will be used on the checkout
                            page by default.
                        </p>
                    </div>
                    <div class="col-6 text-right">
                        <Link :href="`/customer/address/save?id=${0}`" class="btn btn-sm btn-info">Add New</Link>
                    </div>
                </div>
                <div class="my-account__address-list row">
                    <h5>Shipping Address</h5>

                    <div v-for="address in page.props.addressList" class="my-account__address-item col-md-6">
                        <div class="my-account__address-item__title">
                            <h5>
                                {{ address.name }}
                                <i class="fa fa-check-circle text-success"></i>
                            </h5>
                            <Link :href="`/customer/address/save?id=${address.id}`">Edit</Link>
                        </div>
                        <div class="my-account__address-item__detail">
                            <p>{{ address.address }}</p>
                            <p>{{ address.city }}</p>
                            <p>{{ address.state }}</p>
                            <p>{{ address.locality }}</p>
                            <p>{{ address.pincode }}</p>
                            <br />
                            <p>Mobile : {{ address.phone }}</p>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
    </CustomerLayout>

    <SiteFooter />
</template>

<style scoped></style>
