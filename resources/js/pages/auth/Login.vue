<script setup lang="ts">
    import AuthCard from '@/components/base/AuthCard.vue'; '@/components/generic/Card.vue';
    import Input from '@/components/generic/Input.vue';
    import Button from '@/components/generic/Button.vue';
    import { ref } from 'vue';
    import { doFetch } from '@/composables/doFetch';
    import { Check } from 'lucide-vue-next';

    const { quote, author } = defineProps(['quote', 'author']);

    const log_in = async () => {
        ErrorMessage.value = '';
        const { email, password } = credentials.value;
        if(email.trim() === '') return ErrorMessage.value = 'Debe introducir un Email';
        if(password.trim() === '') return ErrorMessage.value = 'La contraseña no puede estar vacía';

        IsButtonDisabled.value = true;
        const { code } = await doFetch('/login', 'POST', { email, password }); 
        if(code !== 200) {
            IsButtonDisabled.value = false;
            return ErrorMessage.value = 'Credenciales invalidas';
        }

        location.href = '/backoffice/';
    };

    const credentials = ref({
        email: '',
        password: ''
    });

    const IsButtonDisabled = ref(false);
    const ErrorMessage = ref('');
</script>

<template>
    <AuthCard :quote="quote" :author="author">
        <form 
            id='login-form' 
            action="/login" 
            method="POST"
            class="w-100 h-100 flex justify-center align-center"
            @submit.prevent="log_in"
        >
            <div class="container flex justify-center align-center direction-column gap-2">
                <h1 class="p-1 login-title">Iniciar sessión</h1>
                <Input :update="(value: string) => credentials.email = value" type="text" label="Email" placeholder="Email" />
                <Input :update="(value: string) => credentials.password = value" type="password" label="Contraseña" placeholder="*****" />
                <div class="w-100 flex justify-center align-start direction-column gap-2">
                    <span class="text-red">{{ErrorMessage}}</span>
                    <Button :disabled="IsButtonDisabled" type="primary">
                        <span class='flex justify-center align-center gap-2'>
                            <Check />
                            Iniciar sesión
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
        width: 50%;
    }
</style>
