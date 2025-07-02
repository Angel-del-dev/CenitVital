<script setup>
import SimpleLink from '../links/SimpleLink.vue';

    const { current } = defineProps(['current']);
</script>
<template>
    <div>
        <SimpleLink 
            v-for="({Caption, Link}, Index) in current"
            :caption="Caption" :link="Link" :active="false"
        >/</SimpleLink>
    </div>
</template>