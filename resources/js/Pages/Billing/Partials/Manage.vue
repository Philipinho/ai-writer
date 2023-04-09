<script>
import TextRightButton from '@/Components/TextRightButton.vue';

export default {
    components: {
        TextRightButton
    },
    props: {

    },
    methods: {
        stripePortal(){
            window.location.href = route('billing.portal')
        }
    },
}

</script>

<template>
    <div class="mx-auto max-w-2xl px-6 lg:px-8 pt-10">

        <TextRightButton>
            <template #title>Manage Subscription</template>
            <template #description>
                This page allows you to easily modify your subscription plan, invoices, update payment details, and keep track of your billing history.
            </template>

            <div @click="stripePortal">Manage</div>
        </TextRightButton>

    </div>


</template>
