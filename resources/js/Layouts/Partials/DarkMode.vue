<template>
    <!-- Desktop lights switch -->
    <div class="form-switch flex flex-col justify-center ml-3">
        <input type="checkbox" name="light-switch" id="light-switch-desktop" v-model="darkMode"
               class="light-switch sr-only"/>
        <label class="relative" for="light-switch-desktop">
            <span
                class="relative bg-gradient-to-t from-gray-100 to-white dark:from-gray-800 dark:to-gray-700 shadow-sm z-10"
                aria-hidden="true"></span>
            <svg class="absolute inset-0" width="44" height="24" viewBox="0 0 44 24" xmlns="http://www.w3.org/2000/svg">
                <g class="fill-current text-white" fill-rule="nonzero" opacity=".88">
                    <path
                        d="M32 8a.5.5 0 00.5-.5v-1a.5.5 0 10-1 0v1a.5.5 0 00.5.5zM35.182 9.318a.5.5 0 00.354-.147l.707-.707a.5.5 0 00-.707-.707l-.707.707a.5.5 0 00.353.854zM37.5 11.5h-1a.5.5 0 100 1h1a.5.5 0 100-1zM35.536 14.829a.5.5 0 00-.707.707l.707.707a.5.5 0 00.707-.707l-.707-.707zM32 16a.5.5 0 00-.5.5v1a.5.5 0 101 0v-1a.5.5 0 00-.5-.5zM28.464 14.829l-.707.707a.5.5 0 00.707.707l.707-.707a.5.5 0 00-.707-.707zM28 12a.5.5 0 00-.5-.5h-1a.5.5 0 100 1h1a.5.5 0 00.5-.5zM28.464 9.171a.5.5 0 00.707-.707l-.707-.707a.5.5 0 00-.707.707l.707.707z"/>
                    <circle cx="32" cy="12" r="3"/>
                    <circle fill-opacity=".4" cx="12" cy="12" r="6"/>
                    <circle fill-opacity=".88" cx="12" cy="12" r="3"/>
                </g>
            </svg>
            <span class="sr-only">Switch to light / dark version</span>
        </label>
    </div>
</template>


<script>
const DarkMode = {
    name: 'DarkMode',
    data: function () {
        return {
            darkMode: this.handleLights()
        }
    },
    methods: {
        handleLights: function () {
            const dark = localStorage.getItem('dark-mode')
            if (dark === null) {
                return true
            } else {
                return dark === 'true'
            }
        }
    },
    watch: {
        darkMode() {
            localStorage.setItem('dark-mode', this.darkMode)
            if (this.darkMode) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
        }
    }
};

export default DarkMode;
</script>

<style scoped>
/* Light switch */
.form-switch input[type="checkbox"].light-switch + label {
    @apply bg-teal-500;
}

.dark .form-switch input[type="checkbox"].light-switch + label > span:first-child {
    left: 22px;
}

.dark .h4 {
    @apply font-bold;
}

.dark .form-input,
.dark .form-textarea,
.dark .form-multiselect,
.dark .form-select,
.dark .form-checkbox,
.dark .form-radio {
    @apply bg-gray-800 border border-gray-600 focus:border-gray-500;
}

.dark .form-input,
.dark .form-textarea {
    @apply placeholder-gray-400;
}
/* Switch element */
.form-switch {
    @apply relative select-none;
    width: 44px;
}

.form-switch label {
    @apply block overflow-hidden cursor-pointer h-6 rounded-full;
}

.form-switch label > span:first-child {
    @apply absolute block rounded-full;
    width: 20px;
    height: 20px;
    top: 2px;
    left: 2px;
    right: 50%;
    transition: all .15s ease-out;
}

.form-switch input[type="checkbox"]:checked + label {
    @apply bg-teal-500;
}

.form-switch input[type="checkbox"]:checked + label > span:first-child {
    left: 22px;
}

</style>
