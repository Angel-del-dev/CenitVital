<script setup>
import { X } from 'lucide-vue-next';

    const {active, on_cancel} = defineProps(['active', 'on_cancel']);
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
                class="content p-3"
            >
                <slot />
            </div>
        </div>
    </div>
</template>
<style scoped>
    .container {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 10;
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