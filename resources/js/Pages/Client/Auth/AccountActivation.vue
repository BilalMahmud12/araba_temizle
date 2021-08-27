<template>
    <div class="min-h-[calc(100vh-65px)]">
        <app-head title="Activate Your Account" />
        <div class="bg-white py-4 shadow">
            <div class="flex items-center justify-between px-6 md:max-w-5xl mx-auto">
                <div class="step-title text-xl md:text-2xl font-bold text-gray-600">Create Account</div>
            </div>
        </div>

        <div class="px-4 max-w-xl py-6 mx-auto">
            <div class="step-indicator py-6 px-6 bg-white shadow border-b border-gray-200">
                <div class="indicator-bar h-2 w-full bg-gray-100 shadow-inner mb-4">
                    <div class="w-[50%] h-full bg-main"></div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="step-title flex items-center space-x-2">
                        <span class="material-icons text-gray-300">verified_user</span>
                        <span class="text-main ">Account Activation</span>
                    </div>
                    <div class="step-count text-xs text-white flex items-center">
                        <span class="px-2 py-1 border-r border-white bg-gray-100 text-main">Step</span>
                        <span class="px-3 py-1 border-r border-white bg-main">2 / 4</span>
                    </div>
                </div>
            </div>
            <div class="form-card bg-white shadow pt-4 mb-8">
                <div class="form-group pb-6 mb-4 border-b border-gray-200">
                    <div class="group-input px-8">
                        <text-input label="Activation Code" id="activation_code" type="number" v-model="received_code" />

                        <button type="button" class="mt-4 text-sm text-main">
                            <span>Resend Activation Code?</span>
                        </button>
                    </div>
                </div>
                <div class="form-group px-8 pb-4">
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
