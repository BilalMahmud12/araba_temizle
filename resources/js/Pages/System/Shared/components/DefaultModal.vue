<template>
    <transition name="fade">
        <div class="default-modal" v-if="showModal">
            <div class="modal-overlay"></div>
            <div class="modal-container">
                <div class="modal-header">
                    <div class="modal-title"><slot name="modal-title" /></div>
                    <button type="button" @click="closeModel">
                        <span class="material-icons text-gray-500 hover:text-black p-1">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot name="modal-body" />
                </div>
                <div class="modal-footer mt-auto">
                    <slot name="modal-footer" />
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    name: "DefaultModal",
    components: {
        Link
    },
    data() {
        return {
            showModal: false
        }
    },
    methods: {
        openModal() {
            this.showModal = true;
            document.querySelector("body").classList.add("overflow-hidden");
        },
        closeModel() {
            this.showModal = false;
            document.querySelector("body").classList.remove("overflow-hidden");
        }
    }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: all .5s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>

