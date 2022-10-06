<script setup>
import { defineEmits } from 'vue';
import DataTable from '@/Components/DataTable.vue';
import DataTableCol from '@/Components/DataTableCol.vue';
import { Icon } from '@vicons/utils'
import { Edit, Delete, Checkmark, Error, Locked } from '@vicons/carbon';

const emit = defineEmits(["revoke", "delete"]);

const handleRevokeButton = (row) => {
    emit("revoke", row);
}

const handleDeleteButton = (row) => {
    emit("delete", row);
}
</script>

<template>
    <DataTable
    :tdata="$page.props.clients"
    :headers="['UUID', '名称', '重定向', '用户', '密码', '个人', '启用', '操作']">
        <template #default="{row}">
            <DataTableCol :row="row" prop="id"></DataTableCol>
            <DataTableCol :row="row" prop="name"></DataTableCol>
            <DataTableCol :row="row" prop="redirect"></DataTableCol>
            <DataTableCol :row="row" prop="user_id"></DataTableCol>
            <DataTableCol>
                <Icon size="16" color="green" v-if="row.password_client"><Checkmark /></Icon>
            </DataTableCol>
            <DataTableCol>
                <Icon size="16" color="green" v-if="row.personal_access_client"><Checkmark /></Icon>
            </DataTableCol>
            <DataTableCol>
                <Icon size="16" color="green" v-if="!row.revoked"><Checkmark /></Icon>
                <Icon size="16" color="red" v-else><Error /></Icon>
            </DataTableCol>
            <DataTableCol>
                <button type="button" @click="handleRevokeButton(row)"><Icon size="16" color="orange"><Locked /></Icon></button>&nbsp;
                <button type="button" @click="handleDeleteButton(row)"><Icon size="16" color="red"><Delete /></Icon></button>
            </DataTableCol>
        </template>
    </DataTable>
</template>