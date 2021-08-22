<template>
    <transition name="slide-fade">
        <div v-if=" $page.props.flash.success && showToast " class="toast-note absolute flex items-center max-w-xs py-2 px-4 bg-white shadow rounded-md">
            <div class="icon mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-color text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="message mr-4 text-sm text-gray-600">
                {{ $page.props.flash.success }}
            </div>
            <div class="close">
                <button type="button" class="flex items-center" @click="showToast = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-color text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            showToast: false
        }
    },
    watch: {
        '$page.props.flash.success' : {
            handler() {
                this.showToast = true;
                setTimeout(() => this.showToast = false, 5000);
            },
            deep: true
        }
    }
}
</script>

<style scoped>
.toast-note {
    top: 15px;
    right: 15px;
    z-index: 9999;
}
.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>
