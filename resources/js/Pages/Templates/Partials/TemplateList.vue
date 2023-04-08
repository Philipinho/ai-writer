<script>
import TextInput from '@/Components/TextInput.vue';

export default {
    components: {
        TextInput,
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
    <div>
        <div class="pb-6 max-w-sm">
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

        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <li v-for="template in filteredTemplates"
                class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">

                <a :href="route('documents.create', {'template': template.key})"
                   class="flex w-full items-center justify-between space-x-6 p-6">
                    <div class="flex-1 truncate">
                        <div class="flex items-center space-x-3">
                            <h3 class="truncate text-sm font-medium text-gray-900">{{ template.name }}</h3>
                            <span
                                class="inline-block flex-shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">
                                        {{ template.key }}</span>
                        </div>
                        <p class="mt-1 truncate text-sm text-gray-500">{{ template.description }}</p>
                    </div>

                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                        <div style="font-size: 24px;"><i :class="template.icon"></i></div>
                    </div>

                </a>
            </li>
        </ul>

    </div>
</template>
