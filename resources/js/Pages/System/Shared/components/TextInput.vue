<template>
    <div class="flex flex-col">
        <label v-if="label" class="form-label" :for="id">{{ label }}</label>
        <input :id="id" :type="type" :value="modelValue"
               class="form-input"
               :class="{ error: error }"
               ref="input"
               @input="$emit('update:modelValue', $event.target.value)"
               :placeholder="placeholder"
        >
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<script>

export default {
    inheritAttrs: true,
    props: {
        id: {
            type: String,
        },
        type: {
            type: String,
            default: 'text',
        },
        modelValue: String,
        label: String,
        placeholder: String,
        error: String,
    },
    emits: ['update'],
    methods: {
        focus() {
            this.$refs.input.focus()
        },
        select() {
            this.$refs.input.select()
        },
        setSelectionRange(start, end) {
            this.$refs.input.setSelectionRange(start, end)
        },
    },
}
</script>

<style scoped>

</style>
