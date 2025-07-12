<script setup>
import Panel from '@/components/admin/Panel.vue';
import DataGrid from '@/components/generic/visualize/DataGrid.vue';
import { useLanguage } from '@/composables/useLanguage';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

    const { menu, lang, activities } = defineProps(['menu', 'lang', 'activities']);
    const loading = ref(true);
    let translation = ref({});
    const page_location = ref([]);
    
    const columns = ['id', 'name'];

    onMounted(async () => {
        translation.value = await useLanguage(lang, 'generic');
        page_location.value.push({ Caption: translation.value.page_admin_categories, Link: `/${lang}/panel/categories` });
    });

    const select_activity = (row) => {
        console.log(row);
    };

    const on_new = () => {
        
    };
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
        <DataGrid 
            :translation="translation"
            :columns="columns"
            :data="activities"
            :onselect="select_activity"
            :onnew="on_new"
        />
    </Panel>
</template>