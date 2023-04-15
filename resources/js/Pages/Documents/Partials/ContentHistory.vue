<script>
import TextInput from '@/Components/Jetstream/TextInput.vue';
import ButtonIcon from '@/Components/Jetstream/ButtonIcon.vue'
import {Link} from '@inertiajs/vue3';
import {Menu, MenuButton, MenuItem, MenuItems, Popover, PopoverButton, PopoverPanel} from '@headlessui/vue'
import {
    ChatBubbleLeftEllipsisIcon,
    CodeBracketIcon,
    EllipsisVerticalIcon,
    EyeIcon,
    FlagIcon,
    HandThumbUpIcon,
    MagnifyingGlassIcon,
    PlusIcon,
    ShareIcon,
    StarIcon,
} from '@heroicons/vue/20/solid'
import {
    ArrowTrendingUpIcon,
    Bars3Icon,
    BellIcon,
    FireIcon,
    HomeIcon,
    UserGroupIcon,
    XMarkIcon,
    ClipboardDocumentIcon
} from '@heroicons/vue/24/outline'
import moment from "moment";
import {useToast} from "vue-toastification";

export default {
    components: {
        TextInput,
        ButtonIcon,
        Link,
        ArrowTrendingUpIcon,
        Bars3Icon,
        BellIcon,
        FireIcon,
        HomeIcon,
        UserGroupIcon,
        XMarkIcon, Menu, MenuButton, MenuItem, MenuItems, Popover, PopoverButton, PopoverPanel,
        ChatBubbleLeftEllipsisIcon,
        CodeBracketIcon,
        EllipsisVerticalIcon,
        EyeIcon,
        FlagIcon,
        HandThumbUpIcon,
        MagnifyingGlassIcon,
        PlusIcon,
        ShareIcon,
        StarIcon,
        ClipboardDocumentIcon,

    },
    props: {
        contents: Object,
    },
    data() {
        return {
            search: '',
            moment: moment,
            toast: useToast(),
            divRefs: [],
        }
    },
    methods: {
        async copyToClipboard(index) {
            try {
                const contentToCopy = this.divRefs[index].innerText;
                await navigator.clipboard.writeText(contentToCopy);
                this.toast.success("Content copied to clipboard!");
            } catch (error) {
                console.error("Failed to copy text: ", error);
                this.toast.error("Failed to copy text to clipboard.");
            }
        },
    },
    computed: {
        filteredContents() {
            return this.contents.filter(
                content => {
                    return content.name.toLowerCase().includes(this.search.toLowerCase());
                }
            )
        }
    }

}

</script>

<template>
    <!--
        <div class="pb-2 mt-4">
            <div class="relative flex items-center">
                <div
                    class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400 pl-3 flex items-center justify-center"
                    style="font-size: 24px" aria-hidden="true">
                    <i class="ri-search-line"></i>
                </div>

                <TextInput
                    v-model="search"
                    name="search"
                    type="search"
                    class="mt-1 block w-full pl-8"
                    placeholder="Search.."
                />
            </div>
        </div>
        -->


    <div class="mt-4">
        <ul role="list" class="space-y-4">
            <li v-for="(documentContent, index) in contents"
                :key="index"
                class="bg-white px-4 py-6 shadow sm:rounded-lg sm:p-6">

                <article :aria-labelledby="'documentContent-title-' + documentContent.uuid">

                    <div>
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0">

                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-base font-medium text-gray-900">
                                    Document: <a :href="route('documents.edit', [documentContent.document.uuid])"
                                                 class="underline">
                                    {{ documentContent.document.name }}
                                </a>
                                </p>
                                <p class="text-sm text-gray-600 font-bold">
                                    <!--<a href="" class="hover:underline">-->
                                    <time datetime>
                                        {{ this.moment(documentContent.updated_at).format('MMM D, YYYY') }}
                                    </time>
                                    | {{ documentContent.word_count }} words | T: {{ documentContent.template.name }}
                                    <!--</a>-->
                                </p>
                            </div>

                            <div class="flex flex-shrink-0 self-center hidden">

                                <Menu as="div" class="relative inline-block text-left">
                                    <div>
                                        <MenuButton
                                            class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600">
                                            <span class="sr-only">Open options</span>
                                            <EllipsisVerticalIcon class="h-5 w-5" aria-hidden="true"/>
                                        </MenuButton>
                                    </div>

                                    <transition enter-active-class="transition ease-out duration-100"
                                                enter-from-class="transform opacity-0 scale-95"
                                                enter-to-class="transform opacity-100 scale-100"
                                                leave-active-class="transition ease-in duration-75"
                                                leave-from-class="transform opacity-100 scale-100"
                                                leave-to-class="transform opacity-0 scale-95">
                                        <MenuItems
                                            class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                            <div class="py-1">
                                                <MenuItem v-slot="{ active }">
                                                    <a href="#"
                                                       :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'flex px-4 py-2 text-sm']">
                                                        <StarIcon class="mr-3 h-5 w-5 text-gray-400"
                                                                  aria-hidden="true"/>
                                                        <span>Add to favorites</span>
                                                    </a>
                                                </MenuItem>
                                                <MenuItem v-slot="{ active }">
                                                    <a href="#"
                                                       :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'flex px-4 py-2 text-sm']">
                                                        <CodeBracketIcon class="mr-3 h-5 w-5 text-gray-400"
                                                                         aria-hidden="true"/>
                                                        <span>Embed</span>
                                                    </a>
                                                </MenuItem>
                                                <MenuItem v-slot="{ active }">
                                                    <a href="#"
                                                       :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'flex px-4 py-2 text-sm']">
                                                        <FlagIcon class="mr-3 h-5 w-5 text-gray-400"
                                                                  aria-hidden="true"/>
                                                        <span>Report content</span>
                                                    </a>
                                                </MenuItem>
                                            </div>
                                        </MenuItems>
                                    </transition>
                                </Menu>
                            </div>
                        </div>

                    </div>

                    <div :ref="el => { if (el) divRefs[index] = el; }"
                         class="mt-2 space-y-4 text-base font-medium text-gray-900"
                         v-html="documentContent.content"/>


                    <div class="mt-6 flex justify-between space-x-8">
                        <!--
                       <div class="flex space-x-6">

                     <span class="inline-flex items-center text-sm">
                       <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                         <HandThumbUpIcon class="h-5 w-5" aria-hidden="true"/>
                         <span class="font-medium text-gray-900">{{ documentContent.likes }}</span>
                         <span class="sr-only">likes</span>
                       </button>
                     </span>
                           <span class="inline-flex items-center text-sm">
                       <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                         <ChatBubbleLeftEllipsisIcon class="h-5 w-5" aria-hidden="true"/>
                         <span class="font-medium text-gray-900">{{ documentContent.replies }}</span>
                         <span class="sr-only">replies</span>
                       </button>
                     </span>

                           <span class="inline-flex items-center text-sm">
                               <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                                   <EyeIcon class="h-5 w-5" aria-hidden="true"/>
                                   <span class="font-medium text-gray-900">{{ documentContent.views }}</span>
                                   <span class="sr-only">views</span>
                               </button>
                           </span>
                       </div>
                       -->

                        <div class="flex text-sm">
                           <span class="inline-flex items-center text-sm">

                               <button @click="copyToClipboard(index)" type="button"
                                       class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                                   <ClipboardDocumentIcon class="h-5 w-5" aria-hidden="true"/>
                                   <span class="font-bold text-gray-900">Copy</span>
                               </button>
                           </span>
                        </div>
                    </div>
                </article>
            </li>
        </ul>
    </div>


</template>
