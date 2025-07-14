<script setup>
import { Check, Trash, X } from 'lucide-vue-next';
import Text from '@/components/generic/inputs/Text.vue';
import Combobox from '@/components/generic/inputs/Combobox.vue';
import TextArea from '@/components/generic/inputs/TextArea.vue';
import Button from '@/components/generic/Button.vue';
import { ref } from 'vue';
import Alert from '../Alert.vue';
import { isEmpty } from '@/composables/utils';
import { doFetch } from '@/composables/doFetch';
import Confirm from '../Confirm.vue';
import Checkbox from '@/components/generic/inputs/Checkbox.vue';

const { close, requested_date, translation, categories, customers } = defineProps(
    ['close', 'requested_date', 'translation', 'categories', 'customers']
);

const event = ref({
    date: requested_date.dateStr,
    id: requested_date.is_new ? '' : requested_date.id,
    timestart: requested_date.is_new ? '' : requested_date.timestart,
    customer: requested_date.is_new ? '' : requested_date.customer,
    activity: requested_date.is_new ? '' : requested_date.activity,
    subject: requested_date.is_new ? '' : requested_date.subject,
    observation: requested_date.is_new ? '' : requested_date.observation,
    finished: requested_date.finished
});


categories.forEach((category, _) => category.selected = category.value === requested_date.activity);
customers.forEach((customer, _) => customer.selected = customer.value === requested_date.customer);


const error_message = ref('');

const confirm_event = async () => {
    const { date, timestart, customer, activity, subject, observation } = event.value;
    if(
        isEmpty(date) ||
        isEmpty(timestart) ||
        customer === '' ||
        activity === '' ||
        isEmpty(subject)
    ) return error_message.value = translation.required_empty;
    
    const { code, message } = await doFetch(
        `/panel/bookings${requested_date.is_new ? '' : `/${requested_date.id}`}`,
        requested_date.is_new ? 'POST' : 'PUT',
        event.value
    );
    if(code === 200) return location.reload();
    error_message.value = message;
};

const delete_event = async () => {
    const { code, message } = await doFetch(
        `/panel/bookings/${requested_date.id}`,
        'delete'
    );
    if(code === 200) return location.reload();
    error_message.value = message;
};

const ask_confirm = () => confirm_message.value = translation.confirm_delete_event;
let confirm_message = ref('');

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
                    <Text type="date" :value="event.date" :label="translation.date"
                        :update="value => event.date = value"
                        :input="value => event.date = value"
                        :required="true"
                    />
                    <Text type="time" :value="event.timestart" :label="translation.event_start_at"
                        :update="value => event.timestart = value"
                        :input="value => event.timestart = value"
                        :required="true"
                    />
                </div>
                <!-- <Text type="text" placeholder="TODO Searcher" :label="translation.customer" /> -->
                <Combobox 
                    :label="translation.customer"
                    :values="customers"
                    :update="value => event.customer = value"
                    :required="true"
                />
                <Combobox
                    :label="translation.page_admin_categories"
                    :values="categories"
                    :update="value => event.activity = value"
                    :required="true"
                />

                <Text type="text" :maxlength="100" :value="event.subject" :placeholder="translation.event_subject" :label="translation.event_subject"
                    :update="value => event.subject = value"
                    :required="true"
                />
                <TextArea :value="event.observation" :label="translation.observations" :placeholder="translation.observations" 
                    :update="value => event.observation = value"
                />
                <Checkbox
                    :label="translation.event_finished"
                    :checked="event.finished"
                    :update="() => event.finished = !event.finished"
                />
                
                <div
                    class="pt-1 w-100 flex justify-end align-center gap-2"
                >

                    <Button v-if="!requested_date.is_new" :click="ask_confirm" palette='light-danger'><Trash />{{ translation.delete }}</Button>
                    <Button :click="confirm_event" palette='primary'><Check />{{ translation.confirm }}</Button>
                </div>
            </div>
        </div>
    </div>
    <Alert
        :active="error_message !== ''"
        :on_cancel="() => error_message = ''"
    >
        {{ error_message }}
    </Alert>
    <Confirm
        :active="confirm_message !== ''"
        :on_cancel="() => confirm_message = ''"
        :on_confirm="delete_event"
        :translation="translation"
    >{{ confirm_message }}</Confirm>
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