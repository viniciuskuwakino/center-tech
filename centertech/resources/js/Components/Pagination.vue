<template>
    <div>
        <div class="flex justify-center mt-5">
            asd
        </div>
        <nav aria-label="Page navigation example" class="flex justify-center">
            <ul class="inline-flex -space-x-px text-sm" v-for="link in links">
                <li>
                    <Link
                        v-if="link['label'].includes('Previous')"
                        v-html="link['label'].replace('Previous', 'Anterior')"
                        :href="link['url'] ? link['url'] : '#'"
                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 light:bg-gray-800 light:border-gray-700 light:text-gray-400 light:hover:bg-gray-700 light:hover:text-white"
                    ></Link>

                    <Link
                        v-else-if="link['label'].includes('Next')"
                        v-html="link['label'].replace('Next', 'Próximo')"
                        :href="link['url'] ? link['url'] : '#'"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 light:bg-gray-800 light:border-gray-700 light:text-gray-400 light:hover:bg-gray-700 light:hover:text-white"
                    ></Link>

                    <!-- <div v-else>
                        <Link
                            v-if="link['active']"
                            aria-current="page"
                            :href="link['url']"
                            class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 light:border-gray-700 light:bg-gray-700 light:text-white"
                        >
                            {{ link['label'] }}
                        </Link>
                        <Link
                            v-else
                            :href="link['url']"
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 light:bg-gray-800 light:border-gray-700 light:text-gray-400 light:hover:bg-gray-700 light:hover:text-white"
                        >
                            {{ link['label'] }}
                        </Link>

                    </div> -->
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
    components: {
        Link
    },
    props: {
        links: {
            type: Array,
        },
    }
}

</script>