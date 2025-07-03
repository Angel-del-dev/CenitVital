<script setup>
import GridData from './GridData.vue';
import GridHead from './GridHead.vue';
    // TODO Add pagination
    const { translation, data, columns, onselect } = defineProps(['translation', 'data', 'columns', 'onselect']);
</script>
<template>
    <table>
        <GridHead 
            :translation="translation"
            :columns="columns"
        />
        <GridData 
            :data="data"
            :onselect="onselect"
        />
    </table>
</template>
<style scoped>
    table {
        width: 100%;
    }
</style>