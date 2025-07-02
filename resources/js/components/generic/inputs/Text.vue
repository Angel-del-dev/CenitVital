<script setup>
    const { type, label, placeholder, update } = defineProps(['type', 'label', 'placeholder', 'update']);
    const keyup = e => update(e.target.value);
</script>

<template>
    <div
        class="w-100 flex justify-center align-start direction-column gap-1"
    >
        <label class="w-100">{{ label }}</label>
        <input
            class="w-100 p-1"
            @keyup="keyup"
            :type="type" :placeholder="placeholder" 
        />
    </div>
</template>
<style scoped>
    input {
        border-radius: var(--border-radius);
        outline: none;
        border: 1px solid lightgray;
    }

    label {
        font-weight: bold
    }

    input,
    label {
        font-size: 1.2rem;
    }
</style>