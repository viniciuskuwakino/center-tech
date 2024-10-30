
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
                        <div class="flex items-center mb-2">
                            <Link href="/tasks" method="GET" as="button" type="button">
                                <SecondaryButton>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                    </svg>
                                    Retornar
                                </SecondaryButton>
                            </Link>
                            
                        </div>

                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Formulário de cadastro de serviço</h2>
                        </header>

                        <div class="mt-5">
                            <InputLabel value="Cliente" />

                            <ComboBox :clients="clients" @getClient="getClientId"/>
                            <InputError class="mt-2" :message="form.errors.client_id" />
                        </div>

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
                                    v-money="money"
                                    required
                                />

                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton>Salvar</PrimaryButton>
                                <SecondaryButton @click="clearForm">Limpar</SecondaryButton>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>


</template>

<script>

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ComboBox from "@/Components/ComboBox.vue";
import { VMoney } from 'v-money'


export default {
    components: {
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
        Link,
        Head,
        AuthenticatedLayout,
        SecondaryButton,
        ComboBox
    },
    directives: {
        money: VMoney
    },
    props: {
        clients: {
            type: Array,
        }
    },
    data() {
        return {
            money: {
                decimal: '.',
                thousands: ',',
                prefix: 'R$ ',
                suffix: '',
                precision: 2,
                masked: false /* doesn't work with directive */
            }
        }
    },
    setup() {
        
        const form = useForm({
            client_id: '',
            device: '',
            brand: '',
            model: '',
            serial_number: '',
            description: '',
            price: '',
        })

        const submit = () => {

            form.transform((data) => ({
                ...data,
                price: data.price.replace('R$', '').replaceAll(',', '')
            })).post(route('tasks.register'), {
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

        return {
            form,
            submit,
            clearForm,
            getClientId
        }
    }
}

</script>