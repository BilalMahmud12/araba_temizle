<template>
    <div class="min-h-screen">
        <app-head title="Update Service Spot Type" />
        <Navigation />
        <ServiceSpotsNav />
        <div class="app-container py-3">
            <div class="px-4 py-3 bg-white border border-gray-200 flex items-center justify-between">
                <div class="flex items-center">
                    <span class="material-icons mr-2 text-gray-300">description</span>
                    <span class="text-lg text-[#1a8f36]">Update Service Spot :   {{ form.name }}</span>
                </div>
                <div class="submit-area flex justify-content-end">
                    <Link type="button" as="button" :href="route('system.definitions.spots.service-spots.index')" class="btn-default">
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
                                searchable="true"
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
                                searchable="true"
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

        <div class="bg-gray-100 py-8 mt-6">
            <!--datatable Heading-->
            <div class="app-container py-3">
                <div class="px-4 py-3 bg-white border border-gray-200 flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="material-icons mr-2 text-[#1a8f36]">folder_open</span>
                        <span class="text-lg text-[#1a8f36]">Service Spot Building Blocks</span>
                    </div>

                    <div class="create ml-auto ml-4">
                        <button class="btn-primary flex items-center" type="button" @click.prevent="$refs.addBlockModal.openModal()">
                            <span class="material-icons mr-2">add_circle</span>
                            <span>Add New</span>
                        </button>
                    </div>
                </div>
            </div>

            <!--datatable-->
            <div class="app-container">
                <div class="p-4 bg-white border border-gray-200">
                    <data-table :columns="columns" :sort-key="sortKey" :sort-orders="sortOrders" v-on:sort="sort">
                        <template v-slot:datatable-body>
                            <tbody>
                            <tr v-for="record in records.data" :key="record.id">
                                <td>{{ record.id }}</td>
                                <td>{{ record.name }}</td>
                                <td>{{ record.notes }}</td>
                                <td class="flex items-center justify-center">
                                    <Link :href="route('system.definitions.spots.service-spots.show', record.id)" as="button" type="button">
                                        <span class="material-icons p-1.5 rounded-full text-main bg-gray-100 hover:bg-main hover:text-white transition ease-in-out">
                                            keyboard_arrow_right
                                        </span>
                                    </Link>
                                </td>
                            </tr>
                            </tbody>
                        </template>

                    </data-table>
                    <div class=" px-6 py-4 bg-gray-100 flex items-center justify-center text-gray-500 text-sm" width="100%" v-if="records.data.length < 1">
                        No Records found in database.
                    </div>
                </div>
                <div class="flex Items-center justify-between mt-3 p-4 bg-white border border-gray-200">
                    <select
                        class="table-records-count"
                        style="font-weight: 300"
                        v-model="params.perPage"
                        @change="GetPageRecords">
                        <option value="5">5 Results</option>
                        <option value="10">10 Results</option>
                        <option value="25">25 Results</option>
                        <option value="50">50 Results</option>
                        <option value="100">100 Results</option>
                    </select>
                    <Pagination :records="records" class="ml-auto" />
                </div>
            </div>
        </div>
        <form-modal title="Add Building Block" ref="addBlockModal" id="addBlockModal">
            <template v-slot:modal-body>
                <form>
                    <div class="grid grid-cols-1 gap-6 mb-3">
                        <text-input id="block_name" type="text" label="Building/Block Name" v-model="blocksCreateForm.name" />
                    </div>
                    <div class="grid grid-cols-1 gap-6">
                        <textarea-input id="block_notes" label="Notes" rows="3" v-model="blocksCreateForm.notes" />
                    </div>
                </form>
            </template>
            <template v-slot:modal-footer>
                <button type="submit" class="btn-primary ml-auto flex items-center" @click.prevent="createBlock">
                    <span class="material-icons mr-3">save</span>
                    <span>Update</span>
                </button>
            </template>
        </form-modal>
    </div>
</template>

<script>
import AppHead from "../../../Shared/AppHead";
import Layout from "@/Layouts/CRMLayout";
import Navigation from "../../Navigation";
import ServiceSpotsNav from "../ServiceSpotsNav";

import {createBlock, ref} from "vue";
import { Link, useForm } from '@inertiajs/inertia-vue3';
import TextInput from "../../../Shared/components/TextInput";
import TextareaInput from "../../../Shared/components/TextareaInput";
import Toggle from '@vueform/toggle';
import Multiselect from '@vueform/multiselect';
import Dialog from "../../../Shared/components/Dialog";

import DataTable from "../../../Shared/components/DataTable";
import Pagination from "../../../Shared/components/Pagination";
import FormModal from "../../../Shared/components/FormModal";
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
        Multiselect,
        DataTable,
        Pagination,
        ConfirmDialog: Dialog,
        FormModal
    },
    props: {
        serviceSpot: Object,
        spotTypes: Object,
        areas: Object,
        records: Object,
        filters: Object
    },
    data() {
        let sortOrders = {};
        let columns = [
            { name: 'id', label: 'ID', width: '5%' },
            { name: 'name', label: 'Building / Block', width: '20%' },
            { name: 'notes', label: 'Notes', width: '15%' },
            { name: 'action', label: '', width: '5%' },
        ];
        columns.forEach((column) => {
            sortOrders[column.name] = -1;
        } )
        return {
            columns : columns,
            sortKey: 'id',
            sortOrders: sortOrders,
            tableData: {
                length: 5,
                column: 0,
                dir: 'desc'
            },
            params: {
                column: this.filters.column,
                direction: this.filters.direction,
                perPage: this.filters.perPage != null ? this.filters.perPage : 5,
                page: this.filters.page
            }
        }
    },
    setup(props) {
        const volumeOn = ref(false);
        const form = useForm({
            id: props.serviceSpot.id,
            is_active: props.serviceSpot.is_active === 1,
            name: props.serviceSpot.name,
            spot_type_id: props.serviceSpot.spot_type_id,
            area_id: props.serviceSpot.area_id,
            notes: props.serviceSpot.notes,
            remember: true
        })

        function submit() {
            form.post(route('system.definitions.spots.service-spots.update', form.id), form)
        }
        function destroy() {
            form.delete( route('system.definitions.spots.service-spots.destroy', form.id),  { preserveScroll: true })

        }

        const blocksCreateForm = useForm({
            is_active: volumeOn,
            service_spot_id: props.serviceSpot.id,
            name: null,
            notes: null,
            remember: true
        })
        function createBlock() {
            blocksCreateForm.post(route('system.definitions.spots.service-building-blocks.store'),  {
                blocksCreateForm ,
                preserveScroll: true
            })
        }
        return { volumeOn ,form, blocksCreateForm, submit, destroy, createBlock }
    },
    methods: {
        sort: function (columnName) {
            this.sortKey = columnName
            if ( this.sortOrders[this.sortKey] > 0 ) {
                this.sortOrders[this.sortKey] = -1
            } else {
                this.sortOrders[this.sortKey] = 1
            }

            this.params.column = columnName
            this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc'
        },
        GetPageRecords(event) {
            this.params.perPage = event.target.value;
            this.params.page = 1
        },
    },
    watch: {
        params: {
            handler() {
                this.$inertia.get(this.route('system.definitions.spots.service-spot-type.index'), this.params, { replace: true, preserveState: true });
            },
            deep: true
        }
    },
}
</script>

<style scoped>

</style>
