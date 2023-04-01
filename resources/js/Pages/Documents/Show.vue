<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Tiptap from "@/Components/Editor/Tiptap.vue";
import DocumentsForm from "@/Pages/Documents/Partials/DocumentsForm.vue";

export default {
    components: {
        AppLayout,
        Tiptap,
        DocumentsForm
    },
    props: {
        data: {
            type: Object,
            default: '',
        },
        templates: {
            type: Object,
        },
        modelValue: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            inputValue: '',
        };
    },
    methods: {},
};
</script>

<template>
    <AppLayout title="Document">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Document
            </h2>
        </template>

                <div class="grid grid-cols-12 gap-6">

                    <div class="flex flex-col col-span-full xl:col-span-5 bg-white shadow-lg rounded-sm border border-slate-200">
                        <header class="px-5 py-4 border-b border-slate-100 flex items-center">
                            <h2 class="font-semibold text-slate-800">Prompt</h2>
                        </header>
                        <div class="grow px-5">
                            <DocumentsForm :data="data" :templates="templates"></DocumentsForm>

                        </div>
                    </div>

                    <div class="flex flex-col col-span-full xl:col-span-7 bg-white shadow-lg rounded-sm border border-slate-200">
                        <header class="px-5 py-4 border-b border-slate-100">
                            <h2 class="font-semibold text-slate-800">Document Editor</h2>
                        </header>
                        <!-- Card content -->
                        <div class="flex flex-col h-full">

                            <!-- Table -->
                            <div class="grow px-5 pt-3 pb-1">
                                <div class="overflow-x-auto">

                                    <Tiptap />

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


    </AppLayout>
</template>

