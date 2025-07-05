<script setup>
    const { 
        type, label, placeholder, update, value 
    } = defineProps(['type', 'label', 'placeholder', 'update', 'value']);
    const keyup = e => update(e.target.value.trim());
</script>

<template>
    <div
        class="w-100 flex justify-center align-start direction-column gap-1"
    >
        <label class="w-100">{{ label }}</label>
        <textarea
            class="w-100 p-1"
            @keyup="keyup"
            :type="type" :placeholder="placeholder" 
            :value="value"
        ></textarea>
    </div>
</template>
<style scoped>
    textarea {
        border-radius: var(--border-radius);
        outline: none;
        border: 1px solid lightgray;
        resize: vertical;
        min-height: 40vmin;
    }

    label {
        font-weight: bold
    }

    textarea,
    label {
        font-size: 1.2rem;
    }
</style>