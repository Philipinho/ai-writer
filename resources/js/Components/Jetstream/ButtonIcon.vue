<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
    icon: {
        type: String,
        default: 'ri-add-line'
    }
});
</script>

<template>
    <button :type="type" class="inline-flex items-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        <i :class="icon"></i>
        <slot />
    </button>
</template>
