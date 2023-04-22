<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout,
    },
    props: {
        templates: Object,
    },
}

</script>

<template>
    <AppLayout title="Templates">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Templates
            </h2>
        </template>


        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div v-for="template in templates" :key="template.id" class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                <div class="flex-shrink-0">
                    <i :class="template.icon"/>
                </div>

                <div class="min-w-0 flex-1">
                    <a :href="route('templates.edit', { id: template.id })" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true" />
                        <p class="text-sm font-medium text-gray-900">{{ template.name }}</p>
                        <p class="truncate text-sm text-gray-500">{{ template.description }}</p>
                    </a>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
