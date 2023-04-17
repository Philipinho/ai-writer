<script setup>
import {ref} from 'vue'
import {Head, Link, router, usePage} from '@inertiajs/vue3';
import {
    Dialog, DialogPanel, Menu, MenuButton, MenuItem, MenuItems, TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import {
    Bars3Icon, Cog6ToothIcon, FolderIcon, HomeIcon,
    UsersIcon, XMarkIcon, Square3Stack3DIcon, DocumentTextIcon, ClockIcon
} from '@heroicons/vue/24/outline'
import {ArrowLeftOnRectangleIcon, ChevronUpDownIcon} from '@heroicons/vue/20/solid'
import ApplicationMark from '@/Components/ApplicationMark.vue';
import DarkMode from "@/Layouts/Partials/DarkMode.vue";
import StatsBar from "@/Shared/StatsBar.vue";

defineProps({
    title: String,
});

const logout = () => {
    router.post(route('logout'));
};
const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};
const {props} = usePage()

const navigation = [
    {name: 'Dashboard', href: '/dashboard', icon: HomeIcon},
    {name: 'Documents', href: '/documents', icon: DocumentTextIcon},
    {name: 'Templates', href: '/templates', icon: Square3Stack3DIcon},
    {name: 'History', href: '/history', icon: ClockIcon},
]
const teams = [
    {id: 1, name: 'Billing', href: '/settings/billing', initial: 'B'},
    {id: 2, name: 'Manage Team', href: '/teams/' + props.auth.user.current_team.id, initial: 'T'},
]

const userNavigation = [
    {name: 'Profile', href: route('profile.show')},
]

const sidebarOpen = ref(false)

</script>

