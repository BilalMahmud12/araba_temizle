<template>
    <div class="header bg-gray-700 py-3">
        <div class="px-6 md:max-w-5xl mx-auto flex items-center justify-between">
            <div class="header-left">
                <a :href="route('client.signup')" class="flex items-center">
                    <img src="/site/images/araba_temizle_logo_light.svg"
                         alt="araba-temizle-logo"
                         width="112" height="41"
                    >
                </a>

            </div>
            <div class="header-right">
                <Link href="/" class="flex items-center px-4 py-1.5 rounded-md bg-gray-600 text-sm">
                    <span class="material-icons text-white mr-2">person</span>
                    <span class="text-white">Login</span>
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
export default {
    name: "ClientAppHeader",
    components: {
        Link
    }
}
</script>

<style scoped>

</style>
