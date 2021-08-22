<template>
    <div class="h-full">
        <app-head title="Service Package Categories" />
        <Navigation/>
        <PackagesNav />

        <!--datatable Heading-->
        <div class="app-container py-3">
            <div class="px-4 py-3 bg-white border border-gray-200 flex items-center justify-between">
                <div class="flex items-center">
                    <span class="material-icons mr-2 text-[#1a8f36]">folder_open</span>
                    <span class="text-lg text-[#1a8f36]">Package Categories</span>
                </div>
                <div class="search ml-auto">
                    <search-input v-model="params.search"/>
                </div>
                <div class="create ml-4">
                    <Link :href="route('system.definitions.package-categories.create')" as="button" type="button" class="btn-primary flex items-center">
                        <span class="material-icons mr-2">add_circle</span>
                        <span>Add New</span>
                    </Link>
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
                                <td>
                                    <div class="status-active" v-if="record.is_active === 1">Active</div>
                                    <div class="status-inactive" v-if="record.is_active === 0">Inactive</div>
                                </td>
                                <td>{{ record.name }}</td>
                                <td>{{ record.notes }}</td>
                                <td class="flex items-center justify-center">
                                    <Link :href="route('system.definitions.package-categories.show', record.id)" as="button" type="button">
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
</template>

<script>
import AppHead from "../../../Shared/AppHead";
import Layout from "@/Layouts/CRMLayout";
import Navigation from "../../Navigation";
import PackagesNav from "../PackagesNav";
import { Link } from '@inertiajs/inertia-vue3';
import TextInput from "../../../Shared/components/TextInput";
import DataTable from "../../../Shared/components/DataTable";
import Pagination from "../../../Shared/components/Pagination";
import SearchInput from "../../../Shared/components/SearchInput";
export default {
    layout: Layout,
    components: {
        AppHead,
        Navigation,
        PackagesNav,
        Link,
        DataTable,
        Pagination,
        TextInput,
        SearchInput
    },
    props : {
        records: Object,
        filters: Object
    },
    data() {
        let sortOrders = {};
        let columns = [
            { name: 'id', label: 'ID', width: '5%' },
            { name: 'is_active', label: 'Status', width: '5%' },
            { name: 'name', label: 'Package Category', width: '25%' },
            { name: 'notes', label: 'Notes', width: '' },
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
                search: this.filters.search,
                column: this.filters.column,
                direction: this.filters.direction,
                perPage: this.filters.perPage != null ? this.filters.perPage : 5,
                page: this.filters.page
            }
        }
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
        }
    },
    watch: {
        params: {
          handler() {
              this.$inertia.get(this.route('system.definitions.package-categories.index'), this.params, { replace: true, preserveState: true });
          },
          deep: true
      }
    },
}
</script>

<style scoped>

</style>
