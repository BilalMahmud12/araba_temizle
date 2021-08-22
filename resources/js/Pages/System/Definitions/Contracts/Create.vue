<template>
    <div class="h-full">
        <app-head title="Add Service Contract" />
        <Navigation />
        <div class="app-container py-3">
            <div class="px-4 py-3 bg-white border border-gray-200 flex items-center justify-between">
                <div class="flex items-center">
                    <span class="material-icons mr-2 text-gray-300">description</span>
                    <span class="text-lg text-[#1a8f36]">New Service Contract</span>
                </div>
                <div class="submit-area flex justify-content-end">
                    <Link type="button" as="button" :href="route('system.definitions.contracts.index')" class="btn-default">
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
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <div class="flex items-center space-x-3">
                                <Toggle labelledby="is_active" v-model="form.is_active" onLabel="On" offLabel="Off" />
                                <label id="is_active" class="mb-0 text-gray-500">Active</label>
                            </div>
                            <span class="flex text-xs text-gray-600 mt-2">If not checked this record will be disabled.</span>
                        </div>
                        <text-input id="name" type="text" label="Contract Name" v-model="form.name" />
                        <textarea-input id="notes" label="Contract Details" rows="10" v-model="form.content" />
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

import { ref } from "vue";
import { Link, useForm } from '@inertiajs/inertia-vue3'
import TextInput from "../../Shared/components/TextInput";
import TextareaInput from "../../Shared/components/TextareaInput";
import Toggle from '@vueform/toggle';
export default {
    layout: Layout,
    components: {
        AppHead,
        Navigation,
        TextInput,
        TextareaInput,
        Toggle,
        Link
    },
    setup() {
        const volumeOn = ref(false);
        const form = useForm({
            is_active: volumeOn,
            name: null,
            content: null,
            remember: true
        })
        function submit() {
            form.post(route('system.definitions.contracts.store'), form)
        }
        return { volumeOn ,form, submit }
    }
}
</script>

<style scoped>

</style>
