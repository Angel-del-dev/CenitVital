<script setup>
import Panel from '@/components/admin/Panel.vue';
import DataGrid from '@/components/generic/visualize/DataGrid.vue';
import { useLanguage } from '@/composables/useLanguage';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

    const { menu, users, lang } = defineProps(['menu', 'users', 'lang']);
    const loading = ref(true);
    let translation = ref({});
    const page_location = ref([]);
    
    onMounted(async () => {
        translation.value = await useLanguage(lang, 'generic');
        loading.value = false;
        page_location.value.push({ Caption: translation.value.page_admin_users, Link: `/${lang}/panel/users` });
    });

    const select_user = row => {
        console.log(row);
    };

    const columns = ['user', 'name'];
</script>
<template>
<Head :title="translation.page_admin_users" />
    <Panel 
        :menu="menu"
        :breadcumbs="page_location" 
        :lang="lang"
        :translation="translation"
        active="page_admin_users"
    >
        <DataGrid 
            :translation="translation"
            :columns="columns"
            :data="users"
            :onselect="select_user"
        />
    </Panel>
</template>