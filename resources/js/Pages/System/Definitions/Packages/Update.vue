<template>
    <div class="h-full">
        <app-head title="Update Service Package" />
        <Navigation />
        <PackagesNav />
        <div class="app-container py-3">
            <div class="px-4 py-3 bg-white border border-gray-200 flex items-center justify-between">
                <div class="flex items-center">
                    <span class="material-icons mr-2 text-gray-300">description</span>
                    <span class="text-lg text-[#1a8f36]">Update: {{ form.name }}</span>
                </div>
                <div class="submit-area flex justify-content-end">
                    <Link type="button" as="button" :href="route('system.definitions.packages.index')" class="btn-default">
                        <span class="material-icons mr-3">west</span>
                        <span>Return</span>
                    </Link>
                    <button type="submit" class="btn-primary ml-4 flex items-center" @click="submit">
                        <span class="material-icons mr-3">save</span>
                        <span>Update</span>
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
        <div class="app-container">
            <div class="flex items-center mt-6">
                <button type="button" class="ml-auto p-2 rounded-full text-gray-300 hover:bg-red-600 hover:text-white transition ease-in-out" @click.prevent="$refs.dialog.openDialog()">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-color " viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
            </div>
        </div>
        <ConfirmDialog ref="dialog" v-on:destroy="destroy" />
    </div>
</template>

<script>
import AppHead from "../../Shared/AppHead";
import Layout from "@/Layouts/CRMLayout";
import Navigation from "../Navigation";
import PackagesNav from "./PackagesNav";

import { ref } from "vue";
import { Link, useForm } from '@inertiajs/inertia-vue3'
import TextInput from "../../Shared/components/TextInput";
import TextareaInput from "../../Shared/components/TextareaInput";
import Checkbox from "../../Shared/components/Checkbox";
import Multiselect from '@vueform/multiselect';
import Toggle from '@vueform/toggle';
import Dialog from "../../Shared/components/Dialog";

export default {
    layout: Layout,
    components: {
        AppHead,
        Navigation,
        PackagesNav,
        TextInput,
        TextareaInput,
        Checkbox,
        Multiselect,
        Link,
        Toggle,
        ConfirmDialog: Dialog
    },
    props: {
        categories: Object,
        contracts: Object,
        package: Object
    },
    setup(props) {
        const volumeOn = ref(false);
        const form = useForm({
            id: props.package.id,
            is_active: props.package.is_active === 1,
            name: props.package.name,
            price: props.package.price,
            notes: props.package.notes,
            service_contract_id: props.package.service_contract_id,
            package_category_id: props.package.package_category_id,
            remember: true
        })
        function submit() {
            form.post(route('system.definitions.packages.update', form.id), form)
        }
        function destroy() {
            form.delete( route('system.definitions.packages.destroy', form.id),  { preserveScroll: true })
        }
        return { volumeOn ,form, submit, destroy }
    },
}
</script>

<style scoped>

</style>
