<template>
    <div class="flex flex-col">
        <label v-if="label" class="form-label" :for="id">{{ label }}</label>
        <select :id="id" v-model="selected" @change="$emit('update:selected', $event.target.value)">
            <option value="" disabled hidden> -- Select Package Category --</option>
            <option v-for="record in options" :value="record.id">{{ record.name }}</option>
        </select>
    </div>
</template>

<script>
export default {
    name: "SelectInput",
    props: {
        id: String,
        label: String,
        error: String,
        selected: Object,
        options: Object
    },
}
</script>

<style scoped>

</style>
