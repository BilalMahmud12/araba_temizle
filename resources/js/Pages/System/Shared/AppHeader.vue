<template>
    <div class="app-header bg-black py-5">
        <div class="app-container flex items-center">
            <div class="header-left">
                <Link :href="route('system.dashboard')" class="app-brand text-white">
                    Araba Temizle
                    <span class="crm-badge">ERP SYS.</span>
                </Link>
            </div>
            <div class="header-middle">
                <div class="app-nav-links">
                    <ul>
                        <li>
                            <Link
                            :href="route('system.definitions.packages.index')"
                            :class="{ 'active': $page.url.startsWith('/system/definitions/') }"
                            >
                                <span class="material-icons mr-2">assignment</span>
                                <span>Definitions</span>

                            </Link>
                        </li>
                        <li>
                            <Link
                                :href="route('system.clients.index')"
                                :class="isRoute('system.clients.index') ? 'active' : ''"
                            >
                                <span class="material-icons mr-2">group</span>
                                <span>Clients</span>
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/">
                                <span class="material-icons mr-2">work</span>
                                <span>Jobs</span>
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/">
                                <span class="material-icons mr-2">inventory</span>
                                <span>Inventory</span>
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/">
                                <span class="material-icons mr-2">settings</span>
                                <span>Settings</span>
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/">
                                <span class="material-icons mr-2">computer</span>
                                <span>Website</span>
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="header-right">
                <div class="app-notifications">
                    <div class="dropdown-title">
                        <span class="material-icons">notifications_none</span>
                        <span class="notifications-count">10</span>
                    </div>
                    <div class="dropdown-list"></div>
                </div>
                <div class="app-user-nav">
                    <div class="dropdown">
                        <div class="dropdown-title user-name" @click="toggle" v-click-away="away">
                            <span>{{ $page.props.auth.user.name }}</span>
                            <span class="material-icons">keyboard_arrow_down</span>
                        </div>
                        <div id="user-drop-menu" class="dropdown-list" v-if="active === true">
                            <ul>
                                <li><Link href="/">My Account</Link></li>
                                <li><Link href="/">System Users</Link></li>
                                <li><Link href="/">System Settings</Link></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    name: "AppHeader",

    components: {
        Link
    },
    data() {
        return {
            active: false,

        }
    },
    methods: {
        toggle() {
            this.active = !this.active
        },
        away(){
            this.active = false
        },
    }
}
</script>

<style  scoped>

</style>
