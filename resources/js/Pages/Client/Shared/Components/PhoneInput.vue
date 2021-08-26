<template>
    <div class="flex flex-col">
        <label v-if="label" class="form-label" :for="id">{{ label }}</label>
        <input :id="id" :type="type" :value="modelValue"
               class="form-input phone-input pl-10"
               :class="{ error: error }"
               ref="input"
               @input="$emit('update:modelValue', $event.target.value)"
               :placeholder="placeholder"
               @keyup="getCountryData"
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

        getCountryData() {
            this.countryData = this.phoneNumber.getSelectedCountryData()
        }

    },
    data() {
        return {
            countryData: null,
            phoneNumber: null
        }
    },
    mounted() {
        const phoneInput = document.querySelector("#phone");
        this.phoneNumber = window.intlTelInput(phoneInput, {
            nationalMode: true,
            separateDialCode: true,
            initialCountry: 'TR',
            utilsScript: "/js/utils.js?1613236686837"
        })
        this.getCountryData()
    }
}
</script>


<style scoped>
.phone-input {
    padding-left: 95px !important;
}
</style>
