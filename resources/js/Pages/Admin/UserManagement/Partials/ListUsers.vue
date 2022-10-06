<script setup>
import { defineEmits } from 'vue';
import DataTable from '@/Components/DataTable.vue';
import DataTableCol from '@/Components/DataTableCol.vue';
import { Icon } from '@vicons/utils'
import { Edit, Delete, Checkmark, Error } from '@vicons/carbon';

const emit = defineEmits(["edit", "delete"]);

const handleEditButton = (row) => {
    emit("edit", row);
}

const handleDeleteButton = (row) => {
    emit("delete", row);
}
</script>

<template>
    <DataTable :tdata="$page.props.users" :headers="['ID', '用户名', '邮箱', '两步验证', '管理员', '已启用', '操作']">
        <template #default="{row}">
            <DataTableCol :row="row" prop="id"></DataTableCol>
            <DataTableCol :row="row" prop="name"></DataTableCol>
            <DataTableCol>
                <Icon size="16" color="green" v-if="row.email_verified_at"><Checkmark /></Icon>
                <Icon size="16" color="red" v-else><Error /></Icon>
                {{ row.email }}
            </DataTableCol>
            <DataTableCol>
                <Icon size="16" color="green" v-if="row.two_factor_confirmed_at"><Checkmark /></Icon>
                <Icon size="16" color="red" v-else><Error /></Icon>
            </DataTableCol>
            <DataTableCol>
                <Icon size="16" color="green" v-if="row.admin"><Checkmark /></Icon>
                <Icon size="16" color="red" v-else><Error /></Icon>
            </DataTableCol>
            <DataTableCol>
                <Icon size="16" color="green" v-if="row.enabled"><Checkmark /></Icon>
                <Icon size="16" color="red" v-else><Error /></Icon>
            </DataTableCol>
            <DataTableCol>
                <button type="button" @click="handleEditButton(row)"><Icon size="16"><Edit /></Icon></button>&nbsp;
                <button type="button" @click="handleDeleteButton(row)"><Icon size="16" color="red"><Delete /></Icon></button>
            </DataTableCol>
        </template>
    </DataTable>
</template>