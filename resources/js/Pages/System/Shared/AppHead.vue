<template>
    <app-head :title="title ? `${title} | Araba Temizle ERP` : 'Araba Temizle ERP'">
        <slot />
    </app-head>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
export default {
    components: {
        AppHead: Head,
    },
    props: {
        title: String,
    },
}
</script>

<style scoped>

</style>
