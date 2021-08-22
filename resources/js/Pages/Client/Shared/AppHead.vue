<template>
    <app-head :title="title ? `${title} | Araba Temizle` : 'Araba Temizle'">
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
