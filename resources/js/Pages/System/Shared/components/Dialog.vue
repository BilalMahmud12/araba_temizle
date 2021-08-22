<template>
    <transition name="fade">
        <div class="modal-overlay overlay flex items-center justify-center" v-if="showDialog">
            <div class="dialog-card w-1/3 px-6 py-8 bg-white shadow">
                <div class="dialog-body flex items-center mb-6">
                <span class="mr-2 p-2 rounded-full bg-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </span>
                    <span class="text-gray-500">
                    Are you sure you want to delete this record ?
                </span>
                </div>
                <div class="dialog-footer flex items-center justify-content-end">
                    <button type="button" class="btn-default ml-auto" @click="showDialog = false">Cancel</button>
                    <button type="button" class="btn-warning ml-3" @click="$emit('destroy')">Delete</button>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            showDialog: false
        }
    },
    methods: {
        openDialog() {
            this.showDialog = true
        },
        closeDialog() {
            this.showDialog = false
        }
    }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>
