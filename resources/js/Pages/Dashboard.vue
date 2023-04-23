<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link} from '@inertiajs/vue3';
import Stats from '@/Components/Custom/Stats.vue';
import TemplatesGrid from '@/Pages/Templates/Partials/TemplatesGrid.vue';
import DocumentListView from '@/Pages/Documents/Partials/ListView.vue';
import ButtonIcon from '@/Components/Jetstream/ButtonIcon.vue';
import moment from "moment";


export default {
    components: {
        AppLayout,
        Link,
        Stats,
        TemplatesGrid,
        ButtonIcon,
        DocumentListView
    },
    props: {
        templates: Object,
        documents: Object,
        stats: Object
    },

    data() {
        return {
            moment: moment
        }
    }
}

</script>

<template>
    <AppLayout title="Dashboard">

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="max-w-5xl 2xl:max-w-6xl mx-auto sm:px-6 lg:px-8">


            <div v-if="stats.credits_left === 0" class="rounded-md bg-blue-50 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">

                    </div>
                    <div class="ml-3 flex-1 md:flex md:justify-between">
                        <p class="text-base font-medium text-blue-700">
                            <span>You have exhausted your credits. Your credits will reset on
                                <span class="font-bold">{{ this.moment(stats.expiration_date).format('MMM D') }}</span>.
                                   <a :href="route('billing')">Upgrade to get more credits.</a></span>
                        </p>
                        <p class="mt-3 text-base md:ml-6 md:mt-0">
                            <a :href="route('billing')"
                               class="whitespace-nowrap font-medium text-blue-700 hover:text-blue-600">
                                Upgrade
                                <span aria-hidden="true"> &rarr;</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <Link :href="route('documents.create')">
                <ButtonIcon>Create Document</ButtonIcon>
            </Link>

            <Stats/>

            <div class="mt-5">
                <div class="flex justify-between">
                    <h2 class="text-lg font-bold">Popular Templates</h2>
                    <Link :href="route('templates.index')"
                          class="p-1 rounded-lg border border-gray-200 font-bold bg-white text-indigo-600">
                        See all templates
                    </Link>
                </div>

                <TemplatesGrid :templates="templates"/>

            </div>

            <div class="mt-5">
                <div class="flex justify-between">
                    <h2 class="text-lg font-bold">Documents Activity</h2>
                    <Link :href="route('documents.index')"
                          class="p-1 rounded-lg border border-gray-200 font-bold bg-white text-indigo-600">
                        See all documents
                    </Link>
                </div>

                <DocumentListView :filteredDocuments="documents"/>

            </div>


        </div>
    </AppLayout>
</template>
