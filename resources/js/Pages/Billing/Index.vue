<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Plans from '@/Pages/Billing/Partials/Plans.vue';

export default {
    components: {
        AppLayout,
        Plans
    },
    props: {
        plans: Object,
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

        <div>

            <Plans :plans="plans"/>

        </div>
    </AppLayout>
</template>
