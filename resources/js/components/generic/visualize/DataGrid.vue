<script setup>
import { ref } from 'vue';
import GridData from './GridData.vue';
import GridHead from './GridHead.vue';
import GridControls from './GridControls.vue';
import GridHeadControls from './GridHeadControls.vue';
    const { 
        translation, data, columns, onselect, onnew
    } = defineProps(['translation', 'data', 'columns', 'onselect', 'onnew']);

    const page_change = index => {
        page.value += index;
        slice_index.value = page_size.value * page.value;
        slice.value = data.slice(slice_index.value, slice_index.value+page_size.value);
    }

    const page_size = ref(10);
    const page = ref(0);
    const slice_index = ref(page_size.value * page.value);
    const slice = ref(data.slice(slice_index.value, slice_index.value+page_size.value));

    const selected = ref(null);
</script>
<template>
    <div
        class='grid-wrapper w-100 h-100 user-select-none'
    >
        <GridHeadControls 
            :on_new="onnew"
        />
        <table
            class="w-100"
        >
            <GridHead 
                :translation="translation"
                :columns="columns"
            />
            <GridData 
                :data="slice"
                :onselect="onselect"
                :selectedindex="selected"
            />
        </table>
        <GridControls 
            :page_change="page_change"
            :page="page+1"
            :previous="page > 0"
            :next="(page_size * (page+1)) < (data.length - 1)"
        />
    </div>
</template>