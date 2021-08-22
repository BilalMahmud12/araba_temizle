<template>
    <div class="section-nav">
        <div class="app-container">
            <ul class="section-nav-list">
                <li>
                    <span class="material-icons">app_registration</span>
                </li>
                <li>
                    <Link :href="route('system.definitions.spots.service-spots.index')"
                          :class="{ 'active': $page.url.startsWith('/system/definitions/spots/service-spots/') }"
                    >
                        <span class="material-icons mr-2 text-gray-300">topic</span>
                        <span>Service Spots</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('system.definitions.spots.service-spot-type.index')"
                          :class="{ 'active': $page.url.startsWith('/system/definitions/spots/service-spot-type') }"
                    >
                        <span class="material-icons mr-2 text-gray-300">topic</span>
                        <span>Service Spot Types</span>

                    </Link>
                </li>
                <li>
                    <Link :href="route('system.definitions.spots.districts.index')"
                          :class="{ 'active': $page.url.startsWith('/system/definitions/spots/districts') }"
                    >
                        <span class="material-icons mr-2 text-gray-300">topic</span>
                        <span>Districts</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('system.definitions.spots.areas.index')"
                          :class="{ 'active': $page.url.startsWith('/system/definitions/spots/areas') }"
                    >
                        <span class="material-icons mr-2 text-gray-300">topic</span>
                        <span>Areas</span>
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    name: "ServiceSpotsNav",
    components: {
        Link
    }
}
</script>

<style scoped>

</style>
