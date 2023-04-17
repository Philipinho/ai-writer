<script>
import TextInput from '@/Components/Jetstream/TextInput.vue';
import TemplatesGrid from '@/Pages/Templates/Partials/TemplatesGrid.vue';

export default {
    components: {
        TextInput,
        TemplatesGrid
    },
    props: {
        templates: Object,
        categories: Object,
    },

    data() {
        return {
            selectedCategory: null,
            search: '',
        };
    },
    computed: {
        filteredTemplates() {
            let filteredTemplates = this.templates;

            // Filter by category
            if (this.selectedCategory) {
                filteredTemplates = filteredTemplates.filter((template) =>
                    template.categories.some(
                        (category) => category.id === this.selectedCategory.id
                    )
                );
            }

            // Filter by search query
            if (this.search.trim()) {
                filteredTemplates = filteredTemplates.filter((template) =>
                    template.name.toLowerCase().includes(this.search.trim().toLowerCase())
                    || template.description.toLowerCase().includes(this.search.trim().toLowerCase())
                );
            }

            return filteredTemplates;
        },

    },
    methods: {
        selectCategory(category) {
            this.selectedCategory = category;
        },
    },

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
            <li class="mr-2 mb-2 block cursor-pointer px-2.5 py-1 rounded border border-gray-200 font-bold"
                    @click="selectCategory(null)"
                    :class="{'bg-indigo-700 text-white': !selectedCategory, 'bg-white text-gray-700': selectedCategory}">
                All
            </li>

            <li v-for="category in categories"
                :key="category.id"
                class="mr-2 mb-2 block cursor-pointer px-2.5 py-1 rounded border border-gray-200 font-bold"
                @click="selectCategory(category)"
                :class="{ 'bg-indigo-700 text-white': selectedCategory && selectedCategory.id === category.id,
                'bg-white text-gray-700': !selectedCategory || selectedCategory.id !== category.id}">
                {{ category.name }}
            </li>

        </ul>
    </div>


    <TemplatesGrid :templates="filteredTemplates"/>

</template>



