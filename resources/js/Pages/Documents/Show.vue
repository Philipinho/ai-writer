<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Tiptap from "@/Components/Editor/Tiptap.vue";
import DocumentsForm from "@/Pages/Documents/Partials/DocumentsForm.vue";
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import debounce from 'debounce'


export default {
    components: {
        AppLayout,
        Tiptap,
        DocumentsForm,
        InputLabel,
        TextInput,
    },
    props: {
        data: {
            type: Object,
            default: '',
        },
        templates: {
            type: Object,
        }
    },
    data() {
        return {
            editorContent: '',
            documentName: this.data.values.name,
            debouncedUpdateDocumentName: debounce(this.updateDocumentName, 500),
        };
    },
    watch: {
        documentName(newName){
            console.log(`Input value changed to ${newName}`);
            this.debouncedUpdateDocumentName(newName);
        }

    },
    methods: {
        updateDocumentName(newName) {
            axios.put(route('document.update', [this.data.values.uuid]), { name: newName, action: 'update_name' });
        },

        updateEditorContent(content) {
            this.editorContent = content;
        }
    },
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
                            <DocumentsForm @contentReceived="updateEditorContent" :data="data" :templates="templates"></DocumentsForm>

                        </div>
                    </div>

                    <div class="flex flex-col col-span-full xl:col-span-7  ">

                        <div class="sm:col-span-4">
                            <InputLabel for="document_title" value="Name"/>

                            <TextInput
                                name="document_title"
                                v-model="documentName"
                                type="text"
                                class="mt-1 block w-full"
                                placeholder="e.g ad copy"
                            />

                        </div>
                        <header class="px-5 py-4 border-b border-slate-100">
                            <h2 class="font-semibold text-slate-800">Document Editor</h2>
                        </header>
                        <!-- Card content -->
                        <div class="flex flex-col h-full">

                            <!-- Table -->
                            <div class="grow px-5 pt-3 pb-1">
                                <div class="overflow-x-auto">

                                    <Tiptap :content="editorContent" :data="data" />

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


    </AppLayout>
</template>

