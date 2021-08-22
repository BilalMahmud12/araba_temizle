<template>
    <div class="h-full">
        <app-head title="Clients" />
        <Navigation />
        <!--datatable Heading-->
        <div class="app-container py-3">
            <div class="px-4 py-3 bg-white border border-gray-200 flex items-center justify-between">
                <div class="flex items-center">
                    <span class="material-icons mr-2 text-[#1a8f36]">folder_open</span>
                    <span class="text-lg text-[#1a8f36]">Clients</span>
                </div>
                <div class="search ml-auto">
                    <search-input v-model="params.search"/>
                </div>
                <div class="create ml-4">
                    <Link :href="route('system.definitions.contracts.create')" as="button" type="button" class="btn-primary flex items-center">
                        <span class="material-icons mr-2">add_circle</span>
                        <span>Add New</span>
                    </Link>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import AppHead from "../Shared/AppHead";
import CRMLayout from "../../Layouts/CRMLayout";
import Navigation from "./Navigation";

import { Link } from '@inertiajs/inertia-vue3';
import SearchInput from "../Shared/components/SearchInput";
import DataTable from "../Shared/components/DataTable";
import Pagination from "../Shared/components/Pagination";
export default {
    layout: CRMLayout,
    components: {
        AppHead,
        Navigation,
        Link,
        SearchInput,
        DataTable,
        Pagination
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
            { name: 'name', label: 'Service Contract', width: '25%' },
            { name: 'updated_at', label: 'Last Update', width: '40%' },
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
                this.$inertia.get(this.route('system.definitions.contracts.index'), this.params, { replace: true, preserveState: true });
            },
            deep: true
        }
    },
}
</script>

<style scoped>

</style>
