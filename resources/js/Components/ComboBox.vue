<script setup>
import { ref, computed, watch, onBeforeMount } from 'vue'
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
} from '@headlessui/vue'


const emit = defineEmits(['getClient'])

const props = defineProps({
    clients: {
        type: Object,
    }
});

// ------------------- Vars -------------------

let selected = ref()
let query = ref('')

// ------------------- Functions -------------------

let filteredClient = computed(() =>
    query.value === ''
        ? props.clients
        : props.clients.filter((client) =>
            client.name
            .toLowerCase()
            .replace(/\s+/g, '')
            .includes(query.value.toLowerCase().replace(/\s+/g, ''))
        )
)

// ------------------- Watchers -------------------

watch(selected, () => {
    emit('getClient', selected)
})

function localMask(phone) {

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


</script>

<template>
    <div class="top-16 w-2/5">
        <Combobox v-model="selected">
            <div class="relative mt-1">
                <div
                    class="relative w-full cursor-default overflow-hidden rounded-lg bg-white text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"
                >
                    <ComboboxInput
                        class="w-full border-none py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
                        :displayValue="(client) => client.name + ', ' + localMask(client.phone)"
                        @change="query = $event.target.value"
                    />
                    <ComboboxButton
                        class="absolute inset-y-0 right-0 flex items-center pr-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </ComboboxButton>
                </div>
                <TransitionRoot
                    leave="transition ease-in duration-100"
                    leaveFrom="opacity-100"
                    leaveTo="opacity-0"
                    @after-leave="query = ''"
                >
                    <ComboboxOptions
                        class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                    >
                        <div
                            v-if="filteredClient.length === 0 && query !== ''"
                            class="relative cursor-default select-none px-4 py-2 text-gray-700"
                        >
                            Nothing found.
                        </div>
                        <ComboboxOption
                            v-for="client in filteredClient"
                            as="template"
                            :key="client.id"
                            :value="client"
                            v-slot="{ selected, active }"
                        >
                            <li
                                class="relative cursor-default select-none py-2 pl-10 pr-4"
                                :class="{
                                    'bg-indigo-500 text-white': active,
                                    'text-gray-900': !active,
                                }"
                            >
                                <span
                                    class="block truncate"
                                    :class="{ 'font-medium': selected, 'font-normal': !selected }"
                                >
                                    {{ client.name }}, {{ localMask(client.phone) }}
                                </span>
                                <span
                                    v-if="selected"
                                    class="absolute inset-y-0 left-0 flex items-center pl-3"
                                    :class="{ 'text-white': active, 'text-indigo-500': !active }"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>

                                </span>
                            </li>
                        </ComboboxOption>
                    </ComboboxOptions>
                </TransitionRoot>
            </div>
        </Combobox>
    </div>
</template>