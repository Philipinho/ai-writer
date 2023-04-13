<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import {VueDraggableNext} from 'vue-draggable-next';
import FormSection from '@/Components/FormSection.vue';
import Fields from "@/Pages/Templates/Partials/Fields.vue";

export default {
    components: {
        AppLayout,
        VueDraggableNext,
        FormSection,
        Fields
    },
    props: {
        template: Object,
    },

    data() {
        return {};
    },
    methods: {
        async submit() {
            try {
                const response = await axios.put(route('templates.update', this.template.id), {
                    name: this.template.name,
                    fields: this.template.fields,
                });
                console.log('saving response')
                console.log(response)
                // Handle success
            } catch (error) {
                console.log(error)
                // Handle error, e.g., show an error message
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
