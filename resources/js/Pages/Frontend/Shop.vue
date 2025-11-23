<script setup>
import ShopList from "../../Components/Frontend/ShopList.vue";
import SiteFooter from "../../Components/Frontend/SiteFooter.vue";
import SiteHeader from "../../Components/Frontend/SiteHeader.vue";

import { ref } from "vue";
import { usePage,Link } from "@inertiajs/vue3";

const page = usePage();

// Accordion states
const categoryList = ref(false);
const brandList = ref(false);


// Toggle function
const toggleAccordion = (section) => {
  switch (section) {
    case 'category': categoryList.value = !categoryList.value; break;
    case 'brand': brandList.value = !brandList.value; break;
  }
};

</script>

<template>
  <SiteHeader />

  <main class="pt-70 main-container">
    <section class="shop-main container d-flex pt-4 pt-xl-5">
      <div class="shop-sidebar side-sticky bg-body" id="shopFilter">

        <!-- CATEGORY -->
        <div class="accordion mb-4">
          <div class="accordion-item">
            <h5 class="accordion-header">
              <button
                class="accordion-button p-0 border-0 fs-5 text-uppercase d-flex align-items-center justify-content-between w-100"
                type="button"
                @click="toggleAccordion('category')"
              >
                Product Category
                <svg
                  class="accordion-button__icon"
                  :class="{ 'rotate-180': categoryList }"
                  viewBox="0 0 10 6"
                  xmlns="http://www.w3.org/2000/svg"
                  width="14"
                  height="14"
                >
                  <path
                    d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"
                    fill="currentColor"
                  />
                </svg>
              </button>
            </h5>
            <div v-show="categoryList" class="accordion-collapse collapse show border-0">
              <div class="accordion-body px-0 pb-0 pt-3">
                <ul class="list list-inline mb-0">
                  <li v-for="category in page.props.categories" :key="category.id" class="list-item"><Link :href="`/shop?category=${ category.slug }`" class="menu-link py-1">{{ category.name }}</Link></li>
                </ul>
              </div>
            </div>
          </div>
        </div>


        <!-- BRAND -->
        <div class="accordion mb-4">
          <div class="accordion-item">
            <h5 class="accordion-header">
              <button
                class="accordion-button p-0 border-0 fs-5 text-uppercase d-flex align-items-center justify-content-between w-100"
                type="button"
                @click="toggleAccordion('brand')"
              >
                Brand
                <svg
                  class="accordion-button__icon"
                  :class="{ 'rotate-180': brandList }"
                  viewBox="0 0 10 6"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"
                  />
                </svg>
              </button>
            </h5>
            <div v-show="brandList" class="accordion-collapse collapse show border-0">
              <div class="accordion-body px-0 pb-0">
                <ul class="list-unstyled mb-0">
                  <li v-for=" brand in page.props.brands" :key="brand.id"><a href="#" class="menu-link py-1">{{ brand.name }}</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>

      <ShopList />
    </section>
  </main>

  <SiteFooter />
</template>

<style scoped>
.accordion-button__icon {
  transition: transform 0.3s ease;
}

/* Rotate 180 when open */
.rotate-180 {
  transform: rotate(180deg);
}

@media (max-width: 768px) {
.main-container{
    padding-top: 90px;
}
}

</style>
