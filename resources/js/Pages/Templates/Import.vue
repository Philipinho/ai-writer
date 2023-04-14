<template>
    <AppLayout title="Templates">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Import CSV
            </h2>
        </template>


        <FormSection @submit.prevent="submitForm">

            <template #title>
                Import Templates
            </template>

            <template #description>
                Import templates from a CSV file
            </template>

            <template #form>

                <div class="col-span-full">

                    <InputLabel for="file" value="Upload CSV or JSON"/>

                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">

                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label for="file"
                                       class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    <input
                                        type="file"
                                        id="file"
                                        name="file"
                                        ref="fileInput"
                                        required
                                    >

                                </label>
                            </div>
                            <p class="text-xs leading-5 text-gray-600 hidden">CSV, JSON</p>
                        </div>
                    </div>
                </div>

            </template>

            <template #actions>
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Upload
                </PrimaryButton>
            </template>

        </FormSection>

    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import FormSection from '@/Components/Jetstream/FormSection.vue';
import InputLabel from '@/Components/Jetstream/InputLabel.vue';
import PrimaryButton from '@/Components/Jetstream/PrimaryButton.vue';
import {useForm} from '@inertiajs/vue3';
import {useToast} from "vue-toastification";

export default {
    components: {
        AppLayout,
        FormSection,
        InputLabel,
        PrimaryButton,
        useForm

    },
    data() {
        return {
            fileInput: null,
            form: {
                name: ''
            },
            toast: useToast(),
        };
    },
    methods: {
        async submitForm() {
            this.form.processing = true;
            const formData = new FormData();
            formData.append('file', this.$refs.fileInput.files[0]);

            axios.post(route('templates.import.upload'), formData)
                .then((response) => {
                    this.$refs.fileInput.value = null;
                    this.form.processing = false;
                    this.toast.success("Import was successfully")
                })
                .catch((error) => {
                    this.form.processing = false;
                    this.toast.error("There was an error importing the templates.")
                });

        },
    },
};
</script>
