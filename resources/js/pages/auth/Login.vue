<script setup lang="ts">
    import AuthCard from '@/components/generic/AuthCard.vue';;
    import Input from '@/components/generic/inputs/Text.vue';
    import { ref, onMounted } from 'vue';
    import { doFetch } from '@/composables/doFetch';
    import { Check } from 'lucide-vue-next';
    import Button from '@/components/generic/Button.vue';
    import { useLanguage } from '@/composables/useLanguage';
import { Head } from '@inertiajs/vue3';

    const { lang } = defineProps(['lang']);
    const loading = ref(true);
    let translation = ref({});

    onMounted(async () => {
        translation.value = await useLanguage(lang, 'generic');
        loading.value = false;
    });

    const log_in = async ({missing_password, missing_email, invalid_credentials}) => {
        if(email.value.trim() === '') return ErrorMessage.value = missing_email;
        if(password.value.trim() === '') return ErrorMessage.value = missing_password;

        IsButtonDisabled.value = true;
        const { code, redirect } = await doFetch('/login', 'POST', { email: email.value.trim(), password: password.value.trim() }); 
        if(code !== 200) {
            IsButtonDisabled.value = false;
            return ErrorMessage.value = invalid_credentials;
        }
        
        location.href = `/${lang}/${redirect}`;
    };

    const email = ref('');
    const password = ref('');

    const IsButtonDisabled = ref(false);
    const ErrorMessage = ref('');
</script>

<template>
    <Head :title="translation.page_login" />
    <AuthCard>
        <form 
            id='login-form' 
            action="/login" 
            method="POST"
            class="w-100 h-100 flex justify-center align-center"
            @submit.prevent="log_in(translation)"
        >
            <div class="container flex justify-center align-center direction-column gap-2">
                <h1 class="p-1 login-title">{{ translation.signin }}</h1>
                <Input :update="(value: string) => email = value" type="text" :label="translation.email" :placeholder="translation.email" />
                <Input :update="(value: string) => password = value" type="password" :label="translation.password" placeholder="*****" />
                <div class="w-100 flex justify-center align-start direction-column gap-2">
                    <span class="text-red">{{ErrorMessage}}</span>
                    <Button :disabled="IsButtonDisabled" palette="light-danger">
                        <span class='flex justify-center align-center gap-2'>
                            <Check />
                            {{ translation.signin }}
                        </span>
                    </Button>
                </div>
            </div>
        </form>
    </AuthCard>
</template>

<style scoped>
    .login-title {
        margin: 0;
    }

    .container {
        width: 70%;
    }

    @media screen and (max-width: 750px) {
        .container {
            width: 100%;
        }
    }
</style>
