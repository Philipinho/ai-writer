<script>
import TextInput from '@/Components/TextInput.vue';
import TemplatesGrid from '@/Pages/Templates/Partials/TemplatesGrid.vue';

export default {
    components: {
        TextInput,
        TemplatesGrid
    },
    props: {
        templates: Object,
    },
    data() {
        return {
            search: '',
        }
    },
    computed: {
        filteredTemplates() {
            return this.templates.filter(
                template => {
                    return template.name.toLowerCase().includes(this.search.toLowerCase())
                        || template.description.toLowerCase().includes(this.search.toLowerCase());
                }
            )
        }
    }

}

</script>


<template>

    <div class="pb-6">
        <div class="relative flex items-center">
            <div
                class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400 pl-3 flex items-center justify-center"
                style="font-size: 24px" aria-hidden="true">
                <i class="ri-search-line"></i>
            </div>

            <TextInput
                v-model="search"
                name="search"
                type="search"
                class="mt-1 block w-full pl-8"
                placeholder="Search.."
            />
        </div>
    </div>


    <div class="flex flex-wrap px-4">
        <ul class="flex flex-wrap mr-3 md:mr-0 text-slate-600">
            <li class="mr-2 mb-2">
                <a class="block cursor-pointer px-2.5 py-1 rounded border border-gray-200 bg-indigo-500 text-white font-bold">
                    All
                </a>
            </li>
            <!--
            <li class="mr-2 mb-2">
                <a class="block cursor-pointer px-2.5 py-1 rounded border border-gray-200 bg-white font-bold">
                    Content
                </a>
            </li>
            <li class="mr-2 mb-2">
                <a class="block cursor-pointer px-2.5 py-1 rounded border border-gray-200 bg-white font-bold">
                    Social Media
                </a>
            </li>
            -->
        </ul>
    </div>

    <TemplatesGrid :templates="filteredTemplates"/>

</template>
