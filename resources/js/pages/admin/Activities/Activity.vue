<script setup>
import Panel from '@/components/admin/Panel.vue';
import { useLanguage } from '@/composables/useLanguage';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import Text from '@/components/generic/inputs/Text.vue';
import Combobox from '@/components/generic/inputs/Combobox.vue';
import { fillDurations, isEmpty } from '@/composables/utils';
import Button from '@/components/generic/Button.vue';
import Alert from '@/components/admin/Alert.vue';
import TextArea from '@/components/generic/inputs/TextArea.vue';
import { doFetch } from '@/composables/doFetch';
import Confirm from '@/components/admin/Confirm.vue';

    const {lang, menu, is_new, category} = defineProps(['lang', 'menu', 'is_new', 'category']);
    let translation = ref({});
    const page_location = ref([]);
    const values = ref({
        id: is_new ? '' : category.id,
        name: is_new ? '' : category.name,
        duration: is_new ? '' : category.duration,
        observation: is_new ? '' : category.observation,
        color: is_new ? '#000' : category.color
    });
    const confirm_message = ref('');
    const error_message = ref('');
    
    onMounted(async () => {
        translation.value = await useLanguage(lang, 'generic');
        page_location.value.push({ Caption: translation.value.page_admin_categories, Link: `/${lang}/panel/categories` });
        if(is_new)
            page_location.value.push({ Caption: translation.value.new, Link: `/${lang}/panel/categories/new` });
        else 
            page_location.value.push({ Caption: category.id, Link: `/${lang}/panel/categories/edit/${category.id}` });
    });

    const confirm = async () => {
        let { name, duration, color, observation } = values.value;
        if(isEmpty(name)) return error_message.value = translation.value.user_empty;
        if(duration === 0) return error_message.value = translation.value.duration_empty;
        if(isEmpty(color)) color = '#000';
        if(isEmpty(observation)) return error_message.value = translation.value.observation_empty;
        const { code, message } = await doFetch(
            `/panel/categories${is_new ? '' : '/'+category.id}`,
            is_new ? 'POST' : 'PUT',
            {name, duration, color, observation}
        );
        if(code === 200) return location.href = `/${lang}/panel/categories`;
        error_message.value = translation.value[message];
    };

    const confirm_remove = async () => {
        const { code, message } = await doFetch(
            `/panel/categories/${category.id}`,
            'DELETE'
        );
        if(code === 200) return location.href = `/${lang}/panel/categories`;
        error_message.value = translation[message];
    };

    const delete_category = () => confirm_message.value = translation.value.confirm_delete_category;
    const durations = ref(fillDurations(is_new ? 0 : category.duration));
</script>
<template>
<Head :title="translation.page_admin_categories" />
    <Panel 
        :menu="menu"
        :breadcumbs="page_location" 
        :lang="lang"
        :translation="translation"
        active="page_admin_categories"
    >
        <div
            class="w-100 flex justify-center align-center gap-2"
        >
            <Text 
                :placeholder="translation.name"
                :label="translation.name"
                :update="val => values.name=val"
                :value="values.name"
                :maxlength="100"
            />
            <Combobox
                :label="translation.duration"
                :values="durations"
                :update="val => values.duration = val"
            />
        </div>
        <Text :value="values.color" :input="val => values.color=val" :label="translation.color" type="color" />
        <TextArea 
            :update="val => values.observation=val"
            :label="translation.observations"
            :value="values.observation"
        />
        <div
            class="w-100 flex justify-end align-center gap-2 p-1"
        >
            <Button v-if="!is_new" palette="light-danger" :click="delete_category">
                {{ translation.delete }}
            </Button>
            <Button palette="primary" :click="confirm">
                {{ translation.confirm }}
            </Button>
        </div>
    </Panel>
    <Alert
        :active="error_message !== ''"
        :on_cancel="() => error_message = ''"
    >
        {{ error_message }}
    </Alert>
    <Confirm
        :active="confirm_message !== ''"
        :on_cancel="() => confirm_message = ''"
        :on_confirm="confirm_remove"
        :translation="translation"
    >{{ confirm_message }}</Confirm>
</template>