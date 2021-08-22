<template>
    <div class="h-full">
        <app-head title="Add Service Area" />
        <Navigation />
        <ServiceSpotsNav />
        <div class="app-container py-3">
            <div class="px-4 py-3 bg-white border border-gray-200 flex items-center justify-between">
                <div class="flex items-center">
                    <span class="material-icons mr-2 text-gray-300">description</span>
                    <span class="text-lg text-[#1a8f36]">Update Service Area :   {{ form.name }}</span>
                </div>
                <div class="submit-area flex justify-content-end">
                    <Link type="button" as="button" :href="route('system.definitions.spots.areas.index')" class="btn-default">
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
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <div class="flex items-center space-x-3">
                                <Toggle labelledby="is_active" v-model="form.is_active" onLabel="On" offLabel="Off" />
                                <label id="is_active" class="mb-0 text-gray-500">Active</label>
                            </div>
                            <span class="flex text-xs text-gray-600 mt-2">If not checked this record will be disabled.</span>
                        </div>

                        <div class="flex flex-col">
                            <label class="form-label mb-2">Service Districts</label>
                            <multiselect
                                v-model="form.district_id"
                                :options="districts"
                                valueProp="id"
                                label="name"
                                placeholder="Select Parent District"
                            />
                        </div>
                        <text-input id="name" type="text" label="Area Name" v-model="form.name" />
                        <textarea-input id="notes" label="Notes" rows="5" v-model="form.notes" />
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
import AppHead from "../../../Shared/AppHead";
import CRMLayout from "../../../../Layouts/CRMLayout";
import Navigation from "../../Navigation";
import ServiceSpotsNav from "../ServiceSpotsNav";

import { ref } from "vue";
import { Link, useForm } from '@inertiajs/inertia-vue3';
import Toggle from '@vueform/toggle';
import Multiselect from '@vueform/multiselect';
import TextInput from "../../../Shared/components/TextInput";
import TextareaInput from "../../../Shared/components/TextareaInput";
import Dialog from "../../../Shared/components/Dialog";

export default {
    layout: CRMLayout,
    components: {
        AppHead,
        Navigation,
        ServiceSpotsNav,
        Link,
        TextInput,
        TextareaInput,
        Toggle,
        Multiselect,
        ConfirmDialog: Dialog
    },
    props: {
        area: Object,
        districts: Object
    },
    setup(props) {
        const volumeOn = ref(false);
        const form = useForm({
            id: props.area.id,
            is_active: props.area.is_active === 1,
            name: props.area.name,
            district_id: props.area.district_id,
            notes: props.area.notes,
            remember: true
        })
        function submit() {
            form.post(route('system.definitions.spots.areas.update', form.id), form)
        }
        function destroy() {
            form.delete( route('system.definitions.spots.areas.destroy', form.id),  { preserveScroll: true })
        }
        return { volumeOn ,form, submit, destroy }
    }
}
</script>

<style scoped>

</style>
