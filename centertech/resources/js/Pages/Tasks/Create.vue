<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ComboBox from "@/Components/ComboBox.vue";


defineProps({
    clients: {
        type: Object,
    }
});

const form = useForm({
    client_id: '',
    device: '',
    brand: '',
    model: '',
    serial_number: '',
    description: '',
    price: '',
});

const submit = () => {
    form.post(route('tasks.register'), {
        onSuccess: () => form.reset(),
    })
    // form.put(route('password.update'), {
    //     preserveScroll: true,
    //     onSuccess: () => form.reset(),
    //     onError: () => {
    //         if (form.errors.password) {
    //             form.reset('password', 'password_confirmation');
    //             passwordInput.value.focus();
    //         }
    //         if (form.errors.current_password) {
    //             form.reset('current_password');
    //             currentPasswordInput.value.focus();
    //         }
    //     },
    // });
}

const clearForm = () => {
    form.reset()
}

const getClientId = (client) => {
    form.client_id = client.value.id
}

</script>

<template>

    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Adicionar serviço</h2>    
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Update your account's profile information and email address.
                            </p>
                        </header>
                        <ComboBox :clients="clients" @getClient="getClientId"/>

<!--                        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">-->
<!--                        class="col-span-3"-->
                        <form @submit.prevent="submit" class="grid grid-cols-4 gap-4 mt-6">
                            <div>
                                <InputLabel for="device" value="Dispositivo" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.device"
                                    required
                                    autofocus
                                />

                                <InputError class="mt-2" :message="form.errors.device" />
                            </div>

                            <div>
                                <InputLabel for="brand" value="Marca" />

                                <TextInput
                                    id="brand"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.brand"
                                    required
                                />

                                <InputError class="mt-2" :message="form.errors.brand" />
                            </div>

                            <div>
                                <InputLabel for="model" value="Modelo" />

                                <TextInput
                                    id="model"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.model"
                                    required
                                />

                                <InputError class="mt-2" :message="form.errors.model" />
                            </div>

                            <div>
                                <InputLabel for="serial_number" value="Número de série" />

                                <TextInput
                                    id="serial_number"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.serial_number"
                                    required
                                />

                                <InputError class="mt-2" :message="form.errors.serial_number" />
                            </div>

                            <div class="col-span-3">
                                <InputLabel for="description" value="Descrição" />

                                <TextInput
                                    id="description"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.description"
                                    required
                                />

                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div>
                                <InputLabel for="price" value="Preço" />

                                <TextInput
                                    id="price"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.price"
                                    required
                                />

                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton>Salvar</PrimaryButton>
                                <SecondaryButton @click="clearForm">Limpar</SecondaryButton>
                            </div>

<!--                -->
<!--                            <div v-if="mustVerifyEmail && user.email_verified_at === null">-->
<!--                                <p class="text-sm mt-2 text-gray-800">-->
<!--                                    Your email address is unverified.-->
<!--                                    <Link-->
<!--                                        :href="route('verification.send')"-->
<!--                                        method="post"-->
<!--                                        as="button"-->
<!--                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
<!--                                    >-->
<!--                                        Click here to re-send the verification email.-->
<!--                                    </Link>-->
<!--                                </p>-->
<!--                -->
<!--                                <div-->
<!--                                    v-show="status === 'verification-link-sent'"-->
<!--                                    class="mt-2 font-medium text-sm text-green-600"-->
<!--                                >-->
<!--                                    A new verification link has been sent to your email address.-->
<!--                                </div>-->
<!--                            </div>-->
<!--                -->
<!--                            <div class="flex items-center gap-4">-->
<!--                                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>-->
<!--                -->
<!--                                <Transition-->
<!--                                    enter-active-class="transition ease-in-out"-->
<!--                                    enter-from-class="opacity-0"-->
<!--                                    leave-active-class="transition ease-in-out"-->
<!--                                    leave-to-class="opacity-0"-->
<!--                                >-->
<!--                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>-->
<!--                                </Transition>-->
<!--                            </div>-->
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>


</template>
