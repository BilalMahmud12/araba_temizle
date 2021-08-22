<template>
    <div>
        <app-head title="Create Account" />
        <div class="px-4 max-w-5xl py-8 mx-auto">
            <form @submit.prevent="submit">
                <div class="form-card bg-white shadow mb-8">
                    <div class="form-card-header px-8 py-4 bg-gray-100">
                        <span class="text-lg text-accent flex"> Personal Information </span>
                    </div>
                    <div class="form-card-body px-8 py-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <text-input id="first_name" label="First Name" v-model="form.first_name" />
                            <text-input id="last_name" label="Last Name" v-model="form.last_name" />
                            <text-input id="email" label="Email Address" v-model="form.email" />
                            <text-input id="national_id" label="TCKN / YKN" v-model="form.national_id" />
                        </div>
                    </div>
                </div>
                <div class="form-card bg-white shadow mb-8">
                    <div class="form-card-header px-8 py-4 bg-gray-100">
                        <span class="text-lg text-accent flex"> Phone Number </span>
                    </div>
                    <div class="form-card-body px-8 py-8">
                        <div class="grid grid-cols-1 mb-6">
                            <div class="flex items-center space-x-3">
                                <Toggle labelledby="is_international" v-model="form.is_international" onLabel="Yes" offLabel="No" @change="checkPhone" />
                                <label id="is_international" class="mb-0 text-gray-500">I Have International Number</label>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <text-input type="number" label="Int. Code" placeholder="001" class="w-[80px]" v-model="form.int_code" v-if="international" />
                            <text-input type="number" label="Primary Phone Number" placeholder="5XX XXX XXXX" v-model="form.phone_number" />
                        </div>
                    </div>
                </div>
                <div class="form-card bg-white shadow mb-8">
                    <div class="form-card-header px-8 py-4 bg-gray-100">
                        <span class="text-lg text-accent flex"> Address Information </span>
                    </div>
                    <div class="form-card-body px-8 py-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                <div class="form-card bg-white shadow">
                    <div class="form-card-body px-8 py-8">
                        <div class="flex items-center space-x-3 mb-6">
                            <Toggle labelledby="terms_agree" v-model="form.terms_agree" onLabel="Yes" offLabel="No" />
                            <label id="terms_agree" class="mb-0 text-gray-500">I agree about Service Digital Terms & Conditions.</label>
                        </div>

                        <button type="submit" class="btn-primary" @click="submit">
                            Create Account
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</template>

<script>
import AppHead from "../Shared/AppHead";
import ClientLayout from "../../Layouts/ClientLayout";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
import TextInput from "../../System/Shared/components/TextInput";
import Checkbox from "../../System/Shared/components/Checkbox";
import Multiselect from '@vueform/multiselect';
import Toggle from '@vueform/toggle';
import {ref} from "vue";
export default {
    layout: ClientLayout,
    components: {
        AppHead,
        Link,
        TextInput,
        Checkbox,
        Multiselect,
        Toggle
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
          }
      }
    },
    setup() {

        const form = useForm({
            first_name: null,
            last_name: null,
            email: null,
            national_id: null,
            phone_number: null,
            is_international: false,
            int_code: null,
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

        return {  form, submit }
    },
    methods: {
        checkPhone() {
            if (this.international === false) {
                return this.international = true
            } else {
                return this.international = false
            }
        },
    },
    watch: {
        'form.district_id': {
            handler() {
                this.params.district = this.form.district_id;
                this.$inertia.get( this.route('client.signup'),
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
                this.$inertia.get( this.route('client.signup'),
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
                this.$inertia.get( this.route('client.signup'),
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
