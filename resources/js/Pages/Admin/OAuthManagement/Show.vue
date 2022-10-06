<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ListOAuthClients from './Partials/ListOAuthClients.vue';
import CreateOAuthClientModal from './Partials/CreateOAuthClientModal.vue';

const modal_show = ref(false);
const client_type = ref('');

const handleOAuthCreate = (val) => {
    client_type.value = val;
    modal_show.value = true;
}

// haneld: List
const handleListRevoke = (row) => {
    Inertia.post(route('dashboard_client_revoke'), {
        id: row.id,
    });
}

const handleListDelete = (row) => {
    Inertia.post(route('dashboard_client_delete'), {
        id: row.id,
    });
}

// handle: Modal
const handleModalSubmit = () => {
    modal_show.value = false;
}

const handleModalCancel = () => {
    modal_show.value = false;
}
</script>

<template>
    <AppLayout title="Admin Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                OAuth Management
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="pl-8 pr-8 pt-6 flex flex-row-reverse">

                        <div class="ml-3 relative">
                            <Dropdown>
                                <template #trigger>
                                    <PrimaryButton type="button">创建OAuth客户端</PrimaryButton>
                                </template>
                                <template #content>
                                    <DropdownLink as="button" @click="handleOAuthCreate('common')">
                                        普通客户端
                                    </DropdownLink>
                                    <DropdownLink as="button" @click="handleOAuthCreate('public')">
                                        公共客户端(PCKE)
                                    </DropdownLink>
                                    <DropdownLink as="button" @click="handleOAuthCreate('password')">
                                        密码客户端
                                    </DropdownLink>
                                    <DropdownLink as="button" @click="handleOAuthCreate('clientcredential')">
                                        机器访问客户端
                                    </DropdownLink>
                                    <DropdownLink as="button" @click="handleOAuthCreate('personal')">
                                        个人访问客户端
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                    <CreateOAuthClientModal :show="modal_show" :client_type="client_type"
                        @submit="handleModalSubmit"
                        @cancel="handleModalCancel" />
                    <ListOAuthClients @revoke="handleListRevoke" @delete="handleListDelete" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>