<!-- DataDisplay.vue -->
<template>
    <div>
        <div v-for="(output, outputIndex) in outputs" :key="outputIndex" class="mb-4">


            <div v-for="(item, itemIndex) in output" :key="itemIndex" class="bg-white shadow rounded p-4 mb-4">

                <div class="flex space-x-3">
                    <!--<div class="flex-shrink-0">

                    </div>-->
                    <div class="min-w-0 flex-1">
                        <button @click="copyToClipboard(item.content)" type="button"
                                class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                            <ClipboardDocumentIcon class="h-5 w-5" aria-hidden="true"/>
                            <span class="font-bold text-gray-900">Copy</span>
                        </button>
                    </div>
                    <!--
                    <div class="min-w-0 flex-1">
                        <button @click="copyToClipboard(item.content)" type="button"
                                class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                            <ClipboardDocumentIcon class="h-5 w-5" aria-hidden="true"/>
                            <span class="font-bold text-gray-900">Copy to editor</span>
                        </button>
                    </div>
                    -->
                </div>

                <div v-html="sanitizeHTML(item.content)"></div>
            </div>

        </div>
    </div>
</template>

<script>
import DOMPurify from 'dompurify';
import {useToast} from "vue-toastification";
import {ClipboardDocumentIcon} from "@heroicons/vue/24/outline";

export default {

    components: {
        ClipboardDocumentIcon
    },
    props: {
        outputs: Array,
    },
    data() {
        return {
            toast: useToast(),
        }
    },
    methods: {
        async copyToClipboard(contentToCopy) {
            try {
                await navigator.clipboard.writeText(contentToCopy);
                this.toast.success("Content copied to clipboard!");
            } catch (error) {
                console.error("Failed to copy text: ", error);
                this.toast.error("Failed to copy text to clipboard.");
            }
        },
        sanitizeHTML(html) {
            return DOMPurify.sanitize(html);
        },
    },
};
</script>
