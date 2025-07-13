<script setup>
import Panel from '@/components/admin/Panel.vue';
import Card from '@/components/generic/cards/Card.vue';
import DownloadApp from '@/components/generic/popup/DownloadApp.vue';
import { useLanguage } from '@/composables/useLanguage';
import { Head } from '@inertiajs/vue3';
import { UsersRound } from 'lucide-vue-next';
import { computed, onMounted, ref } from 'vue';

import { Line } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, LineElement, CategoryScale, LinearScale, PointElement } from 'chart.js';
import DataGrid from '@/components/generic/visualize/DataGrid.vue';
ChartJS.register(Title, Tooltip, LineElement, CategoryScale, LinearScale, PointElement);

const { lang, menu, customers, events } = defineProps(['lang', 'menu', 'customers', 'events']);
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

const eventColumns = ['date', 'chart_total_events'];

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
            class="w-100 flex justify-start align-start direction-column gap-2"
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
                                <span class="text-gray">{{ translation.chart_new_customer }}</span>
                                <span class="text-bold">{{ customers.current }}</span>
                            </span>
                            <span
                                class="flex justify-center align-center gap-1"
                                :title="customers.last"
                            >
                                <span :class="customers_percentage_color">
                                {{ customers_percentage === 'NaN' ? customers_percentage : `${customers_percentage}%` }}
                                </span>
                                {{ translation.chart_since_last_month }}
                            </span>
                        </div>
                        <UsersRound :size="30" class="dashboard-icon" style="background-color: var(--blue);" />
                    </div>
                </Card>
            </div>
            <div
                class="w-100"
            >
                <DataGrid
                    :translation="translation"
                    :columns="eventColumns"
                    :data="events"
                    :onselect="() => null"
                    :onnew="() => null"
                />
            </div>
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