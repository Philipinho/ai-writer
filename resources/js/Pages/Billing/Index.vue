<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Plans from '@/Pages/Billing/Partials/Plans.vue';
import Stats from '@/Pages/Billing/Partials/Stats.vue';

export default {
    components: {
        AppLayout,
        Plans,
        Stats
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

        <Plans :plans="plans" v-if="!subscribed"/>

    </AppLayout>
</template>
