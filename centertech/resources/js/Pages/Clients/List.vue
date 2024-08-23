<template>
    <Head title="Clients" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clientes</h2>
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
                                <Link :href="route('clients.create')">
                                    <PrimaryButton>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        Cliente
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
                                    <th scope="col" class="px-6 py-3">
                                        Nome
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Telefone
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Serviços
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ação
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-for="client in clients['data']" key="client.id">
                                <tr class="bg-white border-b light:bg-gray-800 light:border-gray-700 hover:bg-gray-100 light:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <!-- <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 light:focus:ring-blue-600 light:ring-offset-gray-800 light:focus:ring-offset-gray-800 focus:ring-2 light:bg-gray-700 light:border-gray-600">
                                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label> -->
                                        </div>
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap light:text-white">
                                        {{ client['name'] }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ phoneMask(client['phone']) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ client['tasks'].length }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#" class="font-medium text-blue-600 light:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination :links="clients['links']" :from="clients['from']" :to="clients['to']" :total="clients['total']" />
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue"
import Pagination from '@/Components/Pagination.vue'
import throttle from 'lodash/throttle'
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue'


export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
        Pagination
    },
    props: {
        clients: {
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
           
        }
    },
    setup(props) {

        const searchQuery = ref(props.filters)


        watch(searchQuery, throttle(function () {
            router.get('/clients', { search: searchQuery.value }, {
                preserveState: true,
                replace: true
            })
        }), 500)


        return {
            searchQuery
        }
    }
}

</script>