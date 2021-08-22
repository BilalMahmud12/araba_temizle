<template>
    <div class="flex items-center">
        <nav class="flex items-center ml-auto space-x-1">

            <span class="text-xs text-gray-500 border border-gray-300 h-10 px-3 flex items-center justify-center">Total :  {{ records.total }}  Records</span>

            <Link v-if="records.current_page > 1" :href="records.first_page_url" as="button" class="flex items-center justify-center text-sm h-10 w-10 border border-gray-300 hover:text-green-600 hover:bg-green-50" preserve-scroll>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414zm-6 0a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L5.414 10l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
            </Link>

            <Link v-if="records.current_page > 1" :href="records.prev_page_url" as="button" class="flex items-center justify-center text-sm h-10 w-10 border border-gray-300 hover:text-green-600 hover:bg-green-50" preserve-scroll>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            </Link>
            <div class="flex items-center justify-center text-sm h-10 w-10 border border-gray-300">
                <span>{{ records.current_page }}</span>
            </div>

            <span class="flex text-xs text-gray-500 border border-gray-300 h-10 px-3 flex items-center justify-center">of {{ records.last_page }} Pages</span>

            <Link v-if="records.next_page_url" :href="records.next_page_url" as="button" class="flex items-center justify-center text-sm h-10 w-10 border border-gray-300 hover:text-green-600 hover:bg-green-50" preserve-scroll>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-color text-gray-500 hover:text-green-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            </Link>

            <Link v-if="records.next_page_url" :href="records.last_page_url" as="button" class="flex items-center justify-center text-sm h-10 w-10 border border-gray-300 hover:text-green-600 hover:bg-green-50" preserve-scroll>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                         <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            </Link>
        </nav>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    name: "Pagination",
    props: {
        records: Object,
    },
    components: {
        Link
    },
    methods: {
        filter_url(url){
            if (url != null) {
                return url
            } else {
                return '#'
            }
        }
    }
}
</script>

<style scoped>
nav > button {
    font-weight: 300;
}
nav > button:first-child {
    border-left: 1px solid;
    border-color: rgba(229, 231, 235, var(--tw-border-opacity));
}
.pagination.btn {

}
</style>
