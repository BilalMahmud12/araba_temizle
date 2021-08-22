<template>
    <div class="min-h-screen">
        <Toast />
        <app-header/>
        <slot/>
        <AppFooter />
    </div>
</template>

<script>
import AppHeader from "../System/Shared/AppHeader";
import AppFooter from "../System/Shared/AppFooter";
import Toast from "../System/Shared/components/Toast";
export default {
    name: "CRMLayout",
    components: {
        AppHeader,
        AppFooter,
        Toast
    }
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
<style src="@vueform/toggle/themes/default.css"></style>

<style scoped>

</style>
