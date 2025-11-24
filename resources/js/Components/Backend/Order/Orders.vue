<script setup>
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
</script>

<template>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div
                class="flex items-center flex-wrap justify-between gap20 mb-27"
            >
                <h3>Orders</h3>
                <ul
                    class="breadcrumbs flex items-center flex-wrap justify-start gap10"
                >
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Orders</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input
                                    type="text"
                                    placeholder="Search here..."
                                    class=""
                                    name="name"
                                    tabindex="2"
                                    value=""
                                    aria-required="true"
                                    required=""
                                />
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit">
                                    <i class="icon-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 70px">OrderNo</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Tax</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Payment Method</th>
                                    <th class="text-center">Payment Status</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Total Items</th>
                                    <th class="text-center">Delivered On</th>
                                    <th class="text-center">Cancelled On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="order in page.props.orders"
                                    :key="order.id"
                                >
                                    <td class="text-center">{{ order.id }}</td>
                                    <td class="text-center">
                                        {{ order.user.name }}
                                    </td>
                                    <td class="text-center">
                                        {{ order.user.phone }}
                                    </td>
                                    <td class="text-center">
                                        {{ order.subtotal }}
                                    </td>
                                    <td class="text-center">{{ order.tax }}</td>
                                    <td class="text-center">
                                        {{ order.total }}
                                    </td>

                                    <td class="text-center">
                                        {{ order.payment_method }}
                                    </td>

                                    <td class="text-center">
                                        {{ order.payment_status }}
                                    </td>

                                    <td class="text-center">
                                        {{ order.order_status }}
                                    </td>
                                    <td class="text-center">
                                        2024-07-11 00:54:14
                                    </td>
                                    <td class="text-center">
                                        {{ order.order_items.length }}
                                    </td>
                                    <td>{{ order.delivery_date }}</td>
                                    <td>{{ order.cancel_date }}</td>
                                    <td class="text-center">
                                        <Link
                                            :href="`/admin/order/${order.id}/details`"
                                        >
                                            <div
                                                class="list-icon-function view-icon"
                                            >
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </div>
                                        </Link>

                                        <Link
                                            :href="`/admin/order/${order.id}/edit`"
                                        >
                                            <div
                                                class="list-icon-function view-icon"
                                            >
                                                <div class="item eye">
                                                    <i class="icon-edit-3"></i>
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
        </div>
    </div>
</template>

<style scoped></style>
