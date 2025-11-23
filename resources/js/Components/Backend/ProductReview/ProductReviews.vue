<script setup>
import { Link, usePage, router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";

const toaster = useToast({
    position: "top-right",
    duration: 3000,
});

const page = usePage();

// function deleteProductReview(id) {
//     if (confirm("Are you sure you want to delete this brand?")) {
//         router.get(`/admin/brand/${id}`);
//     }
// }

// if (page.props.flash.status == true) {
//     toaster.success(page.props.flash.message);
// } else if (page.props.flash.status == false) {
//     toaster.error(page.props.flash.message);
// }
</script>

<template>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div
                class="flex items-center flex-wrap justify-between gap20 mb-27"
            >
                <h3>Product Reviews</h3>

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
                        <Link href="/admin/products">
                            <div class="text-tiny">Products</div>
                        </Link>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Product Reviews</div>
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
                    <!-- <Link
                        class="tf-button style-1 w208"
                        :href="`/admin/products/reviews/save?id=${0}`"
                        ><i class="icon-plus"></i> Add new</Link
                    > -->
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>User Name</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Rating</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(productReview, index) in page.props
                                        .productReviews.data"
                                    :key="index"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ productReview.user.name }}</td>
                                    <td>{{ productReview.product.name }}</td>
                                    <td>
                                        {{ productReview.description }}
                                    </td>
                                    <td>
                                        {{ productReview.rating }}
                                    </td>
                                    <td>
                                        <div class="list-icon-function">
                                            <Link
                                                :href="`/admin/product/reviews/save?id=${productReview.id}`"
                                            >
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </Link>
                                            <button
                                                @click="
                                                    deleteProductReview(
                                                        productReview.id
                                                    )
                                                "
                                                class="item text-danger delete"
                                            >
                                                <i class="icon-trash-2"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="divider"></div>
                    <div
                        class="flex items-center justify-between flex-wrap gap10 wgp-pagination"
                    ></div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
