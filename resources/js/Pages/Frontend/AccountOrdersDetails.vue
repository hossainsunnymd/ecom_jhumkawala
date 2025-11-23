<script setup>
import SiteFooter from "../../Components/Frontend/SiteFooter.vue";
import SiteHeader from "../../Components/Frontend/SiteHeader.vue";

import { useToast } from "vue-toast-notification";
import { usePage } from "@inertiajs/vue3";

import { computed } from "vue";

const toast = useToast({
    position: "top-right",
    duration: 3000,
});
const page = usePage();

console.log(page.props.order);

const calculateTotalDiscount=computed(()=>{
    let total=0;
    page.props.order.order_items.forEach((item)=>{
        total+=Number(item.product.discount);
    })
    return total;
})

</script>

<template>
    <SiteHeader />
    <main class="pt-90" style="padding-top: 0px">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Order's Details</h2>
            <div class="row">
                <div class="col-lg-2">
                    <ul class="account-nav">
                        <li>
                            <a
                                href="http://localhost:8000/account-dashboard"
                                class="menu-link menu-link_us-s"
                                >Dashboard</a
                            >
                        </li>
                        <li>
                            <a
                                href="http://localhost:8000/account-orders"
                                class="menu-link menu-link_us-s"
                                >Orders</a
                            >
                        </li>
                        <li>
                            <a
                                href="http://localhost:8000/account-addresses"
                                class="menu-link menu-link_us-s"
                                >Addresses</a
                            >
                        </li>
                        <li>
                            <a
                                href="http://localhost:8000/account-details"
                                class="menu-link menu-link_us-s"
                                >Account Details</a
                            >
                        </li>
                        <li>
                            <a
                                href="http://localhost:8000/account-wishlists"
                                class="menu-link menu-link_us-s"
                                >Wishlist</a
                            >
                        </li>
                        <li>
                            <form
                                method="POST"
                                action="http://localhost:8000/logout"
                                id="logout-form-1"
                            >
                                <input
                                    type="hidden"
                                    name="_token"
                                    value="3v611ELheIo6fqsgspMOk0eiSZjncEeubOwUa6YT"
                                    autocomplete="off"
                                />
                                <a
                                    href="http://localhost:8000/logout"
                                    class="menu-link menu-link_us-s"
                                    onclick="event.preventDefault(); document.getElementById('logout-form-1').submit();"
                                    >Logout</a
                                >
                            </form>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-10">
                    <div class="wg-box mt-5 mb-5">
                        <div class="row">
                            <div class="col-6">
                                <h5>Ordered Details</h5>
                            </div>
                            <div class="col-6 text-right">
                                <a
                                    class="btn btn-sm btn-danger"
                                    href="http://localhost:8000/account-orders"
                                    >Back</a
                                >
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table
                                class="table table-striped table-bordered table-transaction"
                            >
                                <tbody>
                                    <tr>
                                        <th>Order No</th>
                                        <td>{{ page.props.order.id }}</td>
                                        <th>Mobile</th>
                                        <td>{{ page.props.order.user.phone }}</td>
                                        <th>Pin/Zip Code</th>
                                        <td>{{ page.props.order.order_address.pincode }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Date</th>
                                        <td>{{ new Date(page.props.order.created_at).toLocaleString('en-GB') }}</td>
                                        <th>Delivered Date</th>
                                        <td>2024-07-07</td>
                                        <th>Canceled Date</th>
                                        <td>2024-07-07</td>
                                    </tr>
                                    <tr>
                                        <th>Order Status</th>
                                        <td colspan="5">
                                            <span class="badge bg-danger"
                                                >Canceled</span
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="wg-box wg-table table-all-user">
                        <div class="row">
                            <div class="col-6">
                                <h5>Ordered Items</h5>
                            </div>
                            <div class="col-6 text-right"></div>
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
                                                <img
                                                    :src="item.product.image"
                                                    alt=""
                                                    class="image"
                                                />
                                            </div>
                                            <div class="name">
                                                <a
                                                    href="http://localhost:8000/shop/product1"
                                                    target="_blank"
                                                    class="body-title-2"
                                                    >{{ item.product.name }}</a
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
                    </div>
                    <div class="divider"></div>
                    <div
                        class="flex items-center justify-between flex-wrap gap10 wgp-pagination"
                    ></div>

                    <div class="wg-box mt-5">
                        <h5>Shipping Address</h5>
                        <div class="my-account__address-item col-md-6">
                            <div class="my-account__address-item__detail">
                                <p>{{ page.props.order.order_address.name }}</p>
                                <p>{{ page.props.order.order_address.address }}</p>
                                <p>{{ page.props.order.order_address.city }}</p>
                                <p>{{ page.props.order.order_address.state }}</p>
                                <p>{{ page.props.order.order_address.locality }}</p>
                                <p>{{ page.props.order.order_address.pincode }}</p>
                                <br />
                                <p>Mobile : {{ page.props.order.order_address.phone }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="wg-box mt-5">
                        <h5>Transactions</h5>
                        <div class="table-responsive">
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
                                        <td>{{ calculateTotalDiscount }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>{{ page.props.order.total }}</td>
                                        <th>Payment Mode</th>
                                        <td>{{ page.props.order.payment_method }}</td>
                                        <th>Status</th>
                                        <td>
                                            <span class="badge bg-success"
                                                >{{ page.props.order.payment_status }}</span
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="wg-box mt-5 text-right">
                        <form
                            action="http://localhost:8000/account-order/cancel-order"
                            method="POST"
                        >
                            <input
                                type="hidden"
                                name="_token"
                                value="3v611ELheIo6fqsgspMOk0eiSZjncEeubOwUa6YT"
                                autocomplete="off"
                            />
                            <input type="hidden" name="_method" value="PUT" />
                            <input type="hidden" name="order_id" value="1" />
                            <button type="submit" class="btn btn-danger">
                                Cancel Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <SiteFooter />
</template>

<style scoped>
.pt-90 {
    padding-top: 90px !important;
}

.pr-6px {
    padding-right: 6px;
    text-transform: uppercase;
}

.my-account .page-title {
    font-size: 1.5rem;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 40px;
    border-bottom: 1px solid;
    padding-bottom: 13px;
}

.my-account .wg-box {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    padding: 24px;
    flex-direction: column;
    gap: 24px;
    border-radius: 12px;
    background: var(--White);
    box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
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

.table-transaction > tbody > tr:nth-of-type(odd) {
    --bs-table-accent-bg: #fff !important;
}

.table-transaction th,
.table-transaction td {
    padding: 0.625rem 1.5rem 0.25rem !important;
    color: #000 !important;
}

.table > :not(caption) > tr > th {
    padding: 0.625rem 1.5rem 0.25rem !important;
    background-color: #6a6e51 !important;
}

.table-bordered > :not(caption) > * > * {
    border-width: inherit;
    line-height: 32px;
    font-size: 14px;
    border: 1px solid #e1e1e1;
    vertical-align: middle;
}

.table-striped .image {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    flex-shrink: 0;
    border-radius: 10px;
    overflow: hidden;
}

.table-striped td:nth-child(1) {
    min-width: 250px;
    padding-bottom: 7px;
}

.pname {
    display: flex;
    gap: 13px;
}

.table-bordered > :not(caption) > tr > th,
.table-bordered > :not(caption) > tr > td {
    border-width: 1px 1px;
    border-color: #6a6e51;
}
</style>
