<script setup>
import { defineEmits, computed, ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    client_type: {
        type: String,
        default: 'common',
    },
});

const emit = defineEmits(["cancel", "submit", "submit_failed"]);

const result_show = ref(false);
const result_uuid = ref('');
const result_secret = ref('');

const client_form = useForm({
    name: '',
    redirect: 'https://localhost/callback',
    user_id: 1,
});

const submit_url = computed(() => {
    if ( 'public' == props.client_type )
        return route("dashboard_client_add_public");
    else if ( 'password' == props.client_type )
        return route("dashboard_client_add_password");
    else if ( 'personal' == props.client_type )
        return route("dashboard_client_add_personal");
    else if ( 'clientcredential' == props.client_type )
        return route("dashboard_client_add_clientcredential");
    else
        return route("dashboard_client_add_common");
});

const form_other_info = computed(()=>{
    if ( ['password', 'personal', 'clientcredential'].includes(props.client_type) ) {
        return false;
    } else {
        return true;
    }
});

const handleSubmitButton = () => {
    client_form.post(submit_url.value, {
        errorBag: 'createOAuthClient',
        preserveState: true,
        preserveScroll: true,
        onSuccess: (res) => {
            client_form.reset();
            result_show.value = true;
            result_uuid.value = res.props.flash.message.created_client_id;
            result_secret.value = res.props.flash.message.created_client_secret;
            emit('submit');
        },
        onError: (errors) => {
            console.log(errors);
            emit('submit_failed', errors);
        },
    });
}

const handleCancelButton = () => {
    client_form.reset();
    emit('cancel');
}

const handleResultCloseButton = () => {
    result_show.value = false;
    result_secret.value = '';
    result_uuid.value = '';
}
</script>

<template>
    <Modal :show="result_show">
        <div class="pl-8 pt-6 pr-8 pb-6">
            <p>OAuth客户端创建成功</p><hr />
            <p>以下是该客户端的信息<br/><i style="color: red">注意：密钥仅显示一次，请妥善保存。</i></p>
            <p><b>UUID: </b>{{ result_uuid }}</p>
            <p><b>Secret: </b>{{ result_secret }}</p>
            <div class="pt-4 flex flex-row-reverse">
                <PrimaryButton type="button" @click="handleResultCloseButton">OK</PrimaryButton>
            </div>
        </div>
    </Modal>

    <Modal :show="show" :maxWidth="maxWidth" :closeable="closeable">
        <FormSection @submit.prevent="handleSubmitButton">
            <template #title>
                <div class="pl-6 pt-8">
                    新建OAuth客户端
                </div>
            </template>

            <template #description>
                <div class="pl-6">
                    请填写客户端信息
                </div>
            </template>

            <template #form>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="name" value="客户端名称" />
                    <TextInput id="name" v-model="client_form.name" type="text"
                        class="block w-full mt-1 disabled:opacity-75" />
                    <InputError :message="client_form.errors.name" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4" v-if="form_other_info">
                    <InputLabel for="user_id" value="所属用户" />
                    <TextInput id="user_id" v-model="client_form.user_id" type="text"
                        class="block w-full mt-1 disabled:opacity-75" />
                    <InputError :message="client_form.errors.user_id" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4" v-if="form_other_info">
                    <InputLabel for="redirect" value="回调地址" />
                    <TextInput id="redirect" v-model="client_form.redirect" type="text"
                        class="block w-full mt-1 disabled:opacity-75" />
                    <InputError :message="client_form.errors.redirect" class="mt-2" />
                </div>

            </template>

            <template #actions>
                <PrimaryButton :class="{ 'opacity-25': client_form.processing }" :disabled="client_form.processing">
                    Save
                </PrimaryButton>
                <SecondaryButton @click="handleCancelButton">Cancel</SecondaryButton>
            </template>
        </FormSection>
    </Modal>

</template>