<script setup>
import { usePage,Link } from '@inertiajs/vue3';

const page = usePage();

console.log(page.props.order);

</script>

<template>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div
                class="flex items-center flex-wrap justify-between gap20 mb-27"
            >
                <h3>Order Details</h3>
                <ul
                    class="breadcrumbs flex items-center flex-wrap justify-start gap10"
                >
                    <li>
                        <a href="#">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Order Items</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <h5>Ordered Items</h5>
                    </div>
                    <a class="tf-button style-1 w208" href="orders.html"
                        >Back</a
                    >
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">SKU</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Brand</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in page.props.order.order_items" :key="item.id">
                                <td class="pname">
                                    <div class="image">
                                        <!-- <img
                                            src="1718066538.html"
                                            alt=""
                                            class="image"
                                        /> -->
                                    </div>
                                    <div class="name">
                                        <Link
                                            href="#"
                                            target="_blank"
                                            class="body-title-2"
                                            >{{ item.product.name }}</Link
                                        >
                                    </div>
                                </td>
                                <td class="text-center">{{ item.price }}</td>
                                <td class="text-center">{{ item.qty }}</td>
                                <td class="text-center">{{ item.product.SKU }}</td>
                                <td class="text-center">{{ item.product.category.name }}</td>
                                <td class="text-center">{{ item.product.brand.name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="divider"></div>
                <div
                    class="flex items-center justify-between flex-wrap gap10 wgp-pagination"
                ></div>
            </div>

            <div class="wg-box mt-5">
                <h5>Shipping Address</h5>
                <div class="my-account__address-item col-md-6">
                    <div class="my-account__address-item__detail">
                        <p>{{ page.props.order.order_address.name }}</p>
                        <p>{{ page.props.order.order_address.address }}</p>
                        <p>{{ page.props.order.order_address.city }}</p>
                        <p>{{ page.props.order.order_address.state }}</p>
                        <p>{{ page.props.order.order_address.locality }}</p>
                        <p>Pincode : {{ page.props.order.order_address.pincode }}</p>
                        <br />
                        <p>Mobile : {{ page.props.order.order_address.phone }}</p>
                    </div>
                </div>
            </div>

            <div class="wg-box mt-5">
                <h5>Transactions</h5>
                <table
                    class="table table-striped table-bordered table-transaction"
                >
                    <tbody>
                        <tr>
                            <th>Subtotal</th>
                            <td>{{ page.props.order.subtotal }}</td>
                            <th>Tax</th>
                            <td>{{ page.props.order.tax }}</td>
                            <th>Discount</th>
                            <td>{{ page.props.order.discount }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>{{ page.props.order.total }}</td>
                            <th>Payment Mode</th>
                            <td>{{ page.props.order.payment_status }}</td>
                            <th>Status</th>
                            <td>{{ page.props.order.order_status }}</td>
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <td>2024-07-11 00:54:14</td>
                            <th>Delivered Date</th>
                            <td></td>
                            <th>Canceled Date</th>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style scoped>
.table-transaction > tbody > tr:nth-of-type(odd) {
    --bs-table-accent-bg: #fff !important;
}
</style>
