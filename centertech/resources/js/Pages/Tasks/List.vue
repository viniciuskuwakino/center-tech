<template>
    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Serviços</h2>
        </template>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- <div class="p-6 text-gray-900">Clientes!</div>
                    <div class="p-6 text-gray-900">{{ clients }}</div> -->

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-2">
                        <div class="pb-4 bg-white light:bg-gray-900 flex justify-between">
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 light:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    id="table-search"
                                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500"
                                    placeholder="Search for items"
                                    v-model="searchQuery"
                                >
                            </div>
                            <div class="relative mt-1">
                                <Link :href="route('tasks.create')">
                                    <PrimaryButton>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        Serviço
                                    </PrimaryButton>
                                </Link>
                            </div>
                        </div>
                        
                        <table class="table-auto w-full text-sm text-left rtl:text-right text-gray-500 light:text-gray-400">
                            <thead class="text-s text-gray-700 bg-gray-100 light:bg-gray-700 light:text-gray-400">
                                <tr>
                                    <!-- <th scope="col" class="p-4">
                                        <div class="flex items-center"> -->
                                            <!-- <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 light:focus:ring-blue-600 light:ring-offset-gray-800 light:focus:ring-offset-gray-800 focus:ring-2 light:bg-gray-700 light:border-gray-600">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label> -->
                                        <!-- </div>
                                    </th> -->
                                    <th scope="col" class="px-6 py-3">
                                        Data
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-100 light:bg-gray-800">
                                        Cliente
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Dispositivo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Marca
                                    </th>
                                    <!-- <th scope="col" class="px-6 py-3">
                                        Modelo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Número de série
                                    </th> -->
                                    <th scope="col" class="px-6 py-3">
                                        Preço
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Situação
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ação
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-for="task in tasks['data']" key="task.id">
                                <tr class="bg-white border-b light:bg-gray-800 light:border-gray-700 hover:bg-gray-100 light:hover:bg-gray-600">
                                    <!-- <td class="w-4 p-4"> -->
                                        <!-- <div class="flex items-center ">
                                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 light:focus:ring-blue-600 light:ring-offset-gray-800 light:focus:ring-offset-gray-800 focus:ring-2 light:bg-gray-700 light:border-gray-600">
                                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                        </div> -->
                                    <!-- </td> -->
                                    <td class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap light:text-white">
                                        {{ formatDate(task['created_at']) }}
                                    </td>
                                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap light:text-white">
                                        <div class="">
                                            <p>{{ task['client']['name'] }} </p>
                                            <p>{{ phoneMask(task['client']['phone']) }} </p>
                                        </div>
                                    </th>
                                    <td class="px-6 py-3">
                                        {{ task['device'] }}
                                    </td>
                                    <td class="px-6 py-3">
                                        {{ task['brand'] }}
                                    </td>
                                    <!-- <td class="px-6 py-3">
                                        {{ task['model'] }}
                                    </td>
                                    <td class="px-6 py-3">
                                        <p>{{ task['serial_number'] }}</p>
                                    </td> -->
                                    <td class="px-6 py-3">
                                        R$ {{ task['price'] }}
                                    </td>
                                    <td class="px-6 py-3">
                                        <span 
                                            v-if="task['status']"
                                            class="inline-flex items-center rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/60"
                                        >
                                            Pago
                                        </span>

                                        <span
                                            v-else
                                            class="inline-flex items-center rounded-md bg-red-100 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/60"
                                        >
                                            Pendente
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 flex justify-center mt-1">
                                        <!-- <button type="button" @click="handleInfo" class="text-white bg-blue-400 hover:bg-blue-500 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-1 py-1 text-center inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                            </svg>
                                        </button> -->
                                        <button type="button" @click="handleEdit(task)" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-2 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-1 py-1 text-center inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination :links="tasks['links']" :from="tasks['from']" :to="tasks['to']" :total="tasks['total']" />

                    </div>
                </div>
            </div>
        </div>


        <Modal :show="openTaskInfo" @close="closeModal">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900">
                    Informações de serviço
                </h2>

                <div class="flex space-x-3 overflow-hidden mt-3 ">
                    <img
                        class="inline-block h-28 w-28 rounded-full ring-2 ring-white"
                        src="../../Assets/male.jpg"
                        alt=""
                    />
                    <div class="flex flex-col justify-evenly">
                        
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-7">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                            </svg>
                            <p class="ms-1 font-medium text-md text-gray-700">{{ form.client.name }}</p>
                        </div>

                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-7">
                                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
                            </svg>
                            <p class="ms-1 font-medium text-md text-gray-700">{{ phoneMask(form.client.phone) }}</p>
                        </div>
                        
                    </div>
                </div>

                <form @submit.prevent="updateTask" class="grid grid-cols-6 gap-4 mt-6">
                    <div class="col-start-1 col-end-4">
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

                    <div class="col-start-4 col-end-7">
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

                    <div class="col-start-1 col-end-4">
                        <InputLabel for="model" value="Modelo" />

                        <TextInput
                            id="model"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.model"
                        />

                        <InputError class="mt-2" :message="form.errors.model" />
                    </div>

                    <div class="col-start-4 col-end-7">
                        <InputLabel for="serial_number" value="Número de série" />

                        <TextInput
                            id="serial_number"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.serial_number"
                        />

                        <InputError class="mt-2" :message="form.errors.serial_number" />
                    </div>

                    <div class="col-start-1 col-end-7">
                        <InputLabel for="description" value="Descrição" />

                        <!-- <TextInput
                            id="description"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.description"
                            required
                        /> -->

                        <textarea
                            id="description"
                            type="text"
                            class="resize-none border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                            rows="3"
                            v-model="form.description"
                        ></textarea>

                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>

                    <div class="col-start-1 col-end-3">
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

                    <div class="col-start-3 col-end-5">
                        <InputLabel for="status" value="Situação" />

                        <div class="flex py-3">
                            <div class="flex items-center me-4">
                                <input id="inline-radio" type="radio" value=true v-model="form.status" name="inline-radio-group" class="w-4 h-4 text-indigo-600 bg-gray-50 border-gray-300 focus:ring-indigo-500 light:focus:ring-indigo-600 light:ring-offset-gray-800 focus:ring-2 light:bg-gray-700 light:border-indigo-600">
                                <InputLabel for="inline-radio" value="Pago" class="ms-1"/>
                            </div>
                            <div class="flex items-center me-4">
                                <input id="inline-2-radio" type="radio" value=false v-model="form.status" name="inline-radio-group" class="w-4 h-4 text-indigo-600 bg-gray-50 border-gray-300 focus:ring-indigo-500 light:focus:ring-indigo-600 light:ring-offset-gray-800 focus:ring-2 light:bg-gray-700 light:border-indigo-600">
                                <InputLabel for="inline-2-radio" value="Pendente" class="ms-1"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6">
                        <PrimaryButton class="mr-3"> Salvar </PrimaryButton>
                        <SecondaryButton @click="closeModal"> Fechar </SecondaryButton>
                    </div>

                </form>
            </div>
        </Modal>
        
    </AuthenticatedLayout>
