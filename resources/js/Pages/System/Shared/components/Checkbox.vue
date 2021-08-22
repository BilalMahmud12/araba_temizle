<template>
    <div>
        <div class="flex items-center">
            <input :id="id" type="checkbox" :checked="checked" @input="$emit('update:checked', $event.target.checked)">
            <label :for="id" class="mb-0 ml-4">{{ label }}</label>
        </div>
        <span v-if="comment" class="flex text-xs text-gray-400 ml-8 mt-2">{{ comment }}</span>
    </div>

</template>

<script>
export default {
    props: {
        id: String,
        label: String,
        checked: Boolean,
        comment: String,
    }
}
</script>

<style scoped>

</style>
