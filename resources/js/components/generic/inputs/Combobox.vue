<script setup>
    const { label, values, update } = defineProps(['label', 'values', 'update']);
    
</script>
<template>
    <div
        class="w-100 flex justify-start align-start direction-column gap-1"
    >
        <label class="w-100">{{label}}</label>
        <select
            class="w-100 p-1 radius-auto pointer"
            @change="(e) => update(e.target.value)"
        >
            <option v-for="{caption, value, selected} of values" :value="value" :selected="selected">{{ caption }}</option>
        </select>
    </div>
</template>
<style scoped>
    select {
        border: 1px solid lightgray;
        outline: none;
    }

    label {
        font-weight: bold;
    }

    select,
    label {
        font-size: 1.2rem;
    }
</style>