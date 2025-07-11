<script setup lang="ts">
import { LoaderCircle } from 'lucide-vue-next';

    const { message } = defineProps(['message']);

</script>


<template>
    <div
        class="flex justify-center align-center direction-row"
    >
        <LoaderCircle :size="50" class="animate-spin" />
        <span>{{ message }}</span>
    </div>
</template>
<style scoped>
    div {
        width: 100svw;
        height: 100svh;
        z-index: 11;
        position: absolute;
        top: 0;
        left: 0;
        background-color: var(--white);
    }
    span {
        font-size: 1.4rem;
    }
</style>