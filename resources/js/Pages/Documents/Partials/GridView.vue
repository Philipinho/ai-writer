<template>
    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <li v-for="document in filteredDocuments"
            class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">

            <a :href="route('documents.edit', document.uuid)"
               class="flex w-full items-center justify-between space-x-6 p-6">
                <div class="flex-1 truncate">
                    <div class="flex items-center space-x-3">
                        <h3 class="truncate text-sm font-medium text-gray-900">{{ document.name }}</h3>
                        <span
                            class="inline-block flex-shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">
                                        {{ document.key }}</span>
                    </div>
                    <p class="mt-1 truncate text-sm text-gray-500">{{ document.description }}</p>
                </div>

                <div class="h-10 w-10 flex items-center justify-center">
                    <div style="font-size: 24px;"><i class="ri-article-line"></i></div>
                </div>

            </a>
        </li>
    </ul>
</template>

<script>
export default {
    props: {
        filteredDocuments: Object
    }
}
</script>
