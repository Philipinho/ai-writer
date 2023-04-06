<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import TemplateList from '@/Pages/Templates/Partials/TemplateList.vue'
import { VueDraggableNext } from 'vue-draggable-next';
import Fields from "@/Pages/Templates/Partials/Fields.vue";
import FormSection from '@/Components/FormSection.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

export default {
    components: {
        AppLayout,
        TemplateList,
        VueDraggableNext,
        Fields,
        FormSection,
        PrimaryButton
    },
    props: {
        templates: Object,
    },

    data() {
        return {
        };
    },
    computed: {
        myTemplates: {
            get() {
                return this.templates;
            },
            set(value) {
                this.$emit('update:templates', value);
            },
        },
    }
    ,
    methods: {
        updateTemplateOrder(){
            this.templates.forEach((template, index) => {
                template.order = index + 1;
            });
        },
        updateFieldOrder() {
            this.template.fields.forEach((field, index) => {
                field.order = index + 1;
            });
        },
        addField(template) {
            template.fields.push({
                label: '',
                optional: false,
                name: '',
                placeholder: '',
                type: '',
                maxLength: null,
                order: template.fields.length + 1,
            });
        },
        removeField(index) {
            this.template.fields.splice(index, 1);
        },
        async submit() {
            try {
                const response = await axios.put('/templates/mass-update', {
                    templates: this.templates,
                });

                console.log('saving response')
                console.log(response)

                // Handle success, e.g., show a success message or redirect to another page
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
                Edit Templates
            </h2>
        </template>


                <FormSection @submit.prevent="submit">

                    <template #form>

                    <VueDraggableNext v-model="myTemplates" @end="updateTemplateOrder" class="col-span-6 sm:col-span-4">

                        <div v-for="(template, index) in myTemplates" :key="index" class="border border-gray-300 p-4 my-2 mb-10">

                            <Fields :template="template " />

                        </div>
                    </VueDraggableNext>

                        <div class="col-span-6 sm:col-span-4">
                            <PrimaryButton type="submit">
                                Save All
                            </PrimaryButton>
                        </div>

                    </template>
                </FormSection>

    </AppLayout>
</template>
