<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Plans from '@/Pages/Billing/Partials/Plans.vue';
import Stats from '@/Pages/Billing/Partials/Stats.vue';
import Manage from "@/Pages/Billing/Partials/Manage.vue";

export default {
    components: {
        Manage,
        AppLayout,
        Plans,
        Stats,
    },
    props: {
        plans: Object,
        credits: Object,
        usage_stats: Object,
        subscribed: Boolean
    },
}

</script>

<template>
    <AppLayout title="Templates">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Billing
            </h2>
        </template>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <Stats :credits="credits" :stats="usage_stats"/>

            <Manage v-if="subscribed"/>

            <Plans :plans="plans" v-if="!subscribed"/>
        </div>

    </AppLayout>
</template>
