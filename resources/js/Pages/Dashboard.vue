<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link} from '@inertiajs/vue3';
import Stats from '@/Components/Custom/Stats.vue';
import TemplatesGrid from '@/Pages/Templates/Partials/TemplatesGrid.vue';
import DocumentListView from '@/Pages/Documents/Partials/ListView.vue';
import ButtonIcon from '@/Components/ButtonIcon.vue';


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
        documents: Object
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

            <Link :href="route('documents.create')">
                <ButtonIcon>Create Document</ButtonIcon>
            </Link>

           <!-- <Stats/> -->

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