</template>

<script>

import { Head } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import { useForm, router } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import PrimaryButton from "@/Components/PrimaryButton.vue"
import SecondaryButton from '@/Components/SecondaryButton.vue'
import Pagination from '@/Components/Pagination.vue'
import Modal from '@/Components/Modal.vue'
import throttle from 'lodash/throttle'
import { VMoney } from 'v-money'

export default {
    components: {
        AuthenticatedLayout,
        Link,
        Head,
        InputError,
        InputLabel,
        TextInput,
        PrimaryButton,
        SecondaryButton,
        Pagination,
        Modal
    },
    directives: {
        money: VMoney
    },
    props: {
        tasks: {
            type: Object,
        },
        filters: {
            type: String,
        }
    },
    methods: {
        phoneMask(phone) {
            if (phone.length == 8) {
                let p = phone.replace(/\D/g, '').match(/(\d{4})(\d{4})/)
                return `${p[1]}-${p[2]}`
            }

            if (phone.length == 9) {
                let p = phone.replace(/\D/g, '').match(/(\d{5})(\d{4})/)
                return `${p[1]}-${p[2]}`
            }

            if (phone.length == 10) {
                let p = phone.replace(/\D/g, '').match(/(\d{2})(\d{4})(\d{4})/)
                return `(${p[1]}) ${p[2]}-${p[3]}`
            }

            if (phone.length == 11) {
                let p = phone.replace(/\D/g, '').match(/(\d{2})(\d{5})(\d{4})/)
                return `(${p[1]}) ${p[2]}-${p[3]}`
            }

            return phone
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
    setup(props) {
        const form = useForm({
            client: null,
            task_id: '',
            device: '',
            brand: '',
            model: '',
            serial_number: '',
            description: '',
            price: '',
            status: '',
        });
        
        // console.log(props.filters)
        const searchQuery = ref(props.filters)
        const openTaskInfo = ref(false)

        const closeModal = () => {
            openTaskInfo.value = false
        }

        const formatDate = (date) => {
            const formattedDate = new Date(date)
            const month = (formattedDate.getMonth() + 1).toString().padStart(2, "0");
            const day   = formattedDate.getDate().toString().padStart(2, "0");

            return `${day}/${month}/${formattedDate.getFullYear()}`
        }

        const handleEdit = (task) => {
            
            openTaskInfo.value = true
            
            form.task_id = task.id
            form.client = task.client
            form.device = task.device
            form.brand = task.brand
            form.model = task.model
            form.serial_number = task.serial_number
            form.description = task.description
            form.price = task.price
            form.status = task.status
        }


        const handleInfo = () => {
            console.log("info")
        }

        const updateTask = () => {
            form.status = JSON.parse(form.status)
            form.price = form.price.replace('R$', '').replaceAll(',', '')

            form.put(route('tasks.update'), {
                onSuccess: () => openTaskInfo.value = false
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
        };


        // watch(searchQuery, () => {
        //     router.get('/tasks', { search: searchQuery.value }, {
        //         preserveState: true,
        //         replace: true
        //     })
        // })

        watch(searchQuery, throttle(function () {
            router.get('/tasks', { search: searchQuery.value }, {
                preserveState: true,
                replace: true
            })
        }), 500)

        return {
            form,
            openTaskInfo,
            closeModal,
            formatDate,
            handleEdit,
            handleInfo,
            updateTask,
            searchQuery
        }
    }
}

</script>