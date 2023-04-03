<script>
import TextInput from '@/Components/TextInput.vue';
import GridView from '@/Pages/Documents/Partials/GridView.vue';
import ListView from '@/Pages/Documents/Partials/ListView.vue';
import ButtonIcon from '@/Components/ButtonIcon.vue'
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
    <div>

        <div class="sm:flex sm:items-center">

            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <Link :href="route('document.new')">
                    <ButtonIcon>Create Document</ButtonIcon>
                </Link>
            </div>

            <div class="pl-10">
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

        </div>

        <ListView :filteredDocuments="filteredDocuments"/>

    </div>
</template>
