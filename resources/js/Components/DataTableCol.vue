<script setup>
defineProps({
    row: {
        type: Object,
        default: {}, // [{key: data, key: data}, ...]
    },
    prop: {
        type: String,
        default: null
    },
});
</script>

<template>
    <td v-if="prop" class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ row[prop] }}</td>
    <td v-else class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"><slot></slot></td>
</template>