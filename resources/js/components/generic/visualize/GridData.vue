<script setup>
    const { data, onselect } = defineProps(['data', 'onselect']);
</script>
<template>
    <tbody>
        <tr @click="onselect(row)" class='pointer' v-for="row of data">
            <td class="p-1" v-for="column of row">{{ column }}</td>
        </tr>
    </tbody>
</template>
<style scoped>
    tr {
        border: 10px solid gray;
    }

    tr:nth-of-type(2n),
    tr:hover {
        background-color: lightgray;
    }
</style>