<template>


    <div>
        <h3 class="text-base font-semibold leading-6 text-gray-900">Last 30 days</h3>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">

            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500"> </dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"> {{ credits.subscription_plan}} </dd>
            </div>

            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500"> Plan Words </dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"> {{ credits.credits }} </dd>
                <!--<dt class="truncate text-sm font-medium text-gray-500">
                    Renews {{ credits.expiration_date }}
                </dt>-->
            </div>

            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500"> Used Words </dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"> {{ 30121 }} </dd>
            </div>


        </dl>
    </div>



</template>



<script>
import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue';
import { CheckIcon, CheckCircleIcon } from '@heroicons/vue/20/solid';

export default {
    components: {

    },
    props:{
        credits: Object,
    },

    data() {
        return {

        };
    },
    methods: {

    },

    created() {

    }
};
</script>
