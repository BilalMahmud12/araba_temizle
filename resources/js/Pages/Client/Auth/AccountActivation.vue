<template>
    <div>
        <app-head title="Activate Your Account" />
    </div>
</template>

<script>
import AppHead from "../Shared/AppHead";
import ClientLayout from "../../Layouts/ClientLayout";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import TextInput from "../../System/Shared/components/TextInput";
export default {
    name: "AccountActivation",
    layout: ClientLayout,
    components: {
        AppHead,
        Link,
        TextInput
    }
}
</script>

<style scoped>

</style>
