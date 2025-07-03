<script setup>
    import { X } from 'lucide-vue-next';
    import { ref } from 'vue';
    RegisterWorker();

    const { translation } = defineProps(['translation'])
    
    const close_popup = () => ShowPopup.value = false;

    const ShowPopup = ref(true);
</script>

<template>
    <div
        v-if="ShowPopup" 
        id='InstallPWA'
        class="p-3 user-select-none"
    >
        <div 
            class="w-100 p-2 flex justify-end align-center"
        >
            <X class="pointer" @click="close_popup" />
        </div>
        <div
            class="flex justify-start align-start gap-5"
        >
            <img src="/assets/ico/ico.png" alt="">
            <h1
                class="p-0 m-0"
            >
                {{ translation.PWATEXT }}
            </h1>
        </div>
        <div class="w-100 flex justify-end align-center">
            <button class="pointer" id="ConfirmInstallPWA">{{ translation.install }}</button>
        </div>
    </div>
</template>
<style scoped>
    img {
        width: 50px;
        border-radius: 50%;
    }
    #InstallPWA {
        min-width: 10vmin;
        width: fit-content;
        height: fit-content;
        background-color: white;
        position: absolute;
        bottom: 10px;
        right: 10px;
        border-radius: var(--border-radius);
        z-index: 10;
    }

    h1 {
        font-size: 1.2rem;
    }

    #ConfirmInstallPWA {
        background-color: var(--pink);
        border: 0;
        padding: 10px;
        border-radius: var(--border-radius);
        color: var(--white);
        width: 15vmin;
    }


    @media all and (display-mode: standalone) {
        #InstallPWA {
            display: none;
        }
    }

    @media screen and (max-width: 750px) {
        #ConfirmInstallPWA {
            width: 30vmin;
        }
    }
</style>