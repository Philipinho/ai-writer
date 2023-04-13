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

        <TextRightButton>
            <template #title>Manage Subscription</template>
            <template #description>
                This page allows you to easily modify your subscription plan, invoices, update payment details, and keep track of your billing history.
            </template>

            <div @click="stripePortal">Manage</div>
        </TextRightButton>

</template>
