<script setup>
import { ref } from 'vue';


    const { label, checked, update } = defineProps(['label', 'checked', 'update']);
    const is_checked = ref(checked);
</script>
<template>
    <div
        class="w-100 flex justify-start align-center gap-1 user-select-none"
    >
        <input type="checkbox" class="pointer" @change="update" v-model="is_checked" />
        <p>{{ label }}</p>
    </div>
</template>