<template>

    <div>
        <Head :title="title"/>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog as="div" class="relative z-50 lg:hidden" @close="sidebarOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
                                 enter-from="opacity-0" enter-to="opacity-100"
                                 leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
                                 leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-900/80"/>
                </TransitionChild>

                <div class="fixed inset-0 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                                     enter-from="-translate-x-full" enter-to="translate-x-0"
                                     leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                                     leave-to="-translate-x-full">
                        <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
                            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0"
                                             enter-to="opacity-100" leave="ease-in-out duration-300"
                                             leave-from="opacity-100" leave-to="opacity-0">
                                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                                    <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                                        <span class="sr-only">Close sidebar</span>
                                        <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true"/>
                                    </button>
                                </div>
                            </TransitionChild>
                            <!-- Sidebar component, swap this element with another sidebar if you like -->
                            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4">
                                <div class="flex h-16 shrink-0 items-center">
                                    <ApplicationMark class="block h-9 w-auto"/>
                                </div>
                                <nav class="flex flex-1 flex-col">
                                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                        <li>
                                            <ul role="list" class="-mx-2 space-y-1">
                                                <li v-for="item in navigation" :key="item.name">
                                                    <Link :href="item.href"
                                                          :class="[$page.url === item.href? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                                                        <component :is="item.icon"
                                                                   :class="[$page.url === item.href ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600', 'h-6 w-6 shrink-0']"
                                                                   aria-hidden="true"/>
                                                        {{ item.name }}
                                                    </Link>
                                                </li>
                                            </ul>
                                        </li>

                                        <li>
                                            <div class="text-xs font-semibold leading-6 text-gray-400">Workspace</div>
                                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                                <li v-for="team in teams" :key="team.name">
                                                    <Link :href="team.href"
                                                          :class="[$page.url === team.href ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                                                        <span
                                                            :class="[$page.url === team.href ? 'text-indigo-600 border-indigo-600' : 'text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600', 'flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white']">
                                                            {{ team.initial }}</span>
                                                        <span class="truncate">{{ team.name }}</span>
                                                    </Link>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="hidden">
                                            <DarkMode/>
                                        </li>

                                        <li>
                                            <div class="mb-2 text-sm font-semibold">Credits Usage</div>
                                            <StatsBar :hideDivs="true"/>
                                        </li>

                                        <li class="mt-auto">
                                            <Link :href="route('profile.show')"
                                                  class="mb-5 group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                <Cog6ToothIcon
                                                    class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600"
                                                    aria-hidden="true"/>
                                                Settings
                                            </Link>

                                            <form method="POST" @submit.prevent="logout">
                                                <button
                                                    class="w-full group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                    <ArrowLeftOnRectangleIcon
                                                        class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" aria-hidden="true"/>
                                                    Logout
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-60 lg:flex-col">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4">
                <div class="flex h-16 shrink-0 items-center">
                    <ApplicationMark class="block h-9 w-auto"/>
                </div>


                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li v-for="item in navigation" :key="item.name">
                                    <Link :href="item.href"
                                          :class="[$page.url === item.href ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">

                                        <component :is="item.icon"
                                                   :class="[$page.url === item.href ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600', 'h-6 w-6 shrink-0']"
                                                   aria-hidden="true"/>
                                        {{ item.name }}
                                    </Link>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <div class="text-xs font-semibold leading-6 text-gray-400">Workspace</div>
                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                <li v-for="team in teams" :key="team.name">
                                    <Link :href="team.href"
                                          :class="[$page.url === team.href ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                                        <span
                                            :class="[$page.url === team.href ? 'text-indigo-600 border-indigo-600' : 'text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600', 'flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white']">
                                            {{ team.initial }}</span>
                                        <span class="truncate">{{ team.name }}</span>
                                    </Link>
                                </li>
                            </ul>
                        </li>


                        <li v-if="$page.props.jetstream.hasTeamFeatures && $page.props.jetstream.canCreateTeams">
                            <!-- User account dropdown -->
                            <Menu as="div" class="relative inline-block px-3 text-left">
                                <div>2
                                    <MenuButton
                                        class="group w-full rounded-md bg-gray-100 px-3.5 py-2 text-left text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-100">

                                        <span class="flex w-full items-center justify-between">
                                            <span class="flex min-w-0 items-center justify-between space-x-3">
                                                <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300"
                                                     src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                                                     alt=""/>

                                                <span class="flex min-w-2 flex-1 flex-col">
                                                    <span class="truncate text-sm font-medium text-gray-900">{{
                                                            $page.props.auth.user.current_team.name
                                                        }}</span>
                                                    <span class="truncate text-sm text-gray-500">Teams</span>
                                                </span>
                                            </span>
                                            <ChevronUpDownIcon
                                                class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                aria-hidden="true"/>
                                        </span>
                                    </MenuButton>
                                </div>

                                <transition enter-active-class="transition ease-out duration-100"
                                            enter-from-class="transform opacity-0 scale-95"
                                            enter-to-class="transform opacity-100 scale-100"
                                            leave-active-class="transition ease-in duration-75"
                                            leave-from-class="transform opacity-100 scale-100"
                                            leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems
                                        class="absolute left-0 right-0 z-10 mx-3 mt-1 origin-top divide-y divide-gray-200 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <div class="py-1">
                                            <MenuItem v-slot="{ active }">
                                                <Link :href="route('teams.show', $page.props.auth.user.current_team)"
                                                      :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                                    Team Settings
                                                </Link>
                                            </MenuItem>

                                            <MenuItem v-slot="{ active }">
                                                <Link v-if="$page.props.jetstream.canCreateTeams"
                                                      :href="route('teams.create')"
                                                      :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                                    Create New Team
                                                </Link>
                                            </MenuItem>
                                        </div>

                                        <div class="py-1">

                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Switch Teams
                                            </div>

                                            <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">

                                                <form @submit.prevent="switchToTeam(team)">

                                                    <MenuItem as="button">

                                                        <div class="flex">

                                                            <div class="text-gray-700 block px-4 py-2 text-sm">
                                                                <i v-if="team.id == $page.props.auth.user.current_team_id"
                                                                   class="ri-checkbox-circle-line text-green-700"
                                                                   style="font-size: 18px;"></i>
                                                                {{ team.name }}
                                                            </div>
                                                        </div>
                                                    </MenuItem>
                                                </form>
                                            </template>

                                            <MenuItem v-slot="{ active }">
                                                <a href="#"
                                                   :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Support</a>
                                            </MenuItem>
                                        </div>
                                        <div class="py-1">
                                            <MenuItem v-slot="{ active }">
                                                <a href="#"
                                                   :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Logout</a>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </li>
                        <li class="hidden">
                            <DarkMode/>
                        </li>
                        <li>
                            <div class="mb-2 text-sm font-semibold">Credits Usage</div>
                            <StatsBar :hideDivs="true"/>
                        </li>


                        <li class="mt-auto">
                            <Link :href="route('profile.show')"
                                  class="mb-5 group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                <Cog6ToothIcon class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600"
                                               aria-hidden="true"/>
                                Settings
                            </Link>

                            <form method="POST" @submit.prevent="logout">
                                <button
                                    class="w-full group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                    <ArrowLeftOnRectangleIcon
                                        class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600"
                                        aria-hidden="true"/>
                                    Logout
                                </button>
                            </form>

                        </li>
                    </ul>
                </nav>


            </div>
        </div>

        <div class="lg:pl-60">

            <div class="">
                <div class="lg:mx-auto lg:max-w-7xl lg:px-8">
                    <div class="flex">

                        <button type="button" class=" p-3.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
                            <span class="sr-only">Open sidebar</span>
                            <Bars3Icon class="h-6 w-6" aria-hidden="true"/>
                        </button>

                        <!--
                        <div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true"/>

                        <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                            <div class="relative flex flex-1">
                            </div>

                            <div class="flex items-center gap-x-4 lg:gap-x-6">
                                <DarkMode/>

                                <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">View notifications</span>
                                    <BellIcon class="h-6 w-6" aria-hidden="true"/>
                                </button>

                                <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true"/>

                                <Menu as="div" class="relative">
                                    <MenuButton class="-m-1.5 flex items-center p-1.5">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full bg-gray-50"
                                             src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                             alt=""/>
                                        <span class="hidden lg:flex lg:items-center">
                    <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">Tom Cook</span>
                    <ChevronDownIcon class="ml-2 h-5 w-5 text-gray-400" aria-hidden="true"/>
                  </span>
                                    </MenuButton>
                                    <transition enter-active-class="transition ease-out duration-100"
                                                enter-from-class="transform opacity-0 scale-95"
                                                enter-to-class="transform opacity-100 scale-100"
                                                leave-active-class="transition ease-in duration-75"
                                                leave-from-class="transform opacity-100 scale-100"
                                                leave-to-class="transform opacity-0 scale-95">
                                        <MenuItems
                                            class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                                            <MenuItem v-for="item in userNavigation" :key="item.name"
                                                      v-slot="{ active }">
                                                <Link :href="item.href"
                                                      :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900']">
                                                    {{ item.name }}
                                                </Link>
                                            </MenuItem>

                                            <form method="POST" @submit.prevent="logout">
                                                <MenuItem as="button">
                                                    <div
                                                        :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900']">
                                                        Logout
                                                    </div>
                                                </MenuItem>
                                            </form>
                                        </MenuItems>
                                    </transition>
                                </Menu>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>


            <!-- Page Heading -->
            <header v-if="$slots.header" class="py-10">
                <div class="max-w-5xl 2xl:max-w-6xl mx-auto px-6 lg:px-8">
                    <slot name="header"/>
                </div>
            </header>

            <main class="py-2">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <slot/>
                </div>
            </main>
        </div>
    </div>
</template>
