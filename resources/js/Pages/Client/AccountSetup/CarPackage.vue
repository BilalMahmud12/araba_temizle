<template>
    <div>
        <app-head title="Car Washing Package" />
        <div class="bg-white py-4 shadow">
            <div class="flex items-center justify-between px-6 md:max-w-5xl mx-auto">
                <div class="step-title text-xl md:text-2xl font-bold text-gray-600">Create Account</div>
            </div>
        </div>

        <div class="px-4 max-w-2xl py-6 mx-auto">
            <div class="step-indicator py-6 px-6 bg-white shadow border-b border-gray-200">
                <div class="indicator-bar h-2 w-full bg-gray-100 shadow-inner mb-4">
                    <div class="w-[75%] h-full bg-main"></div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="step-title flex items-center space-x-2">
                        <span class="material-icons text-gray-300">local_car_wash</span>
                        <span class="text-main ">Wash Package</span>
                    </div>
                    <div class="step-count text-xs text-white flex items-center">
                        <span class="px-2 py-1 border-r border-white bg-gray-100 text-main">Step</span>
                        <span class="px-3 py-1 border-r border-white bg-main">3 / 4</span>
                    </div>
                </div>
            </div>

            <form>
                <div class="form-card bg-white shadow pt-4 mb-8">
                    <div class="form-group pb-8 mb-4 border-b border-gray-200">
                        <div class="group-title px-8 mb-4 text-lg text-accent flex">Car Information</div>
                        <div class="group-input px-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <text-input id="car_brand" label="Car Brand" v-model="form.car_brand" placeholder="Renault" />
                                <text-input id="car_model" label="Car Model" v-model="form.car_model" placeholder="Clio" />
                                <text-input id="car_color" label="Color" v-model="form.car_color" placeholder="White" />
                                <text-input id="car_license_no" label="License Plate" v-model="form.car_license_no" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group pb-8 mb-4 border-b border-gray-200">
                        <div class="group-title px-8 mb-4 text-lg text-accent flex">Wash Package</div>
                        <div class="group-input px-8">
                            <div class="grid grid-cols-1 gap-3">
                                <div class="flex flex-col">
                                    <label class="form-label mb-2">Wash Service Type</label>
                                    <multiselect
                                        ref="washCategory"
                                        v-model="form.category"
                                        :options="washCategories"
                                        valueProp="id"
                                        label="name"
                                        placeholder=""
                                        object
                                    />
                                </div>
                                <div class="flex flex-col">
                                    <label class="form-label mb-2">Wash Plan</label>
                                    <multiselect
                                        ref="washPlan"
                                        v-model="form.plan"
                                        :options="washPackages"
                                        valueProp="id"
                                        label="name"
                                        placeholder=""
                                        object
                                    />
                                </div>
                            </div>
                            <div class="order-details relative bg-gray-100 mt-8 py-8">
                                <p class="px-6 font-mono text-sm text-red-600 mb-6">Your Order Details</p>
                                <div class="px-6 font-mono text-sm flex-col">
                                    <span class="flex mb-3">Client Number: {{ client.client_number }} </span>
                                    <span class="flex mb-3">Name: {{ client.first_name }} {{ client.last_name }}</span>
                                    <span class="flex my-4">==========================</span>
                                    <span class="flex mb-3">Car Brand: {{ form.car_brand }} </span>
                                    <span class="flex mb-3">Car Model: {{ form.car_model }} </span>
                                    <span class="flex mb-3">Color: {{ form.car_color }} </span>
                                    <span class="flex mb-3">License No: {{ form.car_license_no }} </span>
                                    <span class="flex my-4">==========================</span>
                                    <span class="flex mb-3">Wash Type:  {{ OrderDetails.type }}</span>

                                    <span class="flex leading-loose">Wash Plan: <br>  {{ OrderDetails.plan }}</span>
                                    <span class="flex my-4">==========================</span>
                                    <div class="flex items-center justify-between">
                                        <span class="flex">Total:</span>
                                        <span class="flex text-red-600">{{ OrderDetails.price }}₺</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group pb-8 mb-4 border-b border-gray-200">
                        <div class="group-title px-8 mb-4 text-lg text-accent flex">Service Date</div>
                        <div class="group-input px-8">
                            <div class="flex flex-col">
                                <label class="form-label mb-2">Service Start Date</label>
                                <DatePicker
                                    v-model="form.date"
                                    color="green"
                                    mode="date"
                                    :min-date="new Date()"
                                    :minute-increment="15"
                                    locale="tr"
                                >
                                    <template v-slot="{ inputValue, inputEvents }">
                                        <input
                                            class="bg-white border px-2 py-1 rounded"
                                            :value="inputValue"
                                            v-on="inputEvents"
                                        />
                                    </template>
                                </DatePicker>
                            </div>
                        </div>
                    </div>
                    <div class="form-group px-8 pb-4">
                        <div class="flex items-center justify-between">
                            <Link href="#" as="button" type="button" class="px-6 py-2 text-white bg-accent" @click="returnBack">
                                <span>Back</span>
                            </Link>
                            <button type="button" class="ml-auto px-6 py-2 text-white bg-main">
                                <span>Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";

