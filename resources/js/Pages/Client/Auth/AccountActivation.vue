<template>
    <div class="min-h-[calc(100vh-65px)]">
        <app-head title="Activate Your Account" />
        <div class="px-4 max-w-xl py-8 mx-auto">
            <div class="form-card bg-white shadow py-8 mb-8">
                <div class="form-group pb-6 mb-6 border-b border-gray-200">
                    <div class="group-title px-8 mb-4 text-lg text-accent flex">Activation</div>
                    <div class="group-input px-8">
                        <text-input label="Activation Code" id="activation_code" type="number" v-model="received_code" />

                        <button type="button" class="mt-4 text-sm text-main">
                            <span>Resend Activation Code?</span>
                        </button>
                    </div>
                </div>
                <div class="form-group px-8">
                    <div class="flex items-center justify-between">
                        <Link href="#" as="button" type="button" class="px-6 py-2 text-white bg-accent" @click="returnBack">
                            <span>Back</span>
                        </Link>
                        <button type="button" class="ml-auto px-6 py-2 text-white bg-main" @click="checkForActivation">
                            <span>Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppHead from "../Shared/AppHead";
import ClientLayout from "../../Layouts/ClientLayout";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import TextInput from "../../System/Shared/components/TextInput";
import {Inertia} from "@inertiajs/inertia";
export default {
    name: "AccountActivation",
    layout: ClientLayout,
    components: {
        AppHead,
        Link,
        TextInput
    },
    props: {
        client: Object,
        activation_code: Intl
    },
    data() {
        return {
            received_code: null
        }
    },
    methods:{
        returnBack() {
            window.history.back();
        },
        checkForActivation() {
            if (this.received_code === this.$page.props.activation_code) {
                Inertia.post(route('client.activate-client', this.$page.props.client.id))
            } else {
                alert('false code try again')
            }
        }
    }
}
</script>

<style scoped>

</style>
