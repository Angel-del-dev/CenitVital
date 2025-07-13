<script setup>
import { Check, X } from 'lucide-vue-next';
import Button from '../generic/Button.vue';

    const {active, on_cancel, on_confirm, translation} = defineProps(['active', 'on_cancel', 'on_confirm', 'translation']);
</script>
<template>
    <div
       v-if="active"
        class="container w-100 h-100 user-select-none flex justify-center align-center"
    >
        <div
            class="alert flex justify-center align-center direction-column"
        >
            <header
                class="flex justify-end align-center"
            >
                <X class="pointer" @click="on_cancel()" />
            </header>
            <div
                class="content p-3 flex justify-start align-start direction-column"
            >
                <div
                    class="w-100 grow-1 p-2"
                >
                    <slot />
                </div>
                <div
                    class="w-100 flex justify-end align-end gap-2 p-2"
                >
                    <Button
                        palette="light-danger"
                        :click="on_cancel"
                    >
                    <Check />
                        {{ translation.cancel }}
                    </Button>
                    <Button
                        palette="primary"
                        :click="on_confirm"
                    >
                    <Check />
                        {{ translation.confirm }}
                    </Button>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .container {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 15;
    }
    .alert {
        box-shadow: 2px 2px 2px 2px lightgray;
        border-radius: var(--border-radius);
        border: 1px solid lightgray;
    }

    header {
        padding: 5px;
        background-color: var(--blue);
        width: 100%;
        color: white;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
    }

    .content {
        background-color: var(--white);
    }
</style>