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
        page_location.value.push({ Caption: translation.value.page_admin_customers, Link: `/${lang}/panel/customers` });
    });

    const select_user = row => location.href = `/${lang}/panel/customers/edit/${row[0]}`;
    const on_new = () => location.href = `/${lang}/panel/customers/new`;

    const columns = ['user', 'name'];
</script>
<template>
<Head :title="translation.page_admin_customers" />
    <Panel 
        :menu="menu"
        :breadcumbs="page_location" 
        :lang="lang"
        :translation="translation"
        active="page_admin_customers"
    >
        <DataGrid 
            :translation="translation"
            :columns="columns"
            :data="users"
            :onselect="select_user"
            :onnew="on_new"
        />
    </Panel>
</template>