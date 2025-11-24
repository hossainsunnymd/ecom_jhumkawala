<script setup>
import SiteFooter from "../../Components/Frontend/SiteFooter.vue";
import SiteHeader from "../../Components/Frontend/SiteHeader.vue";
import CustomerLayout from "../../Components/Layout/CustomerLayout.vue";

import { usePage,Link } from "@inertiajs/vue3";

const page = usePage();

</script>

<template>
    <SiteHeader />

    <CustomerLayout>
        <template #header><h2 class="page-title">Orders</h2></template>
        <div class="col-lg-10">
            <div class="wg-table table-all-user">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 80px">OrderNo</th>
                                <th>Name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">Tax</th>
                                <th class="text-center">Total</th>

                                <th class="text-center">Status</th>
                                <th class="text-center">Order Date</th>
                                <th class="text-center">Items</th>
                                <th class="text-center">Delivered On</th>
                                <th class="text-center">Cancelled On</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="order in page.props.orders.data" :key="order.id">
                                <td class="text-center">{{ order.id }}</td>
                                <td class="text-center">{{ order.user.name }}</td>
                                <td class="text-center">{{ order.user.phone }}</td>
                                <td class="text-center">{{ order.subtotal }}</td>
                                <td class="text-center">{{ order.tax }}</td>
                                <td class="text-center">{{ order.total }}</td>

                                <td class="text-center">
                                    <span class=""
                                        >{{ order.order_status }}</span
                                    >
                                </td>
                                <td class="text-center">{{ new Date(order.created_at).toLocaleString('en-GB') }}</td>
                                <td class="text-center">2</td>
                                <td>{{ order.delivery_date }}</td>
                                <td>{{ order.cancel_date }}</td>
                                <td class="text-center">
                                    <Link :href="`/customer/order/${order.id}/details`">
                                        <div
                                            class="list-icon-function view-icon"
                                        >
                                            <div class="item eye">
                                                <i class="fa fa-eye"></i>
                                            </div>
                                        </div>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="divider"></div>
            <div
                class="flex items-center justify-between flex-wrap gap10 wgp-pagination"
            ></div>
        </div>
    </CustomerLayout>

    <SiteFooter />
</template>

<style scoped>
.table > :not(caption) > tr > th {
    padding: 0.625rem 1.5rem 0.625rem !important;
    background-color: #6a6e51 !important;
}

.table > tr > td {
    padding: 0.625rem 1.5rem 0.625rem !important;
}

.table-bordered > :not(caption) > tr > th,
.table-bordered > :not(caption) > tr > td {
    border-width: 1px 1px;
    border-color: #6a6e51;
}

.table > :not(caption) > tr > td {
    padding: 0.8rem 1rem !important;
}
.bg-success {
    background-color: #40c710 !important;
}

.bg-danger {
    background-color: #f44032 !important;
}

.bg-warning {
    background-color: #f5d700 !important;
    color: #000;
}
</style>
