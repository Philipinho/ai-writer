<script>
import {reactive, ref} from 'vue';
import {Link, router, useForm} from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
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
        }
    },
    remember: 'form',
    data() {
        return {
            form: {
                name: this.data.values.name,
                errors: [],
            },
        };
    },
    methods: {
        getFormData(form) {
            const formData = {};
            for (const input of form.elements) {
                if (input.tagName === 'BUTTON') continue; // Skip buttons
                formData[input.name] = input.value;
            }
            return formData;
        },

        createDocument() {
            const form = this.$refs.documentCreateForm;
            const formData = this.getFormData(form);
            console.log('Form data:', formData);
            console.log('what?')
            //axios.post(route('document.store')).then(response => {
            //     console.log(response.data)
            // });
        }
    }
};
</script>


<template>
    <form ref="documentCreateForm" id="document_create" @submit.prevent="createDocument()">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-5">
                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-4">
                        <InputLabel for="name" value="Name"/>

                        <TextInput
                            id="name"
                            name="name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="e.g ad copy"
                        />

                    </div>

                    <div class="sm:col-span-3">
                        <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                        <div class="mt-2">
                            <select id="type" name="type"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option>Summarize</option>
                                <option>Explain</option>
                                <option>Blog Title</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="prompt" class="block text-sm font-medium leading-6 text-gray-900">Prompt</label>
                        <div class="mt-2">
                            <textarea id="prompt" name="prompt" rows="3"
                                      class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6"/>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600">Write a few instructions.</p>
                    </div>

                    <div class="sm:col-span-3">
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
