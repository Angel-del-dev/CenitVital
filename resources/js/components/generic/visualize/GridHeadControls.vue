<script setup>
import { Plus } from 'lucide-vue-next';

    const { on_new } = defineProps(['on_new']);

</script>

<template>
    <div
        class="w-100 flex justify-end align-center"
    >
        <button
            @click="on_new"
            class="pointer"
        ><Plus /></button>
    </div>
</template>

<style scoped>
    button {
        font-size: 1.2rem;
        background-color: var(--blue);
        color: var(--white);
        border: 0;
        border-radius: var(--border-radius);
        padding: 5px;
    }
</style>