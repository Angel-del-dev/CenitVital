<script setup>
    const { caption, link, active } = defineProps(['caption', 'link', 'active']);
</script>
<template>
    <a :href="link" :data-active="active" >
        {{ caption }}
        <slot />
    </a>
</template>
<style scoped>
    a,
    a:visited,
    a:active {
        color: gray;
        text-decoration: none;
    }

    a[data-active="true"] {
        color: var(--pink);
        text-decoration: underline;
    }
</style>