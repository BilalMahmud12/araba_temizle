<template>
    <div class="group-nav bg-[#262626]">
        <div class="app-container">
            <ul class="group-nav-list">
                <li>
                    <Link
                        :href="route('system.definitions.packages.index')"
                        :class="{ 'active': $page.url.startsWith('/system/definitions/packages/') || $page.url.startsWith('/system/definitions/package-categories/') } "
                    >
                        Service Packages
                    </Link>
                </li>
                <li>
                    <Link
                        :href="route('system.definitions.spots.service-spots.index')"
                        :class="{'active': $page.url.startsWith('/system/definitions/spots/')}"
                    >
                        Service Spots
                    </Link>
                </li>
                <li>
                    <Link
                        :href="route('system.definitions.contracts.index')"
                        :class="{ 'active': $page.url.startsWith('/system/definitions/contracts/') } "
                    >
                        Service Contracts
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    name: "Navigation",
    components: {
        Link
    }
}
</script>

<style scoped>

</style>
