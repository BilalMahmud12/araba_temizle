<template>
    <div class="relative min-h-screen">
        <div class="step-intro">
            <div class="signup-header relative h-48">
                <div class="overlay"></div>
                <div class="bg-photo">
                    <img src="/site/images/Car-Wash-Spring-Cleaning.jpg" alt="">
                </div>
                <div class="relative header-top flex items-center z-30 px-4 py-6">
                    <a href="/" class="flex p-1.5 rounded-md bg-white/30">
                        <span class="material-icons text-white">west</span>
                    </a>
                </div>
                <div class="signup-header-middle relative z-30 px-4 py-6 flex justify-center">
                    <h1 class="text-white font-bold text-3xl text-center">Create Account</h1>
                </div>
            </div>
            <div class="signup-body">
                <div class="px-4 py-6 flex items-center justify-center">
                    <img src="/site/images/araba_temizle_logo.svg" alt="" width="130px">
                </div>
                <div class="px-4 mx-6 py-2 terms-agree-container h-64 overflow-scroll rounded-lg shadow">
                    <div class="content">
                        <p>
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

                            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                        </p>
                    </div>
                </div>
                <div class="signup-afterbody px-4 py-6 mx-2">
                    <div class="flex items-center justify-center">
                        <a href="" class="w-full text-center bg-main px-4 py-2 text-white rounded-lg">
                            <span> I Agree and Want to Continue </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="step-1"></div>
        <div class="step-2"></div>
        <div class="step-3"></div>
        <div class="step-14"></div>
    </div>
</template>

<script>
export default {
    name: "SignUp",
    data() {
        return {
            showStepOne: false,
            showStepTwo: false,
            showStepThree: false,
            showStepFour: false,
        }
    },
    methods: {
        moveToStepOne() {},
        moveToStepTwo() {},
        moveToStepThree() {},
        moveToStepFour() {}
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
    z-index: 1;
    background: rgba(0,0,0,0.6);
}
.bg-photo {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}
.bg-photo > img {
    object-fit: cover;
    object-position: center;
    width: 100%;
    height: 100%;
}
</style>
