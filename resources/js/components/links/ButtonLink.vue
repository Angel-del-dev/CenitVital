<script setup>
    const { caption, link, palette, classes } = defineProps(['caption', 'link', 'palette', 'classes']);
</script>

<template>
    <a 
        :class="`p-1 ${classes}`"
        :palette="palette" :href="link"
    >{{caption}}</a>
</template>
<style scoped>
    a, a:visited, a:active {
        text-decoration: none;
        border-radius: var(--border-radius);
    }

    a[palette="light-danger"] {
        background-color: var(--pink);
        color: var(--white);
    }

    @media screen and (max-width: 750px) {
        a {
            width: 100%;
            text-align: center;
        }
    }
</style>