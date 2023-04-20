<template>
    <h3 class="text-2xl font-semibold leading-6 text-gray-900">Subscription</h3>
    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">

        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Current Plan</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"> {{ stats.plan }}
            </dd>
        </div>

        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Plan Credits</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                {{ stats.plan_credits }} <span class="text-sm">/ {{ stats.interval }}</span>
            </dd>
            <!--
            <dt class="truncate text-sm font-medium text-gray-500">
                Renews {{ credits.expiration_date }}
            </dt>
            -->

        </div>

        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500"> Used Words</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"> {{ stats.credits_used }}</dd>
        </div>

    </dl>

    <div class="py-5">
        <StatsBar/>
    </div>

</template>


<script>
import StatsBar from "@/Shared/StatsBar.vue";
import moment from 'moment';

export default {
    components: {
        StatsBar
    },
    props: {
        credits: Object,
        stats: Object
    },

    data() {
        return {
            moment: moment
        };
    },
    methods: {},

    created() {

    }
};
</script>
