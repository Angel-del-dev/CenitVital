<script setup>
    import Input from '@/components/generic/inputs/Text.vue';
    import TextArea from '@/components/generic/inputs/TextArea.vue';
    import Button from '@/components/generic/Button.vue';
    import { Check } from 'lucide-vue-next';
import { doFetch } from '@/composables/doFetch';
import Alert from './Alert.vue';
import {  ref } from 'vue';
    const { translation, user, creation, lang } = defineProps(['translation', 'user', 'creation', 'lang']);

    const create_or_insert = async () => {
        if(user.name === undefined || user.name === '') return error_message.value = translation.user_empty;
        if(user.email === undefined || user.email === '') return error_message.value = translation.email_empty;
        
        const isCreation = user.id === undefined;
        const { code, message } = await doFetch(
            `/panel/user/${isCreation ? '' : user.id}`,
            isCreation ? 'POST' : 'PUT',
            user
        );
        if(code === 200) return location.href = `/${lang}/panel/users`;
        error_message.value = translation[message];
    };
    let error_message = ref('');
</script>
<template>
    <form 
        id='user-form' 
        action="/" 
        method="POST"
        class="user-select-none w-100 h-100 flex justify-start align-start direction-column"
        @submit.prevent="create_or_insert"
    >
        <!-- TODO Image -->
        <div
            class="w-100 flex justify-center align-center gap-2"    
        >
            <Input
                :label="translation.name"
                :placeholder="translation.name"
                :value="`${user.name ?? ''}`"
                :update="value => user.name = value"
                type="text"
            />
            <Input
                :label="translation.email"
                :value="`${user.email ?? ''}`"
                :placeholder="translation.email"
                :update="value => user.email = value"
                type="text"
            />
        </div>
        <div class="w-100 flex justify-center align-center gap-2">
            <Input
                :label="translation.password"
                :placeholder="translation.password"
                :update="value => user.password = value"
                type="password"
            />
            <Input
                :label="translation.phone"
                :value="`${user.phone ?? ''}`"
                :placeholder="translation.phone"
                :update="value => user.phone = value"
                type="tel"
            />
            <!-- <Input
                :label="translation.birth"
                :value="`${user.dateofbirth ?? ''}`"
                :placeholder="translation.birth"
                :update="value => user.dateofbirth = value"
                type="date"
            /> -->
        </div>
        <TextArea
            :label="translation.observations"
            :placeholder="translation.observations"
            :value="`${user.observations ?? ''}`"
            :update="value => user.observations = value"
        />
        <div
            class="actions w-100 flex justify-end align-center"
        >
            <Button
                palette="primary"
            >
                <Check />
                {{ translation.confirm }}
            </Button>
        </div>
    </form>
    <Alert
        :active="error_message !== ''"
        :on_cancel="() => error_message = ''"
    >
        {{ error_message }}
    </Alert>
</template>
<style scoped>
    .actions {
        padding: 5px 0;
    }
</style>