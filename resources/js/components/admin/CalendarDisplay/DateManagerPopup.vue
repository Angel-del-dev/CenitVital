<script setup>
import { X } from 'lucide-vue-next';
import Text from '@/components/generic/inputs/Text.vue';

    const { close, requested_date, translation } = defineProps(['close', 'requested_date', 'translation']);
</script>
<template>
    <div 
        class='date-manager flex justify-end align-center'
    >
        <div
            class="events-manager h-100 p-2 flex justify-start align-start gap-3 direction-column"
        >
            <nav
                class='w-100'
            >
                <X class="pointer" @click="() => close()" />
            </nav>
            <div
                class="w-100 grow-1 overflow-y-auto"
            >
                <Text type="date" :value="requested_date.dateStr" :label="translation.date"/>
                <Text type="text" placeholder="TODO Searcher" :label="translation.customer" />
            </div>
        </div>
    </div>
</template>
<style scoped>
    .date-manager {
        width: 100svw;
        height: 100svh;
        position: absolute;
        top: 0;
        left: 0;
        background-color: rgba(57, 57, 57, 0.23);
        z-index: 11;
    }
    .events-manager {
        background-color: var(--white);
        width: 40vmin;
    }

    @media screen and (max-width: 750px) {
        .events-manager {
            width: 100%;
        }
    }
</style>