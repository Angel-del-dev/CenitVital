<script setup>
import { ChevronLeft, ChevronRightIcon } from 'lucide-vue-next';

    const { page, next, previous, page_change } = defineProps(['page', 'next', 'previous', 'page_change']);
    const _page_change = action => {
        if(!previous && action < 0) return;
        if(!next && action > 0) return;
        page_change(action);
    }
</script>

<template>
    <div
        class="w-100 flex justify-end align-center"
    >
        <button @click="_page_change(-1)" :active="previous"><ChevronLeft /></button>
        <button>{{ page }}</button>
        <button @click="_page_change(+1)" :active="next"><ChevronRightIcon /></button>
    </div>
</template>
<style scoped>
    div {
        padding: 5px 0;
    }
    button {
        border: 0;
        padding: 5px;
        background-color: var(--blue);
        color: var(--white);
        cursor: pointer;
        font-size: 1.2rem;
        min-height: 5vmin;
        height: fit-content;
    }

    button:first-of-type {
        border-radius: var(--border-radius) 0 0 var(--border-radius);
    }

    button:last-of-type {
        border-radius: 0 var(--border-radius) var(--border-radius) 0;
    }

    button[active="false"] {
        color: lightgray;
    }
</style>