<script setup>
import Panel from '@/components/admin/Panel.vue';
import UserHandler from '@/components/admin/UserHandler.vue';
import { useLanguage } from '@/composables/useLanguage';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

    const {lang, user, menu, creation} = defineProps(['lang', 'user', 'menu', 'creation']);

    let translation = ref({});
    const page_location = ref([]);
    
    onMounted(async () => {
        translation.value = await useLanguage(lang, 'generic');
        page_location.value.push({ Caption: translation.value.page_admin_customers, Link: `/${lang}/panel/customers` });
        if(user.id === undefined) page_location.value.push({ Caption: translation.value.new, Link: `/${lang}/panel/customers/new` });
        else page_location.value.push({ Caption: user.id, Link: `/${lang}/panel/customers/${user.id}` });
    });
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
      <UserHandler
        :translation="translation"
        :user="user"
        :lang="lang"
        :creation="creation"
        :redirect="`/${lang}/panel/customers`"
      />  
    </Panel>
</template>