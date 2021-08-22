<template>
    <transition name="fade" :id="id">
        <div v-if="showModal">
            <div class="overlay"></div>
            <div class="modal-card shadow-lg">
                <div class="modal-header bg-main text-white flex items-center justify-between">
                    <span class="modal-title">{{ title }}</span>
                    <button type="button" @click="closeModal">
                        <span class="material-icons text-white p-1">close</span>
                    </button>
                </div>
                <div class="modal-body bg-white">
                    <slot name="modal-body" />
                </div>
                <div class="modal-footer bg-gray-100 flex items-center">
                    <slot name="modal-footer" />
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import Link from '@inertiajs/inertia-vue3';
export default {
    name: "FormModal",
    components: {
      Link
    },
    data() {
        return {
            showModal: false
        }
    },
    props: {
        id: String,
        title: String
    },
    methods: {
        openModal() {
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        }
    }
}
</script>

<style scoped>
.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
    background: rgba(0,0,0,0.8);
}
.modal-card {
    position: absolute;
    top: 50%;
    left: 52%;
    transform: translate(-52%, -0%) translateZ(0);
    -webkit-font-smoothing: subpixel-antialiased;
    z-index: 100;
    width: 40vw;
}

.fade-enter-active {
    transition: 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    transition: 0.5s ease-out;
    opacity: 0;
}

</style>
