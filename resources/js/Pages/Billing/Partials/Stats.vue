<template>


    <div class="mx-auto max-w-2xl px-6 lg:px-8">

        <h3 class="text-2xl font-semibold leading-6 text-gray-900">Subscription</h3>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">

            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Current Plan</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"> {{ credits.subscription_plan }}
                </dd>
            </div>

            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500"> Plan Words</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"> {{ credits.credits }}</dd>
                <!--
                <dt class="truncate text-sm font-medium text-gray-500">
                    Renews {{ credits.expiration_date }}
                </dt>
                -->

            </div>

            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500"> Used Words</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"> {{ 30121 }}</dd>
            </div>

        </dl>

        <div class="mt-4">

            <div class="flex flex-row justify-between mb-2">
                <div class="font-medium">
                    Credits Used
                </div>

                <div class="font-medium">
                    <div class="font-bold">2000 / {{ credits.credits }}</div>
                </div>
            </div>

            <div class="flex w-full h-4 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                <div
                    class="flex flex-col justify-center overflow-hidden bg-indigo-600 text-md font-bold text-white text-center"
                    role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100">57%
                </div>
            </div>

            <div class="mt-2">Credits will reset on <span class="font-bold">{{ credits.expiration_date }}</span></div>

        </div>


    </div>
</template>


<script>
import {RadioGroup, RadioGroupLabel, RadioGroupOption} from '@headlessui/vue';
import {CheckIcon, CheckCircleIcon} from '@heroicons/vue/20/solid';

export default {
    components: {},
    props: {
        credits: Object,
    },

    data() {
        return {};
    },
    methods: {},

    created() {

    }
};
</script>
