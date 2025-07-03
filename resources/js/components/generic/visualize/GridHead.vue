<script setup>
    const { translation, columns } = defineProps(['translation', 'columns']);

</script>

<template>
    <thead>
        <tr>
            <th class="p-1" v-for="column of columns">{{ translation[column] }}</th>
        </tr>
    </thead>
</template>
<style scoped>
    th {
        text-align: left;
        color: gray;
    }
    tr {
        border-bottom: 10px solid gray;
    }
</style>