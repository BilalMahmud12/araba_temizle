<template>
    <table class="dataTable">
        <thead>
            <tr>
                <th v-for="column in columns"
                    :key="column.name"
                    @click="$emit('sort', column.name)"
                    :class="sortKey === column.name ? ( sortOrders[column.name] > 0 ? 'sort_asc' : 'sort_desc' ) : 'sorting'"
                    :style=" 'width:' +column.width+ ';' + 'cursor:pointer' "
                >
                    {{ column.label }}
                </th>
            </tr>
        </thead>
        <slot name="datatable-body" />
    </table>
</template>

<script>
export default {
    name: "DataTable",
    props: {
        'columns': Array,
        'sortKey' : String,
        'sortOrders' : Object
    },
    emits: ['sort']
}

</script>

<style scoped>

</style>
