<template>
    <div>
        <app-head title="Create Account" />
        <div class="bg-white py-4 shadow">
            <div class="flex items-center justify-between px-6 md:max-w-5xl mx-auto">
                <div class="step-title text-xl md:text-2xl font-bold text-gray-600">Create Account</div>
            </div>
        </div>

        <div class="px-4 max-w-2xl py-6 mx-auto">
            <div class="step-indicator py-6 px-6 bg-white shadow border-b border-gray-200">
                <div class="indicator-bar h-2 w-full bg-gray-100 shadow-inner mb-4">
                    <div class="w-[25%] h-full bg-main"></div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="step-title flex items-center space-x-2">
                        <span class="material-icons text-gray-300">person</span>
                        <span class="text-main ">Account Information</span>
                    </div>
                    <div class="step-count text-xs text-white flex items-center">
                        <span class="px-2 py-1 border-r border-white bg-gray-100 text-main">Step</span>
                        <span class="px-3 py-1 border-r border-white bg-main">1 / 4</span>
                    </div>
                </div>
            </div>
            <form @submit.prevent="submit">
                <div class="form-card bg-white shadow pt-4 mb-8">
                    <div class="form-group pb-8 mb-4 border-b border-gray-200">
                        <div class="group-title px-8 mb-4 text-lg text-accent flex">Personal Information</div>
                        <div class="group-input px-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <text-input id="first_name" label="First Name" v-model="form.first_name" />
                                <text-input id="last_name" label="Last Name" v-model="form.last_name" />
                                <phone-input id="phone" label="Phone Number" type="tel" v-model="form.phone_number" ref="clientPhone" @input="findRefPhoneCountry" />
                                <text-input id="email" label="Email Address" v-model="form.email" />
                                <text-input id="national_id" label="T.C. Kimlik / YKN" v-model="form.national_id" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group pb-8 mb-4 border-b border-gray-200">
                        <div class="group-title px-8 mb-4 text-lg text-accent flex">Address Information</div>
                        <div class="group-input px-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="flex flex-col">
                                    <label class="form-label mb-2">District</label>
                                    <multiselect
                                        ref="districts"
                                        v-model="form.district_id"
                                        :options="districts"
                                        valueProp="id"
                                        label="name"
                                        placeholder="Select District"

                                    />
                                </div>
                                <div class="flex flex-col">
                                    <label class="form-label mb-2">Area</label>
                                    <multiselect
                                        ref="areas"
                                        v-model="form.area_id"
                                        :options="areas"
                                        valueProp="id"
                                        label="name"
                                        placeholder="Select Area"
                                    />
                                </div>
                                <div class="flex flex-col">
                                    <label class="form-label mb-2">Service Spot</label>
                                    <multiselect
                                        ref="spots"
                                        v-model="form.spot_id"
                                        :options="spots"
                                        valueProp="id"
                                        label="name"
                                        placeholder="Select Service Spot"
                                    />
                                </div>
                                <div class="flex flex-col">
                                    <label class="form-label mb-2">Building / Block</label>
                                    <multiselect
                                        ref="blocks"
                                        v-model="form.block_id"
                                        :options="blocks"
                                        valueProp="id"
                                        label="name"
                                        placeholder="Select Building Block Number"
                                    />
                                </div>
                                <text-input id="flat_no" label="Flat / Apartment No" v-model="form.flat_no" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group px-8 pb-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <Toggle labelledby="terms_agree" v-model="form.terms_agree" onLabel="Yes" offLabel="No" />
                            <label id="terms_agree" class="mb-0 text-gray-500">I agree about Service Digital Terms & Conditions.</label>
                        </div>

                        <div class="flex items-center justify-between">
                            <Link href="#" as="button" type="button" class="ml-auto px-6 py-2 text-white bg-main" @click.prevent="submit">
                                <span>Next</span>
                            </Link>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import AppHead from "../Shared/AppHead";
import ClientLayout from "../../Layouts/ClientLayout";

import { ref } from "vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
import TextInput from "../../System/Shared/components/TextInput";
import Checkbox from "../../System/Shared/components/Checkbox";
import Multiselect from '@vueform/multiselect';
import Toggle from '@vueform/toggle';
import PhoneInput from "../Shared/Components/PhoneInput";

export default {
    layout: ClientLayout,
    components: {
        AppHead,
        Link,
        TextInput,
        Checkbox,
        Multiselect,
        Toggle,
        PhoneInput
    },
    props: {
        districts: Object,
        areas: Object,
        spots: Object,
        blocks: Object,
    },
    data() {
      return {
          international: false,
          params: {
              district: null,
              area: null,
              spot: null,
          },
      }
    },
    setup() {
        const clientPhone = ref(null)
        const form = useForm({
            first_name: null,
            last_name: null,
            email: null,
            national_id: null,
            phone_number: null,
            dial_code: null,
            district_id: null,
            area_id: null,
            spot_id: null,
            block_id: null,
            flat_no: null,
            terms_agree: null,
            remember: true,
        })
        function submit() {
            Inertia.post(route('client.create-account'), form)
        }

        return { clientPhone ,form, submit }
    },
    methods: {
        findRefPhoneCountry() {
            const phoneInput = document.querySelector("#phone");
            phoneInput.addEventListener("countrychange", function() {
                phoneInput.value = null
            });
            this.form.dial_code = this.clientPhone.countryData.dialCode
        }
    },
    watch: {
        'form.district_id': {
            handler() {
                this.params.district = this.form.district_id;
                this.$inertia.get( this.route('client.signup.account-info'),
                    this.params,
                    { preserveState: true, preserveScroll: true }
                );
                this.$refs.areas.clear()
            },
            deep: true
        },
        'form.area_id': {
            handler() {
                this.params.area = this.form.area_id;
                this.$inertia.get( this.route('client.signup.account-info'),
                    this.params,
                    { preserveState: true, preserveScroll: true }
                );
                this.$refs.spots.clear()
            },
            deep: true
        },
        'form.spot_id': {
            handler() {
                this.params.spot = this.form.spot_id;
                this.$inertia.get( this.route('client.signup.account-info'),
                    this.params,
                    { preserveState: true, preserveScroll: true }
                );
                this.$refs.blocks.clear()
            },
            deep: true
        }
    },
}
</script>

<style scoped>

</style>
