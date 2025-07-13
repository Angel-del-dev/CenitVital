<script setup>
import Panel from '@/components/admin/Panel.vue';
import Card from '@/components/generic/cards/Card.vue';
import DownloadApp from '@/components/generic/popup/DownloadApp.vue';
import { useLanguage } from '@/composables/useLanguage';
import { Head } from '@inertiajs/vue3';
import { UsersRound } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';

    const { lang, menu, customers } = defineProps(['lang', 'menu', 'customers']);
    const loading = ref(true);
    let translation = ref({});
    const page_location = ref([]);
    
    onMounted(async () => {
        translation.value = await useLanguage(lang, 'generic');
        loading.value = false;
        page_location.value.push({ Caption: translation.value.page_admin_dashboard, Link: `/${lang}/panel` });
    });

    const customers_percentage = ref(customers.percentage === null ? 'NaN' : customers.percentage);
    let customers_percentage_color = ref('');
    if(customers_percentage.value === 'NaN') customers_percentage_color.value = 'text-yellow';
    else customers_percentage_color.value = customers_percentage.value < 0 ? 'text-red' : 'text-green';
    

</script>
<template>
    <Head :title="translation.page_admin_dashboard" />
    <Panel 
        :menu="menu"
        :breadcumbs="page_location" 
        :lang="lang"
        :translation="translation"
        active="page_admin_dashboard"
    >
        <div
            class="w-100 flex justify-start align-center gap-2 flex-wrap"
        >
            <Card
                class="info-card"
            >
                <div
                    class="flex justify-center align-start gap-3"
                >   
                    <div>
                        <span class="flex justify-start align-start gap-1">
                            <span class="text-gray">Clientes nuevos</span>
                            <span class="text-bold">{{ customers.current }}</span>
                        </span>
                        <span
                            class="flex justify-center align-center gap-1"
                            :title="customers.last"
                        >
                            <span :class="customers_percentage_color">
                            {{ customers_percentage === 'NaN' ? customers_percentage : `${customers_percentage}%` }}
                            </span>
                            desde el mes pasado
                        </span>
                    </div>
                    <UsersRound :size="30" class="dashboard-icon" style="background-color: var(--blue);" />
                </div>
            </Card>
        </div>
        
    </Panel>
    <DownloadApp :translation="translation" />
</template>

<style scoped>
    .dashboard-icon {
        padding: 5px;
        color: var(--white);
        border-radius: 50%;
    }

    @media screen and (min-width: 700px) {
        .info-card {   
            width: fit-content !important; 
            flex-grow: 0;
        }
    }
</style>