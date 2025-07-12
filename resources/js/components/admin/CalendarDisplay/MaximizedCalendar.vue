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

const { lang, loading, translation } = defineProps(['lang', 'loading', 'translation']);
const requested_date = ref({});

const dateClick = dateClickInfo => {
    requested_date.value.new = true;
    const day = fillStart(dateClickInfo.date.getDate(), '0', 2);
    const month = fillStart(dateClickInfo.date.getMonth() + 1, '0', 2);
    requested_date.value.format = `${day}/${month}/${dateClickInfo.date.getFullYear()}`;
    requested_date.value.dateStr = dateClickInfo.dateStr;
};

const eventClick = eventClickInfo => {
    requested_date.value.new = false;
    // loading(true);
}

const close_date_manager = () => {
    requested_date.value = {};
};

const calendarOptions = reactive({
    plugins: [ listPlugin, dayGridPlugin, interactionPlugin, timeGridPlugin ],
    initialView: 'dayGridWeek',
    locale: lang,
    firstDay: 1,
    headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    },
    dateClick, eventClick,
    events: [
        { title: 'event 1', date: '2025-07-11T14:30:00', color : '#C00' },
        { title: 'event 2', date: '2025-07-11T18:30:00', color: 'green' },
    ]
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
  />
</template>