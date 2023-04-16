<template>

    <div v-if="stats">

        <div v-if="!hideDivs" class="flex flex-row justify-between mb-2">
            <div class="font-medium">
                Credits Used
            </div>

            <div class="font-medium">
                <div class="font-bold">{{ stats.credits_used }} / {{ stats.plan_credits }}</div>
            </div>
        </div>

        <div class="flex w-full h-4 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
            <div
                class="flex flex-col justify-center overflow-hidden bg-indigo-600 text-md font-bold text-white text-center"
                role="progressbar" :style="{ width: stats.percent_used + '%' }" :aria-valuenow="stats.percent_used"
                aria-valuemin="0" aria-valuemax="100">
                {{ stats.percent_used }}%

            </div>
        </div>

        <div v-if="!hideDivs" class="mt-2">Credits will reset on <span class="font-bold">
            {{ this.moment(stats.expiration_date).format('MMM D, YYYY') }}
        </span>
        </div>

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
