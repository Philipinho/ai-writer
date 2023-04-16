<script>
import {Link} from "@inertiajs/vue3";

export default {
    components:{
        Link
    },
    props: {
        templates: Object,
    }
}

</script>


<template>
    <div class="overflow-hidden rounded-lg  sm:grid sm:grid-cols-3 2xl:grid-cols-4 sm:gap-px sm:divide-y-0">

        <div v-for="(template, templateIdx) in templates" :key="template.name"
             :class="[templateIdx === 0 ? 'rounded-tl-lg rounded-tr-lg sm:rounded-tr-none' : '', templateIdx === 1 ? 'sm:rounded-tr-lg' : '', templateIdx === templates.length - 2 ? 'sm:rounded-bl-lg' : '', templateIdx === templates.length - 1 ? 'rounded-bl-lg rounded-br-lg sm:rounded-bl-none' : '',
              'group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 m-2']">
            <div>
        <span
            :class="[template.iconBackground, template.iconForeground, 'text-indigo-700 bg-indigo-50 inline-flex rounded-lg p-3 ring-4 ring-white']">

            <div class="h-6 w-6 flex items-center justify-center" aria-hidden="true">
                <i v-if="template.icon" :class="template.icon" style="font-size: 24px"></i>
                <i v-else class="ri-quill-pen-line" style="font-size: 24px"></i>
            </div>
        </span>

            </div>
            <div class="mt-8">
                <h3 class="text-base font-semibold leading-6 text-gray-900">
                    <Link :href="route('documents.create', {'template': template.key})" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"/>
                        {{ template.name }}
                    </Link>
                </h3>
                <p class="mt-2 text-sm text-gray-500">{{ template.description }}</p>
            </div>
            <span class="pointer-events-none absolute right-6 top-6 text-gray-300 group-hover:text-gray-400"
                  aria-hidden="true">
        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path
              d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z"/>
        </svg>
      </span>
        </div>
    </div>
</template>
