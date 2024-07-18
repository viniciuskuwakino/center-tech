<script setup>
import { Head } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import PrimaryButton from "@/Components/PrimaryButton.vue"
import DangerButton from '@/Components/DangerButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import Modal from '@/Components/Modal.vue'


defineProps({
    tasks: {
        type: Object,
    }
})

const form = useForm({
    device: '',
    brand: '',
    model: '',
    serial_number: '',
    description: '',
    price: '',
    status: '',
});

const openTaskInfo = ref(false)
// const selectedTask = ref()

const closeModal = () => {
    openTaskInfo.value = false
}

const handleInfo = (task) => {
    console.log(task)
    // selectedTask.value = task
    openTaskInfo.value = true

    form.device = task.device
    form.brand = task.brand
    form.model = task.model
    form.serial_number = task.serial_number
    form.description = task.description
    form.price = task.price
    form.status = task.status
}

const handleEdit = () => {
    console.log("edit")
}



const updateTask = () => {
    console.log(form)
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
</script>

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
                                <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500" placeholder="Search for items">
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
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 light:text-gray-400">
                            <thead class="text-s text-gray-700 bg-gray-100 light:bg-gray-700 light:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <!-- <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 light:focus:ring-blue-600 light:ring-offset-gray-800 light:focus:ring-offset-gray-800 focus:ring-2 light:bg-gray-700 light:border-gray-600">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label> -->
                                        </div>
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
                                    <th scope="col" class="px-6 py-3">
                                        Modelo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Número de série
                                    </th>
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
                            <tbody v-for="task in tasks" key="task.id">
                                <tr class="bg-white border-b light:bg-gray-800 light:border-gray-700 hover:bg-gray-100 light:hover:bg-gray-600 border-t-2">
                                    <td class="w-4 p-4">
                                        <!-- <div class="flex items-center ">
                                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 light:focus:ring-blue-600 light:ring-offset-gray-800 light:focus:ring-offset-gray-800 focus:ring-2 light:bg-gray-700 light:border-gray-600">
                                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                        </div> -->
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap light:text-white">
                                        {{ task['client']['name'] }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ task['device'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ task['brand'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ task['model'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ task['serial_number'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        R$ {{ task['price'] }}
                                    </td>
                                    <td class="px-6 py-4">
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
                                    <td class="px-6 py-4 flex justify-around">
                                        <button type="button" @click="handleInfo(task)" class="text-white bg-blue-400 hover:bg-blue-500 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-1 py-1 text-center inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                            </svg>
                                        </button>
                                        <button type="button" @click="handleEdit" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-2 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-1 py-1 text-center inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <nav aria-label="Page navigation example" class="flex justify-center">
                            <ul class="inline-flex -space-x-px text-sm">
                                <li>
                                    <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 light:bg-gray-800 light:border-gray-700 light:text-gray-400 light:hover:bg-gray-700 light:hover:text-white">Previous</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 light:bg-gray-800 light:border-gray-700 light:text-gray-400 light:hover:bg-gray-700 light:hover:text-white">1</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 light:bg-gray-800 light:border-gray-700 light:text-gray-400 light:hover:bg-gray-700 light:hover:text-white">2</a>
                                </li>
                                <li>
                                    <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 light:border-gray-700 light:bg-gray-700 light:text-white">3</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 light:bg-gray-800 light:border-gray-700 light:text-gray-400 light:hover:bg-gray-700 light:hover:text-white">4</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 light:bg-gray-800 light:border-gray-700 light:text-gray-400 light:hover:bg-gray-700 light:hover:text-white">5</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 light:bg-gray-800 light:border-gray-700 light:text-gray-400 light:hover:bg-gray-700 light:hover:text-white">Next</a>
                                </li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>

        <Modal :show="openTaskInfo" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete your account?
                </h2>

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
                            required
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
                            required
                        />

                        <InputError class="mt-2" :message="form.errors.serial_number" />
                    </div>

                    <div class="col-start-1 col-end-7">
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

                    <div class="col-start-1 col-end-3">
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

                    <div class="col-start-3 col-end-5">
                        <InputLabel for="status" value="Situação" />

                        <!-- <TextInput
                            id="status"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.status"
                            required
                        /> -->
                        <div class="flex py-3">
                            <div class="flex items-center me-4">
                                <input id="inline-radio" type="radio" value="" v-model="form.status" name="inline-radio-group" class="w-4 h-4 text-indigo-600 bg-gray-50 border-gray-300 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-indigo-600">
                                <InputLabel for="inline-radio" value="Pago" class="ms-1"/>
                                <!-- <label for="inline-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pago</label> -->
                            </div>
                            <div class="flex items-center me-4">
                                <input id="inline-2-radio" type="radio" value="" v-model="form.status" name="inline-radio-group" class="w-4 h-4 text-indigo-600 bg-gray-50 border-gray-300 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-indigo-600">
                                <InputLabel for="inline-2-radio" value="Pendente" class="ms-1"/>
                                <!-- <label for="inline-2-radio" class="ms-2 text-sm font-medium">Pendente</label> -->
                            </div>
                        </div>

                        <!-- <InputError class="mt-2" :message="form.errors.status" /> -->
                    </div>

                    <!-- <div class="flex items-center gap-4">
                        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                        </Transition>
                    </div> -->
                </form>

                
                <!-- <div class="flex space-x-4 overflow-hidden mt-2">
                    <img 
                        class="inline-block h-28 w-28 rounded-full ring-2 ring-white"
                        src="../../Assets/male.jpg"
                        alt="" 
                    />
                    <div class="grid grid-cols-1 divide-y">
                        <p class="mt-1 text-md text-gray-800">
                            {{ selectedTask['client']['name'] }}, 
                            {{ selectedTask['client']['phone'] }}
                        </p>
                        
                        <div>
                            <p class="mt-1 text-sm text-gray-600">
                                Dispositivo: {{ selectedTask['device'] }}
                            </p>
                            <p class="mt-1 text-sm text-gray-600">
                                Marca: {{ selectedTask['brand'] }}
                            </p>
                            <p class="mt-1 text-sm text-gray-600">
                                Modelo: {{ selectedTask['model'] }}
                            </p>
                            <p class="mt-1 text-sm text-gray-600">
                                Número de série: {{ selectedTask['serial_number'] }}
                            </p>
                            <p class="mt-1 text-sm text-gray-600">
                                Marca: {{ selectedTask['brand'] }}
                            </p>
                            <p class="mt-1 text-sm text-gray-600">
                                Marca: {{ selectedTask['brand'] }}
                            </p>
                            <p class="mt-1 text-sm text-gray-600">
                                Marca: {{ selectedTask['brand'] }}
                            </p>
                        </div>
                        
                        <p class="mt-1 text-sm text-gray-600">
                            {{ selectedTask }}
                        </p>
                    </div>
                </div> -->

                <!-- <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        @click="deleteUser"
                    >
                        Delete Account
                    </DangerButton>
                </div> -->
            </div>
        </Modal>
        
    </AuthenticatedLayout>
</template>
