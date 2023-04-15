<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Tiptap from "@/Components/Editor/Tiptap.vue";
import DocumentsForm from "@/Pages/Documents/Partials/DocumentsForm.vue";
import InputLabel from '@/Components/Jetstream/InputLabel.vue';
import TextInput from '@/Components/Jetstream/TextInput.vue';
import debounce from 'debounce'
import { useToast } from "vue-toastification";


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
            debouncedUpdateDocumentName: debounce(this.updateDocumentName, 1500),
            toast: useToast(),
            currentTemplate: '',
        };
    },
    watch: {
        documentName(newName) {
            this.debouncedUpdateDocumentName(newName);
        }

    },
    methods: {
        updateDocumentName(newName) {
            axios.put(route('documents.update', [this.data.values.uuid]), {name: newName, action: 'update_name'})
                .then((response) => {
                    this.toast.success("Document title updated successfully")
                })
                .catch((error) => {

                    this.toast.error("There was an error updating document title")
                });
        },

        updateEditorContent(content) {
            this.editorContent = content;
        },
        onSelectedTemplate(template) {
            this.currentTemplate = template;
        },
    },
};
</script>

<template>
    <AppLayout title="Document" >


        <div class="sm:-mt-14 md:mt-0 bg-white md:w-1/3">
            <div class="px-4 py-5 sm:p-6">
                <h2 class="text-xl font-semibold leading-6 text-gray-900">
                    <i :class="[currentTemplate.icon, 'mr-1 text-indigo-700']"/> {{ currentTemplate.name}}</h2>
                <div class="mt-2 max-w-xl text-sm text-gray-500">
                    <p>{{ currentTemplate.description}}</p>
                </div>

            </div>
            <div class="border-b border-gray-200"></div>
        </div>

        <div class="flex mt-5 md:hidden">
            <div class="w-80 mb-5">
                <!--<InputLabel for="document_title" value="Name"/>-->

                <TextInput
                    name="document_title"
                    v-model="documentName"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="e.g ad copy"
                />

            </div>
        </div>

        <div class="container mx-auto">

            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">

                <div class="lg:w-1/3 md:mt-8 border-r border-gray-200" style="max-height: 100%;">

                    <div class="bg-white p-4">
                        <div class="h-full">
                            <DocumentsForm @contentReceived="updateEditorContent"
                                           @selectedTemplate="onSelectedTemplate"
                                           :data="data" :templates="templates">
                            </DocumentsForm>
                        </div>
                    </div>

                </div>

                <div class="p-4 md:w-1/2 grow h-full md:fixed md:right-0 md:bottom-0 sm:top-12 md:top-4">
                    <div class="w-80 mb-5 hidden md:block">
                        <!--<InputLabel for="document_title" value="Name"/>-->

                        <TextInput
                            name="document_title"
                            v-model="documentName"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="e.g ad copy"
                        />

                    </div>
                    <Tiptap :content="editorContent" :data="data"/>
                </div>
            </div>

        </div>

    </AppLayout>
</template>

