<script setup>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import listPlugin from '@fullcalendar/list'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'

const { lang } = defineProps(['lang']);

const calendarOptions = {
    plugins: [ listPlugin, dayGridPlugin, interactionPlugin, timeGridPlugin ],
    initialView: 'dayGridWeek',
    locale: lang,
    firstDay: 1,
    headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    },
    dateClick: dateClickInfo => console.log(dateClickInfo.date),
    eventClick: eventClickInfo => console.log(eventClickInfo.event.start),
    events: [
        { title: 'event 1', date: '2025-07-11T14:30:00', color : '#C00' },
        { title: 'event 2', date: '2025-07-11T18:30:00', color: 'green' },
    ],
    timeFormat: 'H(:mm)'
}
</script>
<template>
  <FullCalendar 
    :options="calendarOptions"
    
/>
</template>