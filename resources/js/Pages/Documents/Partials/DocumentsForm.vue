<script>
import {reactive, ref} from 'vue';
import {useForm} from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

export default {
    components: {
        reactive,
        ref,
        useForm,
        InputLabel,
        PrimaryButton,
        TextInput
    },

    props: {
        data: {
            type: Object,
        },
        templates: {
            type: Object
        }
    },
    remember: 'form',
    data() {
        return {
            form: {
                name: this.data.values.name,
                errors: [],
            },
            selectedKey: this.getDefaultSelectedKey(),
        };
    },
    computed: {
        selectedFields() {
            return this.templates.find(item => item.key === this.selectedKey)?.fields || [];
        },
        selectedTemplateIndex() {
            return this.templates.findIndex(item => item.key === this.selectedKey);
        },
        selectedTemplate() {
            if (this.templates && this.selectedTemplateIndex >= 0) {
                return this.templates[this.selectedTemplateIndex];
            }
            return null;
        }
    },
    methods: {
        getDefaultSelectedKey() {
            const defaultKey = "summarize";

            // Check if the provided template key exists in the templates array
            const templateExists = this.templates.some((item) => item.key === this.data.values.template);

            // If the provided template key exists, use it; otherwise, use the default key
            return templateExists ? this.data.values.template : defaultKey;
        },

        getFormData(form) {
            const formData = {
                inputLabels: {},
            };
            // Create a Set containing the names of fields in selectedFields
            const selectedFieldNames = new Set(this.selectedFields.map(field => field.name));

            // Loop through all input elements in the form
            for (const inputElement of form.elements) {
                if (inputElement.tagName === 'BUTTON') continue; // Skip buttons
                // If the input element's name is in selectedFieldNames, add it to the 'inputLabels' node
                if (selectedFieldNames.has(inputElement.name)) {
                    formData.inputLabels[inputElement.name] = inputElement.value;
                } else {
                    formData[inputElement.name] = inputElement.value;
                }
            }
            return formData;
        },

        createDocument() {
            this.form.processing = true;
            const form = this.$refs.documentCreateForm;
            const formData = this.getFormData(form);

            axios.post(route('documents.generate', [this.data.values.uuid]), formData)
                .then(response => {
                    this.$emit('contentReceived', response.data.data.content)
                    this.form.processing = false;
                }).catch(error => {
                    console.log("Error:")
                    console.log(error.response.data)
                this.form.processing = false;
            });
        }
    }
};
</script>


<template>
    <form v-if="selectedKey" ref="documentCreateForm" @submit.prevent="createDocument()">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-5">
                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-4">
                        <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                        <select name="template" v-model="selectedKey"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option v-for="item in templates" :value="item.key">{{ item.name }}</option>
                        </select>

                    </div>

                    <div v-for="field in selectedFields" class="col-span-full">

                        <InputLabel :for="field.name" :value="field.label"/>

                        <div class="mt-2">

                            <div v-if="field.type !== 'select'">

                                <TextInput v-if="field.type === 'input'"
                                           :name="field.name"
                                           :placeholder="field.placeholder"
                                           type="text"
                                           class="mt-1 block w-full"
                                           :required="!field.optional"
                                />

                                <textarea v-else-if="field.type === 'textarea'"
                                          :name="field.name"
                                          :placeholder="field.placeholder"
                                          rows="3"
                                          :required="!field.optional"
                                          class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6"/>
                            </div>

                            <select v-else-if="field.type === 'select'"
                                    :name="field.name"
                                    :required="!field.optional"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">

                                <option v-for="option in field.options"
                                        :value="option.value">{{ option.label }}
                                </option>
                            </select>
                        </div>

                    </div>

                    <div v-if="selectedTemplate && selectedTemplate.tones" class="sm:col-span-3">

                        <label for="tone" class="block text-sm font-medium leading-6 text-gray-900">Tone</label>
                        <div class="mt-2">
                            <select id="tone" name="tone"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option
                                    v-for="(key, value) in data.tones"
                                    :key="key"
                                    :value="value">
                                    {{ key }}
                                </option>
                            </select>
                        </div>
                    </div>


                    <div class="sm:col-span-3">
                        <label for="variations"
                               class="block text-sm font-medium leading-6 text-gray-900">Variations</label>
                        <div class="mt-2">
                            <select id="variations" name="variations"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option
                                    v-for="key in data.variations"
                                    :key="key"
                                    :value="key">
                                    {{ key }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="creativity"
                               class="block text-sm font-medium leading-6 text-gray-900">Creativity</label>

                        <div class="mt-2">
                            <select name="creativity"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">

                                <option
                                    v-for="(value, key) in data.creativity_levels"
                                    :key="key"
                                    :value="value">
                                    {{ key }}
                                </option>
                            </select>

                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="language" class="block text-sm font-medium leading-6 text-gray-900">Language</label>
                        <div class="mt-2">
                            <select id="language" name="language"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option
                                    v-for="(key, value) in data.languages"
                                    :key="key"
                                    :value="key">
                                    {{ key }}
                                </option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

        </div>


        <div class="mt-4 mb-4 flex items-center gap-x-6">
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Generate
            </PrimaryButton>
        </div>
    </form>
</template>
