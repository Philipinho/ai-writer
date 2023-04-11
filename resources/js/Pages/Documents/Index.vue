<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import DocumentList from '@/Pages/Documents/Partials/DocumentList.vue'

export default {
    components: {
        AppLayout,
        DocumentList,
    },
    props: {
        documents: Object,
    },
}

</script>

<template>
    <AppLayout title="Templates">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Documents
            </h2>
        </template>

        <div class="max-w-5xl 2xl:max-w-6xl mx-auto sm:px-6 lg:px-8">

            <DocumentList :documents="documents" />

        </div>
    </AppLayout>
</template>
