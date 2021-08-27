<template>
    <div class="h-full">
        <app-head title="Add Service Spot" />
        <Navigation />
        <ServiceSpotsNav />
        <div class="app-container py-3">
            <div class="px-4 py-3 bg-white border border-gray-200 flex items-center justify-between">
                <div class="flex items-center">
                    <span class="material-icons mr-2 text-gray-300">description</span>
                    <span class="text-lg text-[#1a8f36]">New Service Spot</span>
                </div>
                <div class="submit-area flex justify-content-end">
                    <Link type="button" as="button" :href="route('system.definitions.spots.service-spots.index')" class="btn-default">
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
                    <div class="grid grid-cols-1 gap-6 mb-3">
                        <div>
                            <div class="flex items-center space-x-3">
                                <Toggle labelledby="is_active" v-model="form.is_active" onLabel="On" offLabel="Off" />
                                <label id="is_active" class="mb-0 text-gray-500">Active</label>
                            </div>
                            <span class="flex text-xs text-gray-600 mt-2">If not checked this record will be disabled.</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-6 mb-3">
                        <text-input id="name" type="text" label="Service Spot Name" v-model="form.name" />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">

                        <div class="flex flex-col">
                            <label class="form-label mb-2">Service Spot Type</label>
                            <multiselect
                                v-model="form.spot_type_id"
                                :options="spotTypes"
                                valueProp="id"
                                label="name"
                                placeholder="Select Service Spot Type"
                                searchable
                                trackBy="name"
                            />
                        </div>
                        <div class="flex flex-col">
                            <label class="form-label mb-2">Service Area</label>
                            <multiselect
                                v-model="form.area_id"
                                :options="areas"
                                valueProp="id"
                                label="name"
                                placeholder="Select Service Area"
                                searchable
                                trackBy="name"
                            />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-6">
                        <textarea-input id="notes" label="Notes" rows="5" v-model="form.notes" />
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>

<script>
import AppHead from "../../../Shared/AppHead";
import Layout from "@/Layouts/CRMLayout";
import Navigation from "../../Navigation";
import ServiceSpotsNav from "../ServiceSpotsNav";

import { ref } from "vue";
import { Link, useForm } from '@inertiajs/inertia-vue3';
import TextInput from "../../../Shared/components/TextInput";
import TextareaInput from "../../../Shared/components/TextareaInput";
import Toggle from '@vueform/toggle';
import Multiselect from '@vueform/multiselect';
export default {
    layout: Layout,
    components: {
        AppHead,
        Navigation,
        ServiceSpotsNav,
        Link,
        TextInput,
        TextareaInput,
        Toggle,
        Multiselect
    },
    props: {
        spotTypes: Object,
        areas: Object,
    },
    setup() {
        const volumeOn = ref(false);
        const form = useForm({
            is_active: volumeOn,
            name: null,
            spot_type_id: null,
            area_id: null,
            notes: null,
            remember: true
        })
        function submit() {
            form.post(route('system.definitions.spots.service-spots.store'), form)
        }
        return { volumeOn ,form, submit }
    },
}
</script>

<style scoped>

</style>
