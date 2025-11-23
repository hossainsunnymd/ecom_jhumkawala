<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const page = usePage();
const isOpenSubMenu = ref(false);
const isSidebarOpen = ref(false);
const currentUrl = computed(() => page.url);
const isActiveRoute = (route) => {
    return currentUrl.value == route;
};
</script>

<template>
    <div class="layout-wrap">
        <div class="section-menu-left">
            <div class="box-logo">
                <a href="index.html" id="site-logo-inner">
                    <img
                        class=""
                        id="logo_header"
                        alt=""
                        :src="`images/logo/logo.png`"
                        data-light="images/logo/logo.png"
                        data-dark="images/logo/logo.png"
                    />
                </a>
                <div class="button-show-hide">
                    <i class="icon-menu-left"></i>
                </div>
            </div>
            <div class="center">
                <div class="center-item">
                    <div class="center-heading">Main Home</div>
                    <ul class="menu-list">
                        <li class="menu-item">
                            <Link
                                href="index.html"
                                class="text-decoration-none"
                            >
                                <div class="icon">
                                    <i class="icon-grid"></i>
                                </div>
                                <div class="text">Dashboard</div>
                            </Link>
                        </li>

                        <li
                            class="menu-item"
                            :class="
                                isActiveRoute('/admin/users') &&
                                isOpenSubMenu == false
                                    ? 'active'
                                    : ''
                            "
                        >
                            <Link
                                href="/admin/users"
                                class="text-decoration-none"
                            >
                                <div class="icon">
                                    <i class="icon-user"></i>
                                </div>
                                <div class="text">User</div>
                            </Link>
                        </li>

                        <li
                            class="menu-item"
                            :class="
                                isActiveRoute('/admin/brands') &&
                                isOpenSubMenu == false
                                    ? 'active'
                                    : ''
                            "
                        >
                            <Link
                                href="/admin/brands"
                                class="text-decoration-none"
                            >
                                <div class="icon">
                                    <i class="icon-layers"></i>
                                </div>
                                <div class="text">Brands</div>
                            </Link>
                        </li>

                        <li
                            class="menu-item"
                            :class="
                                isActiveRoute('/admin/categories') &&
                                isOpenSubMenu == false
                                    ? 'active'
                                    : ''
                            "
                        >
                            <Link
                                href="/admin/categories"
                                class="text-decoration-none"
                            >
                                <div class="icon">
                                    <i class="icon-layers"></i>
                                </div>
                                <div class="text">Category</div>
                            </Link>
                        </li>

                        <li class="menu-item">
                            <a
                                @click="isOpenSubMenu = !isOpenSubMenu"
                                href="javascript:void(0);"
                                class="menu-item-button text-decoration-none"
                            >
                                <div class="icon">
                                    <i class="icon-shopping-cart"></i>
                                </div>
                                <div class="text">Products</div>
                                <div class="arrow">
                                    <i
                                        :class="`fa fa-chevron-circle-${
                                            isOpenSubMenu ? 'up' : 'down'
                                        }`"
                                        aria-hidden="true"
                                    ></i>
                                </div>
                            </a>
                            <ul v-if="isOpenSubMenu" class="sub-menu">
                                <li class="sub-menu-item">
                                    <Link
                                        href="/admin/products"
                                        class="text-decoration-none"
                                        :class="{
                                            active: isActiveRoute(
                                                '/admin/products'
                                            ),
                                        }"
                                    >
                                        <i
                                            class="fa fa-dot-circle-o"
                                            aria-hidden="true"
                                        ></i>
                                        <div class="text">Products</div>
                                    </Link>
                                </li>
                                <li class="sub-menu-item active">
                                    <Link
                                        href="/admin/products/details"
                                        class="text-decoration-none"
                                        :class="{
                                            active: isActiveRoute(
                                                '/admin/products/details'
                                            ),
                                        }"
                                    >
                                        <i
                                            class="fa fa-dot-circle-o"
                                            aria-hidden="true"
                                        ></i>
                                        <div class="text">Product Detail</div>
                                    </Link>
                                </li>
                                <li
                                    class="sub-menu-item"
                                    :class="{
                                        active: isActiveRoute(
                                            '/admin/products/reviews'
                                        ),
                                    }"
                                >
                                    <Link
                                        href="/admin/products/reviews"
                                        class="text-decoration-none"
                                        :class="{
                                            active: isActiveRoute(
                                                '/admin/products/reviews'
                                            ),
                                        }"
                                    >
                                        <i
                                            class="fa fa-dot-circle-o"
                                            aria-hidden="true"
                                        ></i>
                                        <div class="text">Product Review</div>
                                    </Link>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="menu-item"
                            :class="{ active: isActiveRoute('/admin/orders') }"
                        >
                            <Link
                                href="/admin/orders"
                                class="text-decoration-none"
                            >
                                <div class="icon">
                                    <i class="icon-file-plus"></i>
                                </div>
                                <div class="text">Orders</div>
                            </Link>
                        </li>

                        <li
                            class="menu-item"
                            :class="{ active: isActiveRoute('/admin/sliders') }"
                        >
                            <Link
                                href="/admin/sliders"
                                class="text-decoration-none"
                            >
                                <div class="icon">
                                    <i class="icon-image"></i>
                                </div>
                                <div class="text">Slider</div>
                            </Link>
                        </li>

                        <li
                            class="menu-item"
                            :class="{ active: isActiveRoute('/admin/coupons') }"
                        >
                            <Link
                                href="/admin/coupons"
                                class="text-decoration-none"
                            >
                                <div class="icon">
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                </div>
                                <div class="text">Coupon</div>
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="section-content-right">
            <div class="header-dashboard">
                <div class="wrap">
                    <div class="header-left">
                        <a href="index-2.html">
                            <img
                                class=""
                                id="logo_header_mobile"
                                alt=""
                                :src="`images/logo/logo.png`"
                                data-light="images/logo/logo.png"
                                data-dark="images/logo/logo.png"
                                data-width="154px"
                                data-height="52px"
                                data-retina="images/logo/logo.png"
                            />
                        </a>
                        <div class="button-show-hide">
                            <i class="icon-menu-left"></i>
                        </div>

                        <form class="form-search flex-grow">
                            <fieldset class="name">
                                <input
                                    type="text"
                                    placeholder="Search here..."
                                    class="show-search"
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
                            <div class="box-content-search"></div>
                        </form>
                    </div>
                    <div class="header-grid">
                        <div class="popup-wrap message type-header">
                            <div class="dropdown">
                                <button
                                    class="btn btn-secondary dropdown-toggle"
                                    type="button"
                                    id="dropdownMenuButton2"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <span class="header-item">
                                        <span class="text-tiny">1</span>
                                        <i class="icon-bell"></i>
                                    </span>
                                </button>
                                <ul
                                    class="dropdown-menu dropdown-menu-end has-content"
                                    aria-labelledby="dropdownMenuButton2"
                                >
                                    <li>
                                        <h6>Notifications</h6>
                                    </li>
                                    <li>
                                        <div class="message-item item-1">
                                            <div class="image">
                                                <i class="icon-noti-1"></i>
                                            </div>
                                            <div>
                                                <div class="body-title-2">
                                                    Discount available
                                                </div>
                                                <div class="text-tiny">
                                                    Morbi sapien massa,
                                                    ultricies at rhoncus at,
                                                    ullamcorper nec diam
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-item item-2">
                                            <div class="image">
                                                <i class="icon-noti-2"></i>
                                            </div>
                                            <div>
                                                <div class="body-title-2">
                                                    Account has been verified
                                                </div>
                                                <div class="text-tiny">
                                                    Mauris libero ex, iaculis
                                                    vitae rhoncus et
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-item item-3">
                                            <div class="image">
                                                <i class="icon-noti-3"></i>
                                            </div>
                                            <div>
                                                <div class="body-title-2">
                                                    Order shipped successfully
                                                </div>
                                                <div class="text-tiny">
                                                    Integer aliquam eros nec
                                                    sollicitudin sollicitudin
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-item item-4">
                                            <div class="image">
                                                <i class="icon-noti-4"></i>
                                            </div>
                                            <div>
                                                <div class="body-title-2">
                                                    Order pending:
                                                    <span>ID 305830</span>
                                                </div>
                                                <div class="text-tiny">
                                                    Ultricies at rhoncus at
                                                    ullamcorper
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#" class="tf-button w-full"
                                            >View all</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="popup-wrap user type-header">
                            <div class="dropdown">
                                <button
                                    class="btn btn-secondary dropdown-toggle"
                                    type="button"
                                    id="dropdownMenuButton3"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <span class="header-user wg-user">
                                        <span class="image">
                                            <!-- <img
                                                src="images/avatar/user-1.png"
                                                alt=""
                                            /> -->
                                        </span>
                                        <span class="flex flex-column">
                                            <span class="body-title mb-2"
                                                >Kristin Watson</span
                                            >
                                            <span class="text-tiny">Admin</span>
                                        </span>
                                    </span>
                                </button>
                                <ul
                                    class="dropdown-menu dropdown-menu-end has-content"
                                    aria-labelledby="dropdownMenuButton3"
                                >
                                    <li>
                                        <a href="#" class="user-item">
                                            <div class="icon">
                                                <i class="icon-user"></i>
                                            </div>
                                            <div class="body-title-2">
                                                Account
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="user-item">
                                            <div class="icon">
                                                <i class="icon-mail"></i>
                                            </div>
                                            <div class="body-title-2">
                                                Inbox
                                            </div>
                                            <div class="number">27</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="user-item">
                                            <div class="icon">
                                                <i class="icon-file-text"></i>
                                            </div>
                                            <div class="body-title-2">
                                                Taskboard
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="user-item">
                                            <div class="icon">
                                                <i class="icon-headphones"></i>
                                            </div>
                                            <div class="body-title-2">
                                                Support
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="login.html" class="user-item">
                                            <div class="icon">
                                                <i class="icon-log-out"></i>
                                            </div>
                                            <div class="body-title-2">
                                                Log out
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<style scoped>
.section-menu-left-close {
    margin-left: -280px;
}
</style>
