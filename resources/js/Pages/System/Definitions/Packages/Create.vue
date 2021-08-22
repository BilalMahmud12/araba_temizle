<template>
    <div class="h-full">
        <app-head title="Add Service Package" />
        <Navigation />
        <PackagesNav />
        <div class="app-container py-3">
            <div class="px-4 py-3 bg-white border border-gray-200 flex items-center justify-between">
                <div class="flex items-center">
                    <span class="material-icons mr-2 text-gray-300">description</span>
                    <span class="text-lg text-[#1a8f36]">New Service Package</span>
                </div>
                <div class="submit-area flex justify-content-end">
                    <Link type="button" as="button" :href="route('system.definitions.packages.index')" class="btn-default">
                        <span class="material-icons mr-3">west</span>
                        <span>Return</span>
                    </Link>
                    <button type="submit" class="btn-primary ml-4 flex items-center" @click="submit">
                        <span class="material-icons mr-3">save</span>
                        <span>Create</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-container">
            <div class="px-6 py-8 bg-white border border-gray-200">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-1 gap-6 mb-6">
                        <div>
                            <div class="flex items-center space-x-3">
                                <Toggle labelledby="is_active" v-model="form.is_active" onLabel="On" offLabel="Off" />
                                <label id="is_active" class="mb-0 text-gray-500">Active</label>
                            </div>
                            <span class="flex text-xs text-gray-600 mt-2">If not checked this record will be disabled.</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <text-input id="name" type="text" label="Package Name" v-model="form.name" />

                        <div class="flex flex-col">
                            <label class="form-label mb-2">Package Category</label>
                            <multiselect
                                v-model="form.package_category_id"
                                :options="categories"
                                valueProp="id"
                                label="name"
                                placeholder="Select Package Category"
                                searchable="true"
                                trackBy="name"
                            />
                        </div>
                        <div class="flex flex-col">
                            <label class="form-label mb-2">Service Contract</label>
                            <multiselect
                                v-model="form.service_contract_id"
                                :options="contracts"
                                valueProp="id"
                                label="name"
                                placeholder="Select Service Contract"
                            />
                        </div>
                        <text-input id="price" type="number" label="Package Price (₺₺)" v-model="form.price" />

                        <div class="col-span-2">
                            <textarea-input id="notes" label="Notes" rows="5" v-model="form.notes" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import AppHead from "../../Shared/AppHead";
import Layout from "@/Layouts/CRMLayout";
import Navigation from "../Navigation";
import PackagesNav from "./PackagesNav";

import { ref } from "vue";
import { Link ,useForm } from '@inertiajs/inertia-vue3'
import TextInput from "../../Shared/components/TextInput";
import TextareaInput from "../../Shared/components/TextareaInput";
import Toggle from '@vueform/toggle';
import Multiselect from '@vueform/multiselect';
export default {
    layout: Layout,
    components: {
        AppHead,
        Navigation,
        PackagesNav,
        TextInput,
        TextareaInput,
        Multiselect,
        Toggle,
        Link
    },
    props: {
        categories: Object,
        contracts: Object
    },
    setup() {
        const volumeOn = ref(false);
        const form = useForm({
            is_active: volumeOn,
            name: null,
            price: null,
            notes: null,
            service_contract_id: null,
            package_category_id: null,
            remember: true
        })
        function submit() {
            form.post(route('system.definitions.packages.store'), form)
        }
        return { volumeOn ,form, submit }
    },
}
</script>

<style scoped>

</style>
