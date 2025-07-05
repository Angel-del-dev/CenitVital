<script setup>
    const { disabled, palette, click } = defineProps(['disabled', 'palette', 'click']);
</script>
<template>
    <button 
        @click="e => {if(click !== undefined ) { e.preventDefault(); click()}}"
        class="flex justify-center align-center pointer p-1 gap-2"
        :disabled="disabled" :palette="palette"
    >
        <slot />
    </button>
</template>
<style scoped>
    button {
        border: 0;
        outline: none;
        border-radius: var(--border-radius);
        min-width: 20vmin;
        width: fit-content;
    }

    button[palette="primary"],
    button[palette="light-danger"] {
        color: var(--white);
    }

    button[palette="primary"] {
        background-color: var(--blue);
    }

    button[palette="light-danger"] {
        background-color: var(--pink);
    }

     @media screen and (max-width: 750px) {
        button {
            width: 100%;
        }
    }
</style>