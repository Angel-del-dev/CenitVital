<script setup>
import { Check, X } from 'lucide-vue-next';
import Text from '@/components/generic/inputs/Text.vue';
import Combobox from '@/components/generic/inputs/Combobox.vue';
import TextArea from '@/components/generic/inputs/TextArea.vue';
import Button from '@/components/generic/Button.vue';

const { close, requested_date, translation, categories, customers } = defineProps(
    ['close', 'requested_date', 'translation', 'categories', 'customers']
);

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
                <div
                    class="w-100 flex justify-center align-center gap-2"
                >
                    <Text type="date" :value="requested_date.dateStr" :label="translation.date"/>
                    <Text type="time" :label="translation.event_start_at"/>
                </div>
                <!-- <Text type="text" placeholder="TODO Searcher" :label="translation.customer" /> -->
                <Combobox 
                    :label="translation.customer"
                    :values="customers"
                />
                <Combobox
                    :label="translation.page_admin_categories"
                    :values="categories"
                />

                <Text type="text" :placeholder="translation.event_subject" :label="translation.event_subject"/>
                <TextArea :label="translation.observations" :placeholder="translation.observations" />
                
                <div
                    class="pt-1 w-100 flex justify-end align-center gap-2"
                >
                    <Button palette='primary'><Check />{{ translation.confirm }}</Button>
                </div>
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
        width: 60svw;
    }

    @media screen and (max-width: 750px) {
        .events-manager {
            width: 100%;
        }
    }
</style>