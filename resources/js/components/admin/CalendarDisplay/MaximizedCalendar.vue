<script setup>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import listPlugin from '@fullcalendar/list'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import DateManagerPopup from './DateManagerPopup.vue'
import { reactive, ref } from 'vue'
import _default from '@fullcalendar/daygrid'
import { fillStart } from '@/composables/utils'
import { doFetch } from '@/composables/doFetch'
import Alert from '../Alert.vue'

const { lang, loading, translation, events, categories, customers } = defineProps(
    ['lang', 'loading', 'translation', 'events', 'categories', 'customers']
);
const requested_date = ref({});
const error_message = ref('');

const dateClick = dateClickInfo => {
    requested_date.value.is_new = true;
    const day = fillStart(dateClickInfo.date.getDate(), '0', 2);
    const month = fillStart(dateClickInfo.date.getMonth() + 1, '0', 2);
    requested_date.value.format = `${day}/${month}/${dateClickInfo.date.getFullYear()}`;
    requested_date.value.dateStr = dateClickInfo.dateStr;
    requested_date.value.finished = false;
    requested_date.value.activity = '';
    requested_date.value.customer = '';
};

const eventClick = async eventClickInfo => {
    loading(true);
    const { code, message, Info } = await doFetch(
        `/panel/bookings/${eventClickInfo.event.id}`,
        'GET'
    );
    loading(false);
    if(code !== 200) return error_message.value = message;
    const [date, time] = Info.date.split(' ');
    requested_date.value.is_new = false;
    requested_date.value.id = Info.id;
    requested_date.value.customer = Info.user_id;
    requested_date.value.activity = Info.activities_id;
    requested_date.value.dateStr = date;
    requested_date.value.timestart = time;
    requested_date.value.subject = Info.subject;
    requested_date.value.observation = Info.observation;
    requested_date.value.finished = Info.finished === 1;
}

const close_date_manager = () => {
    requested_date.value = {};
};

const calendarOptions = reactive({
    plugins: [ listPlugin, dayGridPlugin, interactionPlugin, timeGridPlugin ],
    initialView: 'dayGridMonth',
    locale: lang,
    firstDay: 1,
    headerToolbar: {
        left: 'prev,next',
        center: 'title',
        // right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        right: 'dayGridMonth,listWeek'
    },
    dateClick, eventClick,
    events
});

loading(false);
</script>
<template>
  <FullCalendar :options="calendarOptions" />
  <DateManagerPopup 
    v-if="Object.keys(requested_date).length > 0" 
    :close="close_date_manager"
    :requested_date="requested_date"
    :translation="translation"
    :categories="categories"
    :customers="customers"
  />
  <Alert
        :active="error_message !== ''"
        :on_cancel="() => error_message = ''"
    >
        {{ error_message }}
    </Alert>
</template>