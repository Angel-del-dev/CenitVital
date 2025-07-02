<script setup>
import { ref } from 'vue';

    const { toggled } = defineProps(['toggled']);
    
</script>
<template>
    <aside
        :class="`h-100 ${!toggled ? 'none' : ''}`"
    >
    </aside>
</template>

<style scoped>
    aside {
        min-width: 40vmin;
        width: fit-content;
        background-color: var(--white);
        border: 1px solid lightgray;
        border-radius: var(--border-radius);
    }

    @media screen and (max-width: 700px) {
        aside {
            position: absolute;
            width: 100%;
            background-color: var(--light-black);
            border: 1px solid var(--light-black);
            border-radius: 0;
        }
    }
</style>