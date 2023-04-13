<template>
        <h3 class="text-2xl font-semibold leading-6 text-gray-900">Subscription</h3>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">

            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Current Plan</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"> {{ credits.plan }}
                </dd>
            </div>

            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500"> Plan Words</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"> {{  stats.plan_credits }}</dd>
                <!--
                <dt class="truncate text-sm font-medium text-gray-500">
                    Renews {{ credits.expiration_date }}
                </dt>
                -->

            </div>

            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500"> Used Words</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"> {{  stats.credits_used }} </dd>
            </div>

        </dl>

        <div class="py-5">

            <div class="flex flex-row justify-between mb-2">
                <div class="font-medium">
                    Credits Used
                </div>

                <div class="font-medium">
                    <div class="font-bold">{{  stats.credits_used }} / {{ stats.plan_credits }}</div>
                </div>
            </div>

            <div class="flex w-full h-4 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                <div
                    class="flex flex-col justify-center overflow-hidden bg-indigo-600 text-md font-bold text-white text-center"
                    role="progressbar" :style="{ width: stats.percent_used + '%' }" :aria-valuenow="stats.percent_used" aria-valuemin="0" aria-valuemax="100">
                    {{ stats.percent_used }}

                </div>
            </div>

            <div class="mt-2">Credits will reset on <span class="font-bold">{{ credits.expiration_date }}</span></div>

        </div>
</template>


<script>
export default {
    components: {},
    props: {
        credits: Object,
        stats: Object
    },

    data() {
        return {};
    },
    methods: {},

    created() {

    }
};
</script>
