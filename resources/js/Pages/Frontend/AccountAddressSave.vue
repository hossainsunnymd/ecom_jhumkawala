<script setup>
import SiteFooter from "../../Components/Frontend/SiteFooter.vue";
import SiteHeader from "../../Components/Frontend/SiteHeader.vue";
import CustomerLayout from "../../Components/Layout/CustomerLayout.vue";

import { Link,usePage,useForm,router } from "@inertiajs/vue3";
import { computed } from "vue";
import { useToast } from "vue-toast-notification";

const toast = useToast({
    position: "top-right",
    duration: 3000,
});

const page = usePage();
const errors=computed(()=>page.props.flash.errors || {});

const addressId=new URLSearchParams(window.location.search).get("id");
const address=page.props.address;
console.log(address);

let url="/customer/address";

const form=useForm({
        user_id:'',
        name: '',
        phone: '',
        pincode: '',
        state: '',
        city: '',
        address: '',
        locality: '',
        landmark: '',
        is_default:0,
});

if(address != null && addressId != 0){
    form.user_id=address.user_id;
    form.name=address.name;
    form.phone=address.phone;
    form.pincode=address.pincode;
    form.state=address.state;
    form.city=address.city;
    form.address=address.address;
    form.locality=address.locality;
    form.landmark=address.landmark;
    form.is_default=address.is_default;
    url=`/customer/address/${addressId}/update`;
}


const submit=()=>{
    form.post(url,
        {
            preserveScroll: true,
            onSuccess: () => {
                if (page.props.flash.status == true) {
                    toast.success(page.props.flash.message);
                    router.get("/customer/address");
                } else if (page.props.flash.status == false) {
                    toast.error(page.props.flash.message);
                }
            },
        }
    );
}

</script>

<template>
    <SiteHeader />

    <CustomerLayout>
        <template #header><h2 class="page-title">My Address</h2> </template>
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
                        <Link href="/customer/address" class="btn btn-sm btn-danger">Back</Link>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-5">
                            <div class="card-header">
                                <h5>{{ addressId == 0 ? "Add New Address" : "Update Address" }}</h5>
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="submit">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating my-3">
                                                <input
                                                    v-model="form.name"
                                                    type="text"
                                                    class="form-control"
                                                    name="name"
                                                    value=""
                                                />
                                                <label for="name"
                                                    >Full Name *</label
                                                >
                                                <span
                                                    v-if="errors.name"
                                                    class="text-red"
                                                >{{ errors.name[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating my-3">
                                                <input
                                                    v-model="form.phone"
                                                    type="text"
                                                    class="form-control"
                                                    name="phone"
                                                    value=""
                                                />
                                                <label for="phone"
                                                    >Phone Number *</label
                                                >
                                                <span
                                                    v-if="errors.phone"
                                                    class="text-red"
                                                >{{ errors.phone[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating my-3">
                                                <input
                                                    v-model="form.pincode"
                                                    type="text"
                                                    class="form-control"
                                                    name="zip"
                                                    value=""
                                                />
                                                <label for="zip"
                                                    >Pincode *</label
                                                >
                                                <span
                                                    v-if="errors.pincode"
                                                    class="text-red"
                                                >{{ errors.pincode[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div
                                                class="form-floating mt-3 mb-3"
                                            >
                                                <input
                                                    v-model="form.state"
                                                    type="text"
                                                    class="form-control"
                                                    name="state"
                                                    value=""
                                                />
                                                <label for="state"
                                                    >State *</label
                                                >
                                                <span
                                                    v-if="errors.state"
                                                    class="text-red"
                                                >{{ errors.state[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating my-3">
                                                <input
                                                    v-model="form.city"
                                                    type="text"
                                                    class="form-control"
                                                    name="city"
                                                    value=""
                                                />
                                                <label for="city"
                                                    >Town / City *</label
                                                >
                                                <span
                                                    v-if="errors.city"
                                                    class="text-red"
                                                >{{ errors.city[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating my-3">
                                                <input
                                                    v-model="form.address"
                                                    type="text"
                                                    class="form-control"
                                                    name="address"
                                                    value=""
                                                />
                                                <label for="address"
                                                    >House no, Building Name
                                                    *</label
                                                >
                                                <span
                                                    v-if="errors.address"
                                                    class="text-red"
                                                >{{ errors.address[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating my-3">
                                                <input
                                                    v-model="form.locality"
                                                    type="text"
                                                    class="form-control"
                                                    name="locality"
                                                    value=""
                                                />
                                                <label for="locality"
                                                    >Road Name, Area, Colony
                                                    *</label
                                                >
                                                <span
                                                    v-if="errors.locality"
                                                    class="text-red"
                                                >{{ errors.locality[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating my-3">
                                                <input
                                                    v-model="form.landmark"
                                                    type="text"
                                                    class="form-control"
                                                    name="landmark"
                                                    value=""
                                                />
                                                <label for="landmark"
                                                    >Landmark *</label
                                                >
                                                <span
                                                    class="text-danger"
                                                ></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input
                                                    v-model="form.is_default"
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    id="isdefault"
                                                    name="isdefault"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="isdefault"
                                                >
                                                    Make as Default address
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <button
                                                type="submit"
                                                class="btn btn-success"
                                            >
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
            </div>
        </div>
    </CustomerLayout>

    <SiteFooter />
</template>

<style scoped></style>
