<script>
import {VueDraggableNext} from 'vue-draggable-next';
import InputLabel from '@/Components/Jetstream/InputLabel.vue';
import TextInput from '@/Components/Jetstream/TextInput.vue';
import FormSection from '@/Components/Jetstream/FormSection.vue';
import PrimaryButton from '@/Components/Jetstream/PrimaryButton.vue';
import SecondaryButton from '@/Components/Jetstream/SecondaryButton.vue';

export default {
    components: {
        VueDraggableNext,
        InputLabel,
        TextInput,
        FormSection,
        PrimaryButton,
        SecondaryButton
    },
    props: {
        template: Object,
    },

    data() {
        return {};
    },
    methods: {
        updateOrder() {
            this.template.fields.forEach((field, index) => {
                field.order = index + 1;
            });
        },
        addField() {
            this.template.fields.push({
                label: '',
                optional: 1,
                name: '',
                placeholder: '',
                type: 'text',
                maxLength: null,
                order: this.template.fields.length + 1,
            });
        },
        removeField(index) {
            this.template.fields.splice(index, 1);
        }
    },
}

</script>

<template>

    <div class="col-span-6 sm:col-span-4">
        <InputLabel :for="template.name" value="Template Name"/>
        <TextInput
            id="name"
            v-model="template.name"
            type="text"
            class="mt-1 block w-full"
        />
    </div>

    <div class="col-span-6 sm:col-span-4">
        <InputLabel :for="template.key" value="Template Key"/>
        <TextInput
            id="key"
            v-model="template.key"
            type="text"
            class="mt-1 block w-full"
        />
    </div>

    <div class="col-span-6 sm:col-span-4">
        <InputLabel :for="template.prompt" value="Template Prompt"/>
        <TextInput
            id="prompt"
            v-model="template.prompt"
            type="text"
            class="mt-1 block w-full"
        />
    </div>

    <div class="col-span-6 sm:col-span-4">
        <InputLabel :for="template.description" value="Template Description"/>
        <TextInput
            id="description"
            v-model="template.description"
            type="text"
            class="mt-1 block w-full"
        />
    </div>

    <div class="col-span-6 sm:col-span-4">
        <InputLabel :for="template.icon" value="Template Icon"/>
        <TextInput
            id="icon"
            v-model="template.icon"
            type="text"
            class="mt-1 block w-full"
        />
    </div>

    <div class="col-span-6 sm:col-span-4">
        <InputLabel :for="template.color" value="Template Color"/>
        <TextInput
            id="icon"
            v-model="template.color"
            type="text"
            class="mt-1 block w-full"
        />
    </div>

    <div class="col-span-6 sm:col-span-4">
        <InputLabel :for="template.status" value="Template Status"/>
        <TextInput
            id="status"
            v-model="template.status"
            type="text"
            class="mt-1 block w-full"
        />
    </div>

    <!--Fields-->

    <VueDraggableNext v-model="template.fields" @end="updateOrder" class="col-span-6 sm:col-span-4">
        <div
            v-for="(field, index) in template.fields"
            :key="index"
            class="border border-gray-300 p-4 my-2 cursor-move"
        >

            <div class="col-span-6 sm:col-span-4">
                <InputLabel :for="'label-' + index" value="Label"/>
                <TextInput
                    :id="'label-' + index"
                    v-model="field.label"
                    type="text"
                    class="mt-1 block w-full"
                />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel :for="'name-' + index" value="ID"/>
                <TextInput
                    :id="'name-' + index"
                    v-model="field.name"
                    type="text"
                    class="mt-1 block w-full"
                />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel :for="'type-' + index" value="Type"/>

                <div class="mt-2">
                    <select :id="'type-' + index" name="country"
                            v-model="field.type"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option value="text" selected>Text</option>
                        <option value="textarea">Textarea</option>
                        <option value="number">Number</option>
                        <option value="select">Select</option>
                        <option value="checkbox">Checkbox</option>
                    </select>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel :for="'required-' + index" value="Required"/>
                <TextInput
                    :id="'required-' + index"
                    v-model="field.required"
                    type="number"
                    class="mt-1 block w-full"
                />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel :for="'order-' + index" value="Order"/>
                <TextInput
                    :id="'order-' + index"
                    v-model="field.order"
                    type="number"
                    class="mt-1 block w-full"
                />
            </div>

            <div class="mt-2">
                <button @click.prevent="removeField(index)" class="px-4 py-2">
                    <i class="ri-delete-bin-5-line"></i>
                </button>
            </div>
        </div>
    </VueDraggableNext>

    <div class="col-span-6 sm:col-span-4">
        <SecondaryButton @click.prevent="addField">
            Add Field
        </SecondaryButton>
    </div>


    <div class="col-span-6 sm:col-span-4">
        <PrimaryButton type="submit">
            Save
        </PrimaryButton>
    </div>

</template>
