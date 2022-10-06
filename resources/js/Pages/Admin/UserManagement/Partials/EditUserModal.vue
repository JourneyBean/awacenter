<script setup>
import { defineEmits } from 'vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import Checkbox from '@/Components/Checkbox.vue';
const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    userdata: {
        type: Object,
        default: {},
    },
    submit_url: {
        type: String,
        default: '',
    }
});

const emit = defineEmits(["cancel", "submit", "submit_failed"]);

const handleSubmitButton = () => {
    props.userdata.post(props.submit_url, {
        errorBag: 'editUser',
        preserveState: true,
        preserveScroll: true,
        onSuccess: (res) => {
            props.userdata.reset();
            emit('submit');
        },
        onError: (errors) => {
            console.log(errors);
            emit('submit_failed', errors);
        },
    });
};

const handleCancelButton = () => {
    props.userdata.reset();
    emit('cancel');
};

</script>

<template>
    <Modal :show="show" :maxWidth="maxWidth" :closeable="closeable">
        <FormSection @submit.prevent="handleSubmitButton">
            <template #title>
                <div class="pl-6 pt-8">
                    编辑用户
                </div>
            </template>

            <template #description>
                <div class="pl-6">
                    请填写用户的信息
                </div>
            </template>

            <template #form>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="id" value="ID" />
                    <TextInput id="id" v-model="userdata.id" type="text"
                        class="block w-full mt-1 disabled:opacity-25" disabled />
                    <InputError :message="userdata.errors.id" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="name" value="Name" />
                    <TextInput id="name" v-model="userdata.name" type="text"
                        class="block w-full mt-1 disabled:opacity-75" />
                    <InputError :message="userdata.errors.name" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="email" value="Mail" />
                    <TextInput id="email" v-model="userdata.email" type="text"
                        class="block w-full mt-1 disabled:opacity-75" />
                    <InputError :message="userdata.errors.email" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput id="password" v-model="userdata.password" type="password"
                        class="block w-full mt-1 disabled:opacity-75" />
                    <InputError :message="userdata.errors.password" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="enabled" value="Enabled" />
                    <Checkbox id="enabled" :checked="userdata.enabled"
                        @update:checked="(val)=>{userdata.enabled=val;}" />
                    <InputError :message="userdata.errors.enabled" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="verified" value="Mail Verified" />
                    <Checkbox id="verified" :checked="userdata.verified"
                        @update:checked="(val)=>{userdata.verified=val;}" />
                    <InputError :message="userdata.errors.verified" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="admin" value="Admin" />
                    <Checkbox id="admin" :checked="userdata.admin" @update:checked="(val)=>{userdata.admin=val;}" />
                    <InputError :message="userdata.errors.admin" class="mt-2" />
                </div>

            </template>

            <template #actions>
                <PrimaryButton :class="{ 'opacity-25': userdata.processing }" :disabled="userdata.processing">
                    Save
                </PrimaryButton>
                <SecondaryButton @click="handleCancelButton">Cancel</SecondaryButton>
            </template>
        </FormSection>
    </Modal>
</template>