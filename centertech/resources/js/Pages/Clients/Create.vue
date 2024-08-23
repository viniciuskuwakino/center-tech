
<template>

    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Adicionar Cliente</h2>    
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                    <section class="max-w-xl">
                        <div class="flex items-center mb-2">
                            <Link href="/clients" method="GET" as="button" type="button">
                                <SecondaryButton>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                    </svg>
                                    Retornar
                                </SecondaryButton>
                            </Link>
                            
                        </div>

                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Formulário de cadastro de cliente</h2>

                        </header>


<!--                        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">-->
<!--                        class="col-span-3"-->
                        <form @submit.prevent="submit" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="name" value="Nome" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="phone" value="Telefone" />

                                <TextInput
                                    id="phone"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.phone"
                                    required
                                />

                                <InputError class="mt-2" :message="form.errors.phone" />
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
import SecondaryButton from "@/Components/SecondaryButton.vue";



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
    },
    props: {
        clients: {
            type: Array,
        }
    },
    data() {
        return {
           
        }
    },
    setup() {
        
        const form = useForm({
            name: '',
            phone: ''
        })

        const submit = () => {
            form.post(route('clients.register'), {
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


        return {
            form,
            submit,
            clearForm,
        }
    }
}

</script>