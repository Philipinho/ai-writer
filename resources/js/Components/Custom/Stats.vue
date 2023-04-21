<template>
    <div v-if="stats">
        <dl class="mt-5 grid divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow grid-cols-3 divide-x divide-y-0">

            <div class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900">Plan</dt>
                <dd class="mt-1 flex items-baseline justify-between block lg:flex">

                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                        {{ stats.plan }}
                    </div>
                </dd>
            </div>

            <div class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900">Credits</dt>
                <dd class="mt-1 flex items-baseline justify-between block lg:flex">

                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                        {{ stats.plan_credits }}
                    </div>
                </dd>
            </div>

            <div class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900">Used</dt>
                <dd class="mt-1 flex items-baseline justify-between block lg:flex">

                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                        {{ stats.credits_used }}
                    </div>
                </dd>
            </div>


        </dl>
    </div>
</template>


<script>
import moment from 'moment';

export default {
    props:{
        hideDivs: Boolean,
    },

    data() {
        return {
            stats: null,
            moment: moment,
        };
    },
    methods: {
        getStats() {
            axios.get(route('api.usage'))
                .then(response => {
                    this.stats = response.data.usage;
                }).catch(error => {
                console.log(error)
            });
        },
    },

    created() {
        this.getStats();
    },
};
</script>

