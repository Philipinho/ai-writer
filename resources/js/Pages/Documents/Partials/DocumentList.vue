<script>
import TextInput from '@/Components/Jetstream/TextInput.vue';
import GridView from '@/Pages/Documents/Partials/GridView.vue';
import ListView from '@/Pages/Documents/Partials/ListView.vue';
import ButtonIcon from '@/Components/Jetstream/ButtonIcon.vue'
import {Link} from '@inertiajs/vue3';

export default {
    components: {
        TextInput,
        GridView,
        ListView,
        ButtonIcon,
        Link
    },
    props: {
        documents: Object,
    },
    data() {
        return {
            search: '',
        }
    },
    computed: {
        filteredDocuments() {
            return this.documents.filter(
                document => {
                    return document.name.toLowerCase().includes(this.search.toLowerCase());
                }
            )
        }
    }

}

</script>

<template>

    <Link :href="route('documents.create')">
        <ButtonIcon>Create Document</ButtonIcon>
    </Link>

    <div class="pb-2 mt-4">
        <div class="relative flex items-center">
            <div
                class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400 pl-3 flex items-center justify-center"
                style="font-size: 24px" aria-hidden="true">
                <i class="ri-search-line"></i>
            </div>

            <TextInput
                v-model="search"
                name="search"
                type="search"
                class="mt-1 block w-full pl-8"
                placeholder="Search.."
            />
        </div>
    </div>

    <ListView :filteredDocuments="filteredDocuments"/>

</template>
