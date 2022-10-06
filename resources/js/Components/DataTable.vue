<script setup>
defineProps({
    tdata: {
        type: Array,
        default: [], // [{key: data, key: data}, ...]
    },
    headers: {
        type: Array,
        default: [], // { key_name: render_name, ... }
    },
    has_header: {
        type: Boolean,
        default: true,
    }
});
</script>

<template>
    <div class="relative rounded-xl">
        <div class="shadow-sm my-8 overflow-x-auto block">
            <table class="border-collapse table-auto w-full text-sm">
                <template v-if="has_header">
                    <thead>
                        <tr>
                            <th v-for="value in headers"
                                class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                {{ value }}</th>
                        </tr>
                    </thead>
                </template>

                <tbody class="bg-white dark:bg-slate-800">
                    <template v-for="row in tdata">
                        <tr>
                            <slot :row="row"></slot>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</template>