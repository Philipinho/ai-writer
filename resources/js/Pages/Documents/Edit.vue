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
        }
    },
};
</script>

<template>
    <AppLayout title="Document">

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

                <div class="lg:w-1/3 md:mt-24" style="max-height: 100vh;">

                    <div class="overflow-y-auto bg-white p-4">
                        <div class="h-full">
                            <DocumentsForm @contentReceived="updateEditorContent"
                                           :data="data" :templates="templates">
                            </DocumentsForm>
                        </div>
                    </div>

                </div>

                <div class="p-4 md:w-1/2 grow h-full md:fixed md:right-0 md:bottom-0 md:top-16">
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

