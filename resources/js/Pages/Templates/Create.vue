<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import {VueDraggableNext} from 'vue-draggable-next';
import Fields from "@/Pages/Templates/Partials/Fields.vue";

import FormSection from '@/Components/Jetstream/FormSection.vue';
import {useToast} from "vue-toastification";


export default {
    components: {
        Fields,
        AppLayout,
        VueDraggableNext,
        FormSection,
    },
    data() {
        return {
            template: {
                name: '',
                fields: [],
            },
        };
    },
    methods: {
        toast: useToast(),

        async submit() {
            try {
                const response = await axios.post(route('templates.store', this.template.id), {
                    name: this.template.name,
                    fields: this.template.fields,
                });

                this.toast.success("Template was created successfully.");
                // Handle success, e.g., show a success message or redirect to another page
            } catch (error) {
                this.toast.error("Template creation failed.");
                console.log(error)
            }
        },
    },
}

</script>

<template>
    <AppLayout title="Templates">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Template
            </h2>
        </template>

        <FormSection @submit.prevent="submit">

            <template #title>
                Template Information
            </template>

            <template #description>
                Update the template information
            </template>

            <template #form>
                <Fields :template="template"/>
            </template>
        </FormSection>

    </AppLayout>
</template>
