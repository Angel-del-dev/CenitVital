<script setup>
import Panel from '@/components/admin/Panel.vue';
import { useLanguage } from '@/composables/useLanguage';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

    const { lang } = defineProps(['lang']);
    const loading = ref(true);
    let translation = ref({});
    const page_location = ref([]);
    
    onMounted(async () => {
        translation.value = await useLanguage(lang, 'generic');
        loading.value = false;
        page_location.value.push({ Caption: translation.value.page_admin_dashboard, Link: `/${lang}/panel` });
    });

</script>
<template>
    <Head :title="translation.page_admin_dashboard" />
    <Panel :breadcumbs="page_location" :lang="lang">
        TODO Insert Charts here
    </Panel>
</template>