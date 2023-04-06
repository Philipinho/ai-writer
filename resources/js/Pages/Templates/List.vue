<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import TemplateList from '@/Pages/Templates/Partials/TemplateList.vue'

export default {
    components: {
        AppLayout,
        TemplateList,
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

        <div>

            <pre>{{ JSON.stringify(templates, null, 2) }}</pre>

        </div>
    </AppLayout>
</template>
