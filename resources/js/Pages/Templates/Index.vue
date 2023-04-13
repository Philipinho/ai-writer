<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import TemplateView from '@/Pages/Templates/Partials/TemplateView.vue'

export default {
    components: {
        AppLayout,
        TemplateView,
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

        <div class="max-w-5xl 2xl:max-w-6xl mx-auto sm:px-6 lg:px-8">

            <TemplateView :templates="templates" />

        </div>
    </AppLayout>
</template>
