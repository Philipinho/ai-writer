<script>
import {reactive, ref} from 'vue';
import {useForm} from '@inertiajs/vue3';
import InputLabel from '@/Components/Jetstream/InputLabel.vue';
import PrimaryButton from '@/Components/Jetstream/PrimaryButton.vue';
import TextInput from '@/Components/Jetstream/TextInput.vue';
import vSelect from 'vue-select';
import { useToast } from "vue-toastification";

export default {
    components: {
        reactive,
        ref,
        useForm,
        InputLabel,
        PrimaryButton,
        TextInput,
        vSelect
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
            toast: useToast(),
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
                const template = this.templates[this.selectedTemplateIndex];
                this.$emit('selectedTemplate', template);
                return template;
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
                if (inputElement.tagName === 'BUTTON') continue;
                if (inputElement.name === '') continue;
                // If the input element's name is in selectedFieldNames, add it to the 'inputLabels' node
                if (selectedFieldNames.has(inputElement.name)) {
                    formData.inputLabels[inputElement.name] = inputElement.value;
                } else {
                    formData[inputElement.name] = inputElement.value;
                }
            }

            formData['template'] = this.selectedKey;

            return formData;
        },

        generateContent() {
            this.form.processing = true;
            const form = this.$refs.documentCreateForm;
            const formData = this.getFormData(form);

            axios.post(route('documents.generate', [this.data.values.uuid]), formData)
                .then(response => {
                    this.$emit('contentReceived', response.data.data.content)
                    this.form.processing = false;
                }).catch(error => {

                if (error.response.status === 429){
                    this.toast.error(error.response.data.message)
                } else {
                    this.toast.error('Oops. Something went wrong. Try again or contact support')
                }

                this.form.processing = false;
            });
        }
    }
};
</script>


<template>
    <form v-if="selectedKey" ref="documentCreateForm" @submit.prevent="generateContent()">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-5">
                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">

                    <div class="sm:col-span-6">
                        <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Template</label>

                        <v-select name="template"
                                  v-model="selectedKey"
                                  :options="templates"
                                  :reduce="(item) => item.key"
                                  :clearable="false"
                                  label="name"
                                  class="block w-full rounded-md  py-1.5 text-gray-900 shadow-sm sm:max-w-xs sm:text-sm sm:leading-6">
                        </v-select>


                    </div>

                    <div v-for="field in selectedFields" class="col-span-full">

                        <InputLabel :for="field.name" :value="field.label"/>

                        <div class="mt-2">

                            <div v-if="field.type !== 'select'">

                                <TextInput v-if="field.type === 'text'"
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



        <div class="flex mt-4 mb-4 items-center gap-x-6 flex justify-between">


            <div class="sm:col-span-3 flex items-center">
                <label for="variations"
                       class="block text-sm font-medium leading-6 text-gray-900 flex-nowrap mr-2">Outputs</label>
                <div>
                    <select id="variations" name="variations"
                            class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option
                            v-for="key in data.variations"
                            :key="key"
                            :value="key">
                            {{ key }}
                        </option>
                    </select>
                </div>
            </div>

            <PrimaryButton :class="{ 'opacity-15': form.processing }" :disabled="form.processing">
                <i v-if="form.processing" style="font-size: 20px;" class="mr-1 animate-spin ri-loader-4-line"></i>  Generate
            </PrimaryButton>
        </div>
    </form>
</template>


<style>
.vs--single .vs__selected {
    background-color: transparent;
    border-color: transparent;
    font-size: 16px;
}

.vs__search, .vs__search:focus {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    line-height: var(--vs-line-height);
    font-size: var(--vs-font-size);
    border: 1px solid transparent;
    border-left: none;
    outline: none;
    margin: 4px 0 0;
    padding: 0 7px;
    background: none;
    box-shadow: none;
    width: 0;
    max-width: 100%;
    flex-grow: 1;
    z-index: 1;
}

.v-menu__content {
    border-radius: 10px !important;
    background: black;
}

.vs__dropdown-menu {
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    font-size: 16px;
}

</style>

<style scoped>
>>> {
    /*
    --vs-controls-color: #664cc3;
    --vs-border-color: #664cc3;

    --vs-dropdown-bg: #282c34;
    --vs-dropdown-color: #cc99cd;
    --vs-dropdown-option-color: #cc99cd;

    --vs-selected-bg: #664cc3;
    --vs-selected-color: #eeeeee;

    --vs-search-input-color: #eeeeee;
*/
    --vs-dropdown-option--active-bg: rgb(79 70 229);
    --vs-dropdown-option--active-color: #fff;
}
</style>
