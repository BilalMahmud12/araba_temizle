<template>
    <div class="flex flex-col">
        <label v-if="label" class="form-label" :for="id">{{ label }}</label>
        <textarea :id="id" ref="input" v-bind="$attrs" class="form-textarea" :class="{ error: error }" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        id: {
            type: String,
        },
        modelValue: String,
        label: String,
        error: String,
    },
    emits: ['update:modelValue'],
    methods: {
        focus() {
            this.$refs.input.focus()
        },
        select() {
            this.$refs.input.select()
        },
    },
}
</script>
