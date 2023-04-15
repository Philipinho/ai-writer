<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import ContentHistory from '@/Pages/Documents/Partials/ContentHistory.vue'
import Pagination from "@/Shared/Pagination.vue";

export default {
    components: {
        ContentHistory,
        AppLayout,
        Pagination
    },
    props: {
        contents: Object,
    },
}

</script>

<template>
    <AppLayout title="Content Generation History">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Content Generation History
            </h2>
        </template>

        <div class="max-w-5xl 2xl:max-w-6xl mx-auto sm:px-6 lg:px-8">

            <ContentHistory :contents="contents.data" />

            <Pagination class="mt-6" :links="contents.links" />

        </div>
    </AppLayout>
</template>
