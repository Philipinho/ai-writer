<template>
        <div class="mx-auto max-w-2xl px-6 lg:px-8 pt-10">

            <div class="mx-auto max-w-4xl">
                <h2 class="text-2xl font-semibold leading-7 text-indigo-600">Plans</h2>
                <!--<p class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                    Pricing plans for teams of all sizes
                </p>-->
            </div>

            <p class="mx-auto mt-4 max-w-2xl text-center text-lg leading-8 text-gray-600">
                Supercharge your writing today with our affordable plans
            </p>

            <div class="mt-5 flex justify-center">
                <RadioGroup v-model="frequency"
                            class="grid grid-cols-2 gap-x-1 rounded-full p-1 text-center text-xs font-semibold leading-5 ring-1 ring-inset ring-gray-200">
                    <RadioGroupLabel class="sr-only">Payment frequency</RadioGroupLabel>
                    <RadioGroupOption as="template" v-for="option in frequencies" :key="option.value" :value="option"
                                      v-slot="{ checked }">
                        <div :class="[checked ? 'bg-indigo-600 text-white' : 'text-gray-500', 'cursor-pointer rounded-full px-2.5 py-1']">
                            <span>{{ option.label }}</span>
                        </div>
                    </RadioGroupOption>
                </RadioGroup>
            </div>

            <div class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-2">

                <div v-for="plan in plans" :key="plan.id"
                     :class="[plan.featured ? 'bg-gray-900 ring-gray-900' : 'ring-gray-200', 'bg-white rounded-2xl p-4 ring-1 xl:p-4']">
                    <h3 :id="plan.id"
                        :class="[plan.featured ? 'text-white' : 'text-gray-900', 'text-lg font-semibold leading-8']">
                        {{ plan.name }}
                    </h3>
                    <p :class="[plan.featured ? 'text-gray-300' : 'text-gray-600', 'mt-4 text-sm leading-6']">
                        {{ plan.description }}
                    </p>
                    <!--
                    <div class="flex items-center justify-between gap-x-4">
                        <h3 :id="plan.id" :class="[plan.popular ? 'text-indigo-600' : 'text-gray-900', 'text-lg font-semibold leading-8']">{{ plan.name }}</h3>
                        <p v-if="plan.popular" class="rounded-full bg-indigo-600/10 px-2.5 py-1 text-xs font-semibold leading-5 text-indigo-600">Most popular</p>
                    </div>
                    -->
                    <p class="mt-6 flex items-baseline gap-x-1">
                        <span
                            :class="[plan.featured ? 'text-white' : 'text-gray-900', 'text-4xl font-bold tracking-tight']">
                            {{ typeof plan.price === 'string' ? plan.price : plan.price[frequency.value] }}
                        </span>

                        <span v-if="typeof plan.price !== 'string'"
                              :class="[plan.featured ? 'text-gray-300' : 'text-gray-600', 'text-sm font-semibold leading-6']">
                            {{ frequency.priceSuffix}}
                        </span>
                    </p>
                    <button @click="subscribe(plan, frequency)" :aria-describedby="plan.id"
                            :class="[plan.featured ? 'bg-white/10 text-white hover:bg-white/20 focus-visible:outline-white' : 'bg-indigo-600 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-indigo-600', 'w-full mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2']">
                        {{ plan.cta }}
                    </button>
                    <ul role="list" :class="[plan.featured ? 'text-gray-300' : 'text-gray-600', 'mt-8 space-y-3 text-sm leading-6 xl:mt-10']">
                        <li v-for="feature in plan.features" :key="feature" class="flex gap-x-3">
                            <CheckCircleIcon :class="[plan.featured ? 'text-white' : 'text-indigo-600', 'h-6 w-5 flex-none']"
                                       aria-hidden="true"/>
                            {{ feature }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</template>



<script>
import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue';
import { CheckIcon, CheckCircleIcon } from '@heroicons/vue/20/solid';

export default {
    components: {
        RadioGroup,
        RadioGroupLabel,
        RadioGroupOption,
        CheckIcon,
        CheckCircleIcon
    },
    props:{
        plans: Object,
    },

    data() {
        return {
            frequencies: [
                {value: 'monthly', label: 'Monthly', priceSuffix: '/month' },
                {value: 'yearly', label: 'Yearly', priceSuffix: '/year' }
            ],
            frequency: null
        };
    },
    methods: {
        subscribe(plan, frequency){
            const price_id = plan[frequency.value + '_id']

            axios.post(route('checkout'), {plan: plan.name, price_id: price_id})
                .then(response => {
                    window.location.href = response.data.url
                }).catch(error => {
                console.log(error.response.data)
            });
        }
    },

    created() {
        this.frequency = this.frequencies[0];
    }
};
</script>
