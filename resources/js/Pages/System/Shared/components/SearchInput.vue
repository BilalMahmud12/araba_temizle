<template>
    <input type="search" placeholder="Search ..."
           class="form-input"
           :value="modelValue"
           @input="$emit('update:modelValue', $event.target.value)"
    >
</template>

<script>
export default {
    name: "SearchInput",
    props: {
        modelValue: String
    }
}
</script>

<style scoped>

</style>
