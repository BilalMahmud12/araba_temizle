<template>
    <div class="layout-container bg-gray-100">
        <app-header/>
        <slot/>
        <AppFooter />
    </div>
</template>

<script>
import ClientAppHeader from "../Client/Shared/ClientAppHeader";
import ClientAppFooter from "../Client/Shared/ClientAppFooter";
export default {
    name: "ClientLayout",
    components: {
        AppHeader : ClientAppHeader,
        AppFooter: ClientAppFooter
    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
<style src="@vueform/toggle/themes/default.css"></style>
<style scoped>

</style>
