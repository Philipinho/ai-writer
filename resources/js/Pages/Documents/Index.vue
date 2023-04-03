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

        <div>

            <DocumentList :documents="documents" />

        </div>
    </AppLayout>
</template>
