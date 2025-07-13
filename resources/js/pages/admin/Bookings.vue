<script setup>
import MaximizedCalendar from '@/components/admin/CalendarDisplay/MaximizedCalendar.vue';
import Loader from '@/components/admin/Loader.vue';
import Panel from '@/components/admin/Panel.vue';
import { useLanguage } from '@/composables/useLanguage';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

    const { menu, lang, categories, customers } = defineProps(['menu', 'lang', 'categories', 'customers']);
    const loading = ref(true);
    let translation = ref({});
    const page_location = ref([]);
    
    onMounted(async () => {
        translation.value = await useLanguage(lang, 'generic');
        page_location.value.push({ Caption: translation.value.page_admin_bookings, Link: `/${lang}/panel/bookings` });
    });
    const events = [
        { title: 'Masaje tradicional', date: '2025-07-12T14:30:00', color : '#C00' },
        { title: 'Masaje deportivo', date: '2025-07-12T18:30:00', color: 'green' },
    ];
</script>
<template>
<Head :title="translation.page_admin_bookings" />
    <Panel 
        :menu="menu"
        :breadcumbs="page_location" 
        :lang="lang"
        :translation="translation"
        active="page_admin_bookings"
    >
    <MaximizedCalendar
        :lang="lang"
        :loading="(bool) => loading = bool"
        :translation="translation"
        :events="events"
        :categories="categories"
        :customers="customers"
    />
    </Panel>
    <Loader v-if="loading" :message='translation.loading' />
</template>