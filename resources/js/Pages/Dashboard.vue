<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import Stats from '@/Components/Custom/Stats.vue';
import ButtonIcon from '@/Components/ButtonIcon.vue';

</script>

<template>
    <AppLayout title="Dashboard">
        <!--
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>
        -->

        <div class="py-6">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <Link :href="route('documents.create')">
                    <ButtonIcon>Create Document</ButtonIcon>
                </Link>

                    <Stats />
            </div>
        </div>
    </AppLayout>
</template>