import AppHead from "../Shared/AppHead";
import ClientLayout from "../../Layouts/ClientLayout";
import TextInput from "../../System/Shared/components/TextInput";
import Multiselect from '@vueform/multiselect';
import { DatePicker } from 'v-calendar';

export default {
    name: "CarPackage",
    layout: ClientLayout,
    components: {
        AppHead,
        Link,
        TextInput,
        Multiselect,
        DatePicker
    },
    props: {
        client: Object,
        washCategories: Object,
        washPackages: Object
    },
    setup(props) {
        const timezone = 'Europe/Istanbul'
        const plans = ref(props.washPackages)
        const washCategory = ref(null)
        const washPlan = ref(null)
        const OrderDetails = {
            type: null,
            plan: null,
            price: null,
        }
        const form = useForm({
            car_brand: null,
            car_model: null,
            car_color: null,
            car_license_no: null,
            category: null,
            plan: null,
            date: new Date(),
        })
        const returnBack = function () {
            window.history.back();
        }

        const submit = function() {

        }
        return { washCategory, washPlan, form, plans, OrderDetails, timezone, returnBack, submit }
    },
    watch: {
        'form.category' : {
            handler() {
                this.$inertia.get( this.route('client.signup.wash-package', this.client.id),
                    { category: this.form.category },
                    { preserveState: true, preserveScroll: true } )
                this.$refs.washPlan.clear()

                this.OrderDetails.type = this.form.category.name
            },
            deep: true
        },
        'form.plan': {
            handler() {
                if (this.form.plan != null) {
                    this.OrderDetails.plan = this.form.plan.name
                    this.OrderDetails.price = this.form.plan.price
                }
            }
        }
    }

}
</script>

<style scoped>
.plan-category {
    position: absolute;
    top: 0;
    left: 20px;
    z-index: 10;
}
.plan-selected {
    border-color: #f05a28ff;
}
.plan-selected > .plan-details > span {
    color: white !important;
}

.plan-selected > .plan-details > div {
    color: white !important;
}

.order-details:before {
    background: linear-gradient(-45deg, #f3f4f6 16px, transparent 0), linear-gradient(45deg, #f3f4f6 16px, transparent 0);
    background-position: left bottom;
    background-repeat: repeat-x;
    background-size: 20px 32px;
    content: " ";
    display: block;
    position: absolute;
    top: -19px;
    left: 0;
    width: 100%;
    height: 32px;
}

.order-details:after {
    background: linear-gradient(-45deg, #ffffff 16px, transparent 0), linear-gradient(45deg, #ffffff 16px, transparent 0);
    background-position: left bottom;
    background-repeat: repeat-x;
    background-size: 20px 32px;
    content: " ";
    display: block;
    position: absolute;
    bottom: -13px;
    left: 0;
    width: 100%;
    height: 32px;
}


</style>
