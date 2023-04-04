<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Template
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Favorites</span>
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                            </thead>
                            <!--<a :href="route('document.edit', document.uuid)"></a>-->
                            <tbody class="divide-y divide-gray-200 bg-white">

                            <tr v-for="document in filteredDocuments"
                                class="cursor-pointer hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                                tabindex="0">

                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                                    @click="rowClicked(document)">
                                    <i class="ri-article-line"></i> {{ document.name }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ document.template_key }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ document.updated_at }}
                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <i class="ri-heart-line"></i>
                                </td>

                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">

                                    <div class="ml-3 relative">

                                        <Dropdown align="right" width="60">

                                            <template #trigger>
                                                <button
                                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                    <i style="font-size: 24px" class="ri-more-line"></i>
                                                </button>

                                            </template>

                                            <template #content>
                                                <div class="">
                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        Manage Document
                                                    </div>

                                                    <DropdownLink href="">
                                                        Rename
                                                    </DropdownLink>

                                                    <DropdownLink href="">
                                                        Move
                                                    </DropdownLink>

                                                    <DropdownLink href="">
                                                        PDF Download
                                                    </DropdownLink>

                                                    <div class="border-t border-gray-200 dark:border-gray-600"/>

                                                    <DropdownLink @click="deleteDocument(document.uuid)">
                                                        Delete
                                                    </DropdownLink>
                                                </div>
                                            </template>
                                        </Dropdown>

                                    </div>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import {router} from "@inertiajs/vue3";
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

export default {
    components: {
        Dropdown,
        DropdownLink
    },
    props: {
        filteredDocuments: Object
    },
    methods: {
        rowClicked(document) {
            router.visit(route('document.edit', document.uuid))
        },

        deleteDocument(uuid){
            if (confirm('Are you sure you want to delete this document?')) {
                axios.delete(route('document.delete', [uuid]))
                    .then(response => {
                        //
                    }).catch(error => {
                    // capture error
                });
            }
        }

    }
}
</script>
