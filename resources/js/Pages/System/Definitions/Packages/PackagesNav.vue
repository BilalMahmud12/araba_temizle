<template>
    <div class="section-nav">
        <div class="app-container">
            <ul class="section-nav-list">
                <li>
                    <span class="material-icons">app_registration</span>
                </li>
                <li>
                    <Link :href="route('system.definitions.packages.index')"
                          :class="{ 'active': $page.url.startsWith('/system/definitions/packages/') }"
                    >
                        <span class="material-icons mr-2 text-gray-300">topic</span>
                        <span>Service Packages</span>

                    </Link>
                </li>
                <li>
                    <Link :href="route('system.definitions.package-categories.index')"
                          :class="{ 'active': $page.url.startsWith('/system/definitions/package-categories/') }"
                    >
                        <span class="material-icons mr-2 text-gray-300">topic</span>
                        <span>Package Categories</span>
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    name: "PackagesNav",
    components: {
        Link
    }
}
</script>

<style scoped>

</style>
