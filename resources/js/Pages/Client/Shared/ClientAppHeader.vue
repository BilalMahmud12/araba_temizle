<template>
    <div class="header bg-white py-3 shadow">
        <div class="header-wrapper flex flex-col md:flex-row items-center justify-between px-6 md:px-8">
            <div class="header-left">
                <a :href="route('client.signup')" class="flex items-center">
                    <img src="/site/images/araba_temizle_logo.svg"
                         alt="araba-temizle-logo"
                         width="112" height="41"
                         class="mr-4 pr-4 border-r border-gray-200"
                    >
                    <span class="">Create Account</span>
                </a>

            </div>
            <div class="header-right">
                <Link href="/" class="flex items-center px-4 py-1.5 rounded-md border-2 border-main text-sm">
                    <span class="material-icons mr-3 text-main">west</span>
                    <span class="text-gray-500">Back To Home Page</span>
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
