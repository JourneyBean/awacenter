<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ListUsers from './Partials/ListUsers.vue';
import EditUserModal from './Partials/EditUserModal.vue';

// Inertia Form helper
const user = useForm({
    id: Int32Array,
    name: String,
    email: String,
    verified: Boolean,
    password: String,
    admin: Boolean,
    enabled: Boolean,
})
const submit_url = ref('')
const modal_show = ref(false)

const handleCreateUser = () => {
    user.id = 0;
    user.name = '';
    user.email = '';
    user.verified = false;
    user.password = null;
    user.admin = false;
    user.enabled = true;
    submit_url.value = route('dashboard_user_add');
    modal_show.value = true;
}

// handle: List
const handleListEdit = (row) => {
    user.id = row.id;
    user.name = row.name;
    user.email = row.email;
    user.verified = (Boolean)(row.email_verified_at);
    user.password = null;
    user.admin = (Boolean)(row.admin);
    user.enabled = (Boolean)(row.enabled);
    submit_url.value = route('dashboard_user_update');
    modal_show.value = true;
}

const handleListDelete = (row) => {
    Inertia.post(route('dashboard_user_delete'), {
        id: row.id,
    })
}

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
                User Management
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="pl-8 pr-8 pt-6 flex flex-row-reverse">
                        <PrimaryButton type="button" @click="handleCreateUser">创建用户</PrimaryButton>
                    </div>
                    <EditUserModal :show="modal_show" :userdata="user" :submit_url="submit_url"
                        @cancel="handleModalCancel" @submit="handleModalSubmit" />
                    <ListUsers @edit="handleListEdit" @delete="handleListDelete" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
    