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

        <Stats :credits="credits" v-if="subscribed"/>

        <Manage v-if="subscribed"/>

        <Plans :plans="plans" v-if="!subscribed"/>

    </AppLayout>
</template>
