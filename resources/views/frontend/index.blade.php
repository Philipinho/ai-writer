<x-appLayout>


    <div class="bg-white">
        <header x-data="{ open: false }" @keydown.window.escape="open = false" class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">CopyPhrase</span>
                        <img class="h-8 w-auto"
                             src="https://tailwindui.com/img/logos/mark.svg?color=indigo&amp;shade=600" alt="">
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button type="button"
                            class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                            @click="open = true">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden lg:flex lg:gap-x-12">

                    <a href="/#features" class="text-sm font-semibold leading-6 text-gray-900">Features</a>

                    <a href="/#pricing" class="text-sm font-semibold leading-6 text-gray-900">Pricing</a>

                    <a href="/#faq" class="text-sm font-semibold leading-6 text-gray-900">FAQ</a>

                    <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Company</a>

                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900">Log in <span
                            aria-hidden="true">→</span></a>
                </div>
            </nav>
            <div x-description="Mobile menu, show/hide based on menu open state." class="lg:hidden" x-ref="dialog"
                 x-show="open" aria-modal="true" style="display: none;">
                <div x-description="Background backdrop, show/hide based on slide-over state."
                     class="fixed inset-0 z-50"></div>
                <div
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
                    @click.away="open = false">
                    <div class="flex items-center justify-between">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">CopyPhrase</span>
                            <img class="h-8 w-auto"
                                 src="https://tailwindui.com/img/logos/mark.svg?color=indigo&amp;shade=600" alt="">
                        </a>
                        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="open = false">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">

                                <a href="/#features"
                                   class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Features</a>

                                <a href="/#pricing"
                                   class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Pricing</a>

                                <a href="/#faq"
                                   class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">FAQ</a>

                                <a href="#"
                                   class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Company</a>

                            </div>
                            <div class="py-6">
                                <a href="{{ route('login') }}"
                                   class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log
                                    in</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="relative isolate pt-14">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                 aria-hidden="true">
                <div
                    class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>
            <div class="py-24 sm:py-32 lg:pb-40">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">AI-Powered Content
                            Writer: Just Click, Write, and Wow!</h1>
                        <p class="mt-6 text-lg leading-8 text-gray-600">Supercharge your writing process with the best
                            AI writing tool that enhances your work and sets your content apart.</p>
                        <div class="mt-10 flex items-center justify-center gap-x-6">
                            <a href="{{ route('register') }}"
                               class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Get started</a>
                            <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Learn more <span
                                    aria-hidden="true">→</span></a>
                        </div>
                    </div>
                    <div class="mt-16 flow-root sm:mt-24">
                        <div
                            class="-m-2 rounded-xl bg-gray-900/5 p-2 ring-1 ring-inset ring-gray-900/10 lg:-m-4 lg:rounded-2xl lg:p-4">
                            <img src="https://tailwindui.com/img/component-images/project-app-screenshot.png"
                                 alt="App screenshot" width="2432" height="1442"
                                 class="rounded-md shadow-2xl ring-1 ring-gray-900/10">
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div
                    class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>
        </div>
    </div>



    <div class="max-w-6xl px-8 mx-auto lg:px-20 py-8">
        <h2 class="mb-2 text-2xl font-bold text-center text-gray-700 md:text-3xl lg:text-4xl">
            How it works
        </h2>
    </div>

    <div class="lg:border-b lg:border-t lg:border-gray-200">
        <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" aria-label="Progress">
            <ol role="list"
                class="overflow-hidden rounded-md lg:flex lg:rounded-none lg:border-l lg:border-r lg:border-gray-200">
                <li class="relative overflow-hidden lg:flex-1">
                    <div class="overflow-hidden border border-gray-200 rounded-t-md border-b-0 lg:border-0">
                        <!-- Completed Step -->
                        <a href="#" class="group">
                            <span
                                class="absolute left-0 top-0 h-full w-1 bg-transparent group-hover:bg-gray-200 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full"
                                aria-hidden="true"></span>
                            <span class="flex items-start px-6 py-5 text-sm font-medium">
              <span class="flex-shrink-0">
                  <span class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gray-300">
                  <span class="text-gray-500">01</span>
                </span>
              </span>
              <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                <span class="text-sm font-medium">Select Template</span>
                <span class="text-sm font-medium text-gray-500">Select a Template and provide a topic, keywords, or context to guide the AI writing assistant in generating relevant content tailored to your needs.</span>
              </span>
            </span>
                        </a>
                    </div>
                </li>

                <li class="relative overflow-hidden lg:flex-1">
                    <div class="overflow-hidden border border-gray-200 lg:border-0">
                        <!-- Current Step -->
                        <a href="#" aria-current="step">
                            <span
                                class="absolute left-0 top-0 h-full w-1 bg-indigo-600 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full"
                                aria-hidden="true"></span>
                            <span class="flex items-start px-6 py-5 text-sm font-medium lg:pl-9">
              <span class="flex-shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-indigo-600">
                  <span class="text-indigo-600">02</span>
                </span>
              </span>
              <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                <span class="text-sm font-medium text-indigo-600">Generate Content</span>
                <span class="text-sm font-medium text-gray-500">Watch as the AI-powered tool processes your input and creates engaging, high-quality text in a matter of seconds.</span>
              </span>
            </span>
                        </a>

                        <!-- Separator -->
                        <div class="absolute inset-0 left-0 top-0 hidden w-3 lg:block" aria-hidden="true">
                            <svg class="h-full w-full text-gray-300" viewBox="0 0 12 82" fill="none"
                                 preserveAspectRatio="none">
                                <path d="M0.5 0V31L10.5 41L0.5 51V82" stroke="currentcolor"
                                      vector-effect="non-scaling-stroke"/>
                            </svg>
                        </div>
                    </div>
                </li>

                <li class="relative overflow-hidden lg:flex-1">
                    <div class="overflow-hidden border border-gray-200 rounded-b-md border-t-0 lg:border-0">
                        <!-- Upcoming Step -->
                        <a href="#" class="group">
                            <span
                                class="absolute left-0 top-0 h-full w-1 bg-transparent group-hover:bg-gray-200 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full"
                                aria-hidden="true"></span>
                            <span class="flex items-start px-6 py-5 text-sm font-medium lg:pl-9">
              <span class="flex-shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600">
                    <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z"
                              clip-rule="evenodd"/></svg>

                </span>
              </span>

              <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                <span class="text-sm font-medium text-gray-500">Edit & Perfect</span>
                <span class="text-sm font-medium text-gray-500">Utilize our built-in rich-text editor to effortlessly refine the AI-created content, making adjustments and enhancements to ensure your final content is both compelling and on-point."</span>
              </span>
            </span>
                        </a>

                        <!-- Separator -->
                        <div class="absolute inset-0 left-0 top-0 hidden w-3 lg:block" aria-hidden="true">
                            <svg class="h-full w-full text-gray-300" viewBox="0 0 12 82" fill="none"
                                 preserveAspectRatio="none">
                                <path d="M0.5 0V31L10.5 41L0.5 51V82" stroke="currentcolor"
                                      vector-effect="non-scaling-stroke"/>
                            </svg>
                        </div>
                    </div>
                </li>
            </ol>
        </nav>
    </div>


    <section id="features" class="bg-gray-100">
        <div class="relative">
            <div class="absolute inset-0 w-screen h-full pb-20 transform opacity-50">
                <img src="https://cdn.devdojo.com/images/march2021/bg-gradient.png"
                     class="absolute left-0 object-cover w-full h-full">
            </div>
            <div
                class="relative px-6 py-8 ml-auto mr-auto bg-top bg-cover sm:py-16 max-w-7xl md:px-24 lg:px-16 lg:py-20">

                <div class="relative grid gap-6 bg-top bg-cover sm:grid-cols-2 lg:grid-cols-4">
                    <div
                        class="flex flex-col items-start justify-between p-6 space-y-4 overflow-hidden transition-shadow duration-200 bg-white bg-top bg-cover border border-gray-100 shadow-xl rounded-2xl group hover:shadow-2xl">
                        <div
                            class="flex items-center justify-center w-10 h-10 text-center bg-top bg-cover rounded-full bg-indigo-50">
                            <p class="relative">
                                <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                </svg>
                            </p>
                        </div>
                        <p class="font-bold text-gray-700">User Manager</p>
                        <p class="text-sm leading-5 text-gray-500">Easily manage the users of your application. Allow
                            access to specific areas and sections.</p>
                    </div>
                    <div
                        class="flex flex-col items-start justify-between p-6 space-y-4 overflow-hidden transition-shadow duration-200 bg-white bg-top bg-cover border border-gray-100 shadow-xl rounded-2xl group hover:shadow-2xl">
                        <div
                            class="flex items-center justify-center w-10 h-10 text-center bg-top bg-cover rounded-full bg-indigo-50">
                            <p class="relative">
                                <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                          clip-rule="evenodd" class=""></path>
                                    <path
                                        d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
                                </svg>
                            </p>
                        </div>
                        <p class="font-bold text-gray-700">Projects</p>
                        <p class="text-sm leading-5 text-gray-500">Unlimted projects for you and your team. Easily
                            create, modify, and duplicate your projects.</p>
                    </div>
                    <div
                        class="flex flex-col items-start justify-between p-6 space-y-4 overflow-hidden transition-shadow duration-200 bg-white bg-top bg-cover border border-gray-100 shadow-xl rounded-2xl group hover:shadow-2xl">
                        <div
                            class="flex items-center justify-center w-10 h-10 text-center bg-top bg-cover rounded-full bg-indigo-50">
                            <p class="relative">
                                <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L7.586 10 5.293 7.707a1 1 0 010-1.414zM11 12a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </p>
                        </div>
                        <p class="font-bold text-gray-700">Developer API</p>
                        <p class="text-sm leading-5 text-gray-500">Well documented developer API that allows you to
                            build on top of our platform with ease.</p>
                    </div>
                    <div
                        class="flex flex-col items-start justify-between p-6 space-y-4 overflow-hidden transition-shadow duration-200 bg-white bg-top bg-cover border border-gray-100 shadow-xl rounded-2xl group hover:shadow-2xl">
                        <div
                            class="flex items-center justify-center w-10 h-10 text-center bg-top bg-cover rounded-full bg-indigo-50">
                            <p class="relative">
                                <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                </svg>
                            </p>
                        </div>
                        <p class="font-bold text-gray-700">Template Designs</p>
                        <p class="text-sm leading-5 text-gray-500">Templates and designs for your next project. You can
                            easily drop these templates into any project.</p>
                    </div>
                    <div
                        class="flex flex-col items-start justify-between p-6 space-y-4 overflow-hidden transition-shadow duration-200 bg-white bg-top bg-cover border border-gray-100 shadow-xl rounded-2xl group hover:shadow-2xl">
                        <div
                            class="flex items-center justify-center w-10 h-10 text-center bg-top bg-cover rounded-full bg-indigo-50">
                            <p class="relative">
                                <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm9 4a1 1 0 10-2 0v6a1 1 0 102 0V7zm-3 2a1 1 0 10-2 0v4a1 1 0 102 0V9zm-3 3a1 1 0 10-2 0v1a1 1 0 102 0v-1z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </p>
                        </div>
                        <p class="font-bold text-gray-700">Analytics</p>
                        <p class="text-sm leading-5 text-gray-500">User and customer analytics to help you understand
                            which areas of your application are being used.</p>
                    </div>
                    <div
                        class="flex flex-col items-start justify-between p-6 space-y-4 overflow-hidden transition-shadow duration-200 bg-white bg-top bg-cover border border-gray-100 shadow-xl rounded-2xl group hover:shadow-2xl">
                        <div
                            class="flex items-center justify-center w-10 h-10 text-center bg-top bg-cover rounded-full bg-indigo-50">
                            <p class="relative">
                                <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </p>
                        </div>
                        <p class="font-bold text-gray-700">Filters</p>
                        <p class="text-sm leading-5 text-gray-500">Filter your results by the criteria that is the most
                            important and most vital to your business.</p>
                    </div>
                    <div
                        class="flex flex-col items-start justify-between p-6 space-y-4 overflow-hidden transition-shadow duration-200 bg-white bg-top bg-cover border border-gray-100 shadow-xl rounded-2xl group hover:shadow-2xl">
                        <div
                            class="flex items-center justify-center w-10 h-10 text-center bg-top bg-cover rounded-full bg-indigo-50">
                            <p class="relative">
                                <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path>
                                </svg>
                            </p>
                        </div>
                        <p class="font-bold text-gray-700">Customizations</p>
                        <p class="text-sm leading-5 text-gray-500">Customize every aspect of the user interface. You can
                            also customize the internal functionality.</p>
                    </div>
                    <div
                        class="flex flex-col items-start justify-between p-6 space-y-4 overflow-hidden transition-shadow duration-200 bg-white bg-top bg-cover border border-gray-100 shadow-xl rounded-2xl group hover:shadow-2xl">
                        <div
                            class="flex items-center justify-center w-10 h-10 text-center bg-top bg-cover rounded-full bg-indigo-50">
                            <p class="relative">
                                <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z"
                                        class=""></path>
                                </svg>

                            </p>
                        </div>
                        <p class="font-bold text-gray-700">Integrations</p>
                        <p class="text-sm leading-5 text-gray-500">We have also built some amazing and powerful
                            integrations to help you build quicker.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="pricing" class="bg-white py-24 sm:py-32" x-data="{yearly: false}">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="text-4xl font-semibold leading-7 text-indigo-600">Pricing</h2>
                <!-- <p class="mt-2 text-2xl font-bold tracking-tight text-gray-900 sm:text2xl">Affordable, flexible pricing options tailored to suit all needs and budgets.</p>-->
            </div>
            <p class="mx-auto mt-4 max-w-2xl text-center text-lg leading-8 text-gray-600">
                Affordable, flexible pricing options tailored to suit all needs and budgets.
            </p>
            <div class="mt-8 flex justify-center">
                <fieldset
                    class="grid grid-cols-2 gap-x-1 rounded-full p-1 text-center text-xs font-semibold leading-5 ring-1 ring-inset ring-gray-200">
                    <legend class="sr-only">Payment frequency</legend>

                    <!-- Checked: "bg-indigo-600 text-white", Not Checked: "text-gray-500" -->
                    <label class="cursor-pointer rounded-full px-2.5 py-1"
                           :class="yearly === false ? 'bg-indigo-600 text-white' : 'text-gray-500'"
                           @click="yearly = false">
                        <input type="radio" name="frequency" value="monthly" class="sr-only">
                        <span>Monthly</span>
                    </label>

                    <!-- Checked: "bg-indigo-600 text-white", Not Checked: "text-gray-500" -->
                    <label class="cursor-pointer rounded-full px-2.5 py-1"
                           :class="yearly === true ? 'bg-indigo-600 text-white' : 'text-gray-500'"
                           @click="yearly = true">

                        <input type="radio" name="frequency" value="yearly" class="sr-only">
                        <span>Yearly</span>
                    </label>
                </fieldset>
            </div>

            <div class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                @foreach($plans as $plan)

                    <div class="rounded-3xl p-8 ring-1 xl:p-10 ring-gray-200">
                        <h3 id="{{ $plan['name'] }}"
                            class="text-lg font-semibold leading-8 text-gray-900">{{ $plan['name'] }}</h3>
                        <p class="mt-4 text-sm leading-6 text-gray-600">{{ $plan['description'] }}</p>
                        <p class="mt-6 flex items-baseline gap-x-1">
                            <!-- Price, update based on frequency toggle state -->
                            <span class="text-4xl font-bold tracking-tight text-gray-900"
                                  x-text="yearly ? '{{ $plan['price']['yearly'] }}' : '{{ $plan['price']['monthly'] }}'">{{ $plan['price']['monthly'] }}</span>


                            <!-- Payment frequency, update based on frequency toggle state -->
                            <span class="text-sm font-semibold leading-6 text-gray-600"
                                  x-text="yearly ? '/year' : '/month'">/month</span>

                            @if(!$plan['free'])
                                <span x-cloak x-show="yearly" class="text-orange-700">(15% off)</span>
                            @endif
                        </p>
                        <a href="{{ route('register', ['plan' => $plan['name']]) }}" aria-describedby="tier-freelancer"
                           class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-indigo-600 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-indigo-600">
                            Get Started
                        </a>

                        <ul role="list" class="mt-8 space-y-3 text-sm leading-6 xl:mt-10 text-gray-600">

                            @foreach($plan['features'] as $feature)
                                <li class="flex gap-x-3">
                                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20"
                                         fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    {{ $feature }}
                                </li>
                            @endforeach

                        </ul>
                    </div>
                @endforeach


            </div>
        </div>
    </div>


    <!---- Testimonials -->
    <section id="testimonials" class="flex items-center justify-center py-16 bg-gray-100">
        <div class="max-w-6xl px-12 mx-auto bg-gray-100 md:px-16 xl:px-10">
            <div class="flex flex-col items-center lg:flex-row">
                <div class="flex flex-col items-start justify-center w-full h-full pr-8 mb-10 lg:mb-0 lg:w-1/2">
                    <p class="mb-2 text-base font-medium tracking-tight text-indigo-500 uppercase"
                       data-primary="indigo-500">Our customers love our product</p>
                    <h2 class="text-4xl font-extrabold leading-10 tracking-tight text-gray-900 sm:text-5xl sm:leading-none md:text-6xl lg:text-5xl xl:text-6xl">
                        Testimonials</h2>
                    <p class="my-6 text-lg text-gray-600">Don't just take our word for it, read testimonials from
                        empowered content creators, just like you.</p>
                    <a href="{{ route('login') }}"
                       class="flex items-center justify-center px-8 py-3 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md shadow hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo md:py-4 md:text-lg md:px-10"
                       data-primary="indigo-600" data-rounded="rounded-md">Get Started for Free</a>
                </div>
                <div class="w-full lg:w-1/2">
                    <blockquote
                        class="flex items-center justify-between w-full col-span-1 p-6 bg-white rounded-lg shadow"
                        data-rounded="rounded-lg" data-rounded-max="rounded-full">
                        <div class="flex flex-col pr-8">
                            <div class="relative pl-12">
                                <svg class="absolute left-0 w-10 h-10 text-indigo-500 fill-current"
                                     data-primary="indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 125">
                                    <path
                                        d="M30.7 42c0 6.1 12.6 7 12.6 22 0 11-7.9 19.2-18.9 19.2C12.7 83.1 5 72.6 5 61.5c0-19.2 18-44.6 29.2-44.6 2.8 0 7.9 2 7.9 5.4S30.7 31.6 30.7 42zM82.4 42c0 6.1 12.6 7 12.6 22 0 11-7.9 19.2-18.9 19.2-11.8 0-19.5-10.5-19.5-21.6 0-19.2 18-44.6 29.2-44.6 2.8 0 7.9 2 7.9 5.4S82.4 31.6 82.4 42z"></path>
                                </svg>
                                <p class="mt-2 text-sm text-gray-600 sm:text-base lg:text-sm xl:text-base">As a blogger,
                                    this AI writing tool has been a game-changer for me. It's like having a personal
                                    writing assistant at my fingertips. Thanks to this service, I can produce more
                                    content with better quality in less time.</p>
                            </div>

                            <h3 class="pl-12 mt-3 text-sm font-medium leading-5 text-gray-800 truncate sm:text-base lg:text-sm lg:text-base">
                                Olivia K.
                                <span class="mt-1 text-sm leading-5 text-gray-500 truncate">- Lifestyle Blogger and Influencer</span>
                            </h3>
                        </div>
                        <img class="flex-shrink-0 w-20 h-20 bg-gray-300 rounded-full xl:w-24 xl:h-24"
                             src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                             alt="">
                    </blockquote>
                    <blockquote
                        class="flex items-center justify-between w-full col-span-1 p-6 mt-4 bg-white rounded-lg shadow"
                        data-rounded="rounded-lg" data-rounded-max="rounded-full">
                        <div class="flex flex-col pr-10">
                            <div class="relative pl-12">
                                <svg class="absolute left-0 w-10 h-10 text-indigo-500 fill-current"
                                     data-primary="indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 125">
                                    <path
                                        d="M30.7 42c0 6.1 12.6 7 12.6 22 0 11-7.9 19.2-18.9 19.2C12.7 83.1 5 72.6 5 61.5c0-19.2 18-44.6 29.2-44.6 2.8 0 7.9 2 7.9 5.4S30.7 31.6 30.7 42zM82.4 42c0 6.1 12.6 7 12.6 22 0 11-7.9 19.2-18.9 19.2-11.8 0-19.5-10.5-19.5-21.6 0-19.2 18-44.6 29.2-44.6 2.8 0 7.9 2 7.9 5.4S82.4 31.6 82.4 42z"></path>
                                </svg>
                                <p class="mt-2 text-sm text-gray-600 sm:text-base lg:text-sm xl:text-base">As a small
                                    business owner, I need to create engaging content without breaking the bank. This AI
                                    writing service has been a lifesaver – it's affordable and consistently delivers
                                    high-quality, professional copy.</p>
                            </div>
                            <h3 class="pl-12 mt-3 text-sm font-medium leading-5 text-gray-800 truncate sm:text-base lg:text-sm lg:text-base">
                                Laura G.
                                <span class="mt-1 text-sm leading-5 text-gray-500 truncate">- CEO Small Business Owner, Online Retail Store</span>
                            </h3>
                            <p class="mt-1 text-sm leading-5 text-gray-500 truncate"></p>
                        </div>
                        <img class="flex-shrink-0 w-24 h-24 bg-gray-300 rounded-full"
                             src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                             alt="">
                    </blockquote>
                    <blockquote
                        class="flex items-center justify-between w-full col-span-1 p-6 mt-4 bg-white rounded-lg shadow"
                        data-rounded="rounded-lg" data-rounded-max="rounded-full">
                        <div class="flex flex-col pr-10">
                            <div class="relative pl-12">
                                <svg class="absolute left-0 w-10 h-10 text-indigo-500 fill-current"
                                     data-primary="indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 125">
                                    <path
                                        d="M30.7 42c0 6.1 12.6 7 12.6 22 0 11-7.9 19.2-18.9 19.2C12.7 83.1 5 72.6 5 61.5c0-19.2 18-44.6 29.2-44.6 2.8 0 7.9 2 7.9 5.4S30.7 31.6 30.7 42zM82.4 42c0 6.1 12.6 7 12.6 22 0 11-7.9 19.2-18.9 19.2-11.8 0-19.5-10.5-19.5-21.6 0-19.2 18-44.6 29.2-44.6 2.8 0 7.9 2 7.9 5.4S82.4 31.6 82.4 42z"></path>
                                </svg>
                                <p class="mt-2 text-sm text-gray-600 sm:text-base lg:text-sm xl:text-base">The AI
                                    writing tool has taken my copywriting to the next level. It's been a valuable
                                    addition to my toolkit, and I can't imagine going back to the old way of creating
                                    content. Highly recommended!</p>
                            </div>

                            <h3 class="pl-12 mt-3 text-sm font-medium leading-5 text-gray-800 truncate sm:text-base lg:text-sm lg:text-base">
                                John Smith
                                <span
                                    class="mt-1 text-sm leading-5 text-gray-500 truncate">- Freelance Copywriter</span>
                            </h3>
                            <p class="mt-1 text-sm leading-5 text-gray-500 truncate"></p>
                        </div>
                        <img class="flex-shrink-0 w-24 h-24 bg-gray-300 rounded-full"
                             src="https://images.unsplash.com/photo-1545167622-3a6ac756afa4?ixlib=rrb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;aauto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                             alt="">
                    </blockquote>
                </div>
            </div>
        </div>
    </section>


    <!--- FAQ -->

    <section id="faq" class="py-12 bg-purple-600 sm:py-16 md:py-20 lg:py-24 pb-28" data-primary="purple-600">
        <div class="max-w-6xl px-8 mx-auto lg:px-16">
            <h2 class="mb-2 text-2xl font-bold text-center text-white md:text-3xl lg:text-4xl">Frequently Asked
                Questions</h2>

            <div class="relative flex flex-col mt-8 mt-16 lg:flex-row">

                <!-- Left side of FAQs -->
                <div class="relative w-full space-y-3 lg:space-y-5 lg:w-1/2 lg:pr-4">

                    <!-- Question 1 -->
                    <div x-data="{ show: false }"
                         class="relative px-6 py-2 overflow-hidden text-white bg-purple-700 rounded-lg select-none"
                         data-primary="purple-600" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                        <h4 @click="show=!show"
                            class="flex items-center justify-between py-4 text-base font-medium text-purple-100 cursor-pointer sm:text-lg hover:text-white"
                            data-primary="purple-600">
                            <span class="">How does the AI-powered writing assistant work?</span>
                            <svg class="w-4 h-4 mr-1 transition-all duration-200 ease-out transform rotate-0"
                                 :class="{ '-rotate-180' : show }" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </h4>
                        <p class="px-1 pt-0 mt-1 text-purple-200 sm:text-lg py-7" data-primary="purple-600"
                           x-transition:enter="transition-all ease-out duration-300"
                           x-transition:enter-start="opacity-0 transform -translate-y-4"
                           x-transition:enter-end="opacity-100 transform -translate-y-0"
                           x-transition:leave="transition-all ease-out hidden duration-200"
                           x-transition:leave-start="opacity-100 transform -translate-y-0"
                           x-transition:leave-end="opacity-0 transform -translate-y-4" x-show="show"
                           style="display: none;">Our AI writing assistant uses advanced natural language processing and
                            machine learning algorithms to understand user inputs and generate human-like text. It
                            analyzes context, learns from patterns, and creates relevant, engaging content based on the
                            prompts or information provided.</p>
                    </div>

                    <!-- Question 2 -->
                    <div x-data="{ show: false }"
                         class="relative px-6 py-2 overflow-hidden text-white bg-purple-700 rounded-lg select-none"
                         data-primary="purple-600" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                        <h4 @click="show=!show"
                            class="flex items-center justify-between py-4 text-base font-medium text-purple-100 cursor-pointer sm:text-lg hover:text-white"
                            data-primary="purple-600">
                            <span>Can I try the AI writing assistant before committing to a plan?</span>
                            <svg class="w-4 h-4 mr-1 transition-all duration-200 ease-out transform rotate-0"
                                 :class="{ '-rotate-180' : show }" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </h4>
                        <p class="px-1 pt-0 mt-1 text-purple-200 sm:text-lg py-7" data-primary="purple-600"
                           x-transition:enter="transition-all ease-out duration-300"
                           x-transition:enter-start="opacity-0 transform -translate-y-4"
                           x-transition:enter-end="opacity-100 transform -translate-y-0"
                           x-transition:leave="transition-all ease-out hidden duration-200"
                           x-transition:leave-start="opacity-100 transform -translate-y-0"
                           x-transition:leave-end="opacity-0 transform -translate-y-4" x-show="show"
                           style="display: none;">Yes, we offer a free trial so you can experience the capabilities of
                            our AI writing tool firsthand. Simply sign up on our website to get started.</p>
                    </div>

                    <!-- Question 3 -->
                    <div x-data="{ show: false }"
                         class="relative px-6 py-2 overflow-hidden text-white bg-purple-700 rounded-lg select-none"
                         data-primary="purple-600" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                        <h4 @click="show=!show"
                            class="flex items-center justify-between py-4 text-base font-medium text-purple-100 cursor-pointer sm:text-lg hover:text-white"
                            data-primary="purple-600">
                            <span>Is the content generated by the AI writing tool SEO-friendly?</span>
                            <svg class="w-4 h-4 mr-1 transition-all duration-200 ease-out transform rotate-0"
                                 :class="{ '-rotate-180' : show }" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </h4>
                        <p class="px-1 pt-0 mt-1 text-purple-200 sm:text-lg py-7" data-primary="purple-600"
                           x-transition:enter="transition-all ease-out duration-300"
                           x-transition:enter-start="opacity-0 transform -translate-y-4"
                           x-transition:enter-end="opacity-100 transform -translate-y-0"
                           x-transition:leave="transition-all ease-out hidden duration-200"
                           x-transition:leave-start="opacity-100 transform -translate-y-0"
                           x-transition:leave-end="opacity-0 transform -translate-y-4" x-show="show"
                           style="display: none;">Yes, our AI writing assistant can create SEO-optimized content to help
                            improve your search engine rankings. Make sure to provide relevant keywords, and the tool
                            will incorporate them into the generated content.</p>
                    </div>


                    <!-- Question 4 -->
                    <div x-data="{ show: false }"
                         class="relative px-6 py-2 overflow-hidden text-white bg-purple-700 rounded-lg select-none"
                         data-primary="purple-600" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                        <h4 @click="show=!show"
                            class="flex items-center justify-between py-4 text-base font-medium text-purple-100 cursor-pointer sm:text-lg hover:text-white"
                            data-primary="purple-600">
                            <span>Will the AI-generated content be unique, or is there a risk of plagiarism?</span>
                            <svg class="w-4 h-4 mr-1 transition-all duration-200 ease-out transform rotate-0"
                                 :class="{ '-rotate-180' : show }" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </h4>
                        <p class="px-1 pt-0 mt-1 text-purple-200 sm:text-lg py-7" data-primary="purple-600"
                           x-transition:enter="transition-all ease-out duration-300"
                           x-transition:enter-start="opacity-0 transform -translate-y-4"
                           x-transition:enter-end="opacity-100 transform -translate-y-0"
                           x-transition:leave="transition-all ease-out hidden duration-200"
                           x-transition:leave-start="opacity-100 transform -translate-y-0"
                           x-transition:leave-end="opacity-0 transform -translate-y-4" x-show="show"
                           style="display: none;">Our AI writing assistant is designed to generate unique content.
                            However, as with any automated tool, there is a slight chance of similarity with existing
                            content. We recommend checking the generated text for originality using a plagiarism
                            detection tool before publishing.</p>
                    </div>
                </div>


                <!-- Right side of FAQs -->
                <div class="relative w-full mt-3 space-y-3 lg:mt-0 lg:space-y-5 lg:w-1/2 lg:pl-4">
                    <!-- Question 1 -->
                    <div x-data="{ show: false }"
                         class="relative px-6 py-2 overflow-hidden text-white bg-purple-700 rounded-lg select-none"
                         data-primary="purple-600" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                        <h4 @click="show=!show"
                            class="flex items-center justify-between py-4 text-base font-medium text-purple-100 cursor-pointer sm:text-lg hover:text-white"
                            data-primary="purple-600">
                            <span class="">How does the credit system work for the AI writing tool?</span>
                            <svg class="w-4 h-4 mr-1 transition-all duration-200 ease-out transform rotate-0"
                                 :class="{ '-rotate-180' : show }" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </h4>
                        <p class="px-1 pt-0 mt-1 text-purple-200 sm:text-lg py-7" data-primary="purple-600"
                           x-transition:enter="transition-all ease-out duration-300"
                           x-transition:enter-start="opacity-0 transform -translate-y-4"
                           x-transition:enter-end="opacity-100 transform -translate-y-0"
                           x-transition:leave="transition-all ease-out hidden duration-200"
                           x-transition:leave-start="opacity-100 transform -translate-y-0"
                           x-transition:leave-end="opacity-0 transform -translate-y-4" x-show="show"
                           style="display: none;">Our credit system is based on the number of words generated by the AI
                            writing assistant. Each credit corresponds to one word. Your plan determines the total
                            number of credits available to you, which get consumed as you use the tool to create
                            content.
                        </p>
                    </div>

                    <!-- Question 2 -->
                    <div x-data="{ show: false }"
                         class="relative px-6 py-2 overflow-hidden text-white bg-purple-700 rounded-lg select-none"
                         data-primary="purple-600" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                        <h4 @click="show=!show"
                            class="flex items-center justify-between py-4 text-base font-medium text-purple-100 cursor-pointer sm:text-lg hover:text-white"
                            data-primary="purple-600">
                            <span class="">How do I provide input or prompts to the AI writing assistant?</span>
                            <svg class="w-4 h-4 mr-1 transition-all duration-200 ease-out transform rotate-0"
                                 :class="{ '-rotate-180' : show }" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </h4>
                        <p class="px-1 pt-0 mt-1 text-purple-200 sm:text-lg py-7" data-primary="purple-600"
                           x-transition:enter="transition-all ease-out duration-300"
                           x-transition:enter-start="opacity-0 transform -translate-y-4"
                           x-transition:enter-end="opacity-100 transform -translate-y-0"
                           x-transition:leave="transition-all ease-out hidden duration-200"
                           x-transition:leave-start="opacity-100 transform -translate-y-0"
                           x-transition:leave-end="opacity-0 transform -translate-y-4" x-show="show"
                           style="display: none;">
                            Simply type your desired prompt, topic, or keywords into the input field, and the AI writing
                            tool will generate content based on the information provided. You can also adjust settings
                            to fine-tune the output according to your preferences.
                        </p>
                    </div>

                    <!-- Question 3 -->
                    <div x-data="{ show: false }"
                         class="relative px-6 py-2 overflow-hidden text-white bg-purple-700 rounded-lg select-none"
                         data-primary="purple-600" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                        <h4 @click="show=!show"
                            class="flex items-center justify-between py-4 text-base font-medium text-purple-100 cursor-pointer sm:text-lg hover:text-white"
                            data-primary="purple-600">
                            <span>Can I use the AI writing tool to create content in multiple languages?</span>
                            <svg class="w-4 h-4 mr-1 transition-all duration-200 ease-out transform rotate-0"
                                 :class="{ '-rotate-180' : show }" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </h4>
                        <p class="px-1 pt-0 mt-1 text-purple-200 sm:text-lg py-7" data-primary="purple-600"
                           x-transition:enter="transition-all ease-out duration-300"
                           x-transition:enter-start="opacity-0 transform -translate-y-4"
                           x-transition:enter-end="opacity-100 transform -translate-y-0"
                           x-transition:leave="transition-all ease-out hidden duration-200"
                           x-transition:leave-start="opacity-100 transform -translate-y-0"
                           x-transition:leave-end="opacity-0 transform -translate-y-4" x-show="show"
                           style="display: none;">Yes, our AI-powered writing assistant supports multiple languages.</p>
                    </div>


                    <!-- Question 4 -->
                    <div x-data="{ show: false }"
                         class="relative px-6 py-2 overflow-hidden text-white bg-purple-700 rounded-lg select-none"
                         data-primary="purple-600" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                        <h4 @click="show=!show"
                            class="flex items-center justify-between py-4 text-base font-medium text-purple-100 cursor-pointer sm:text-lg hover:text-white"
                            data-primary="purple-600">
                            <span>Is the AI writing tool suitable for my specific industry or niche?</span>
                            <svg class="w-4 h-4 mr-1 transition-all duration-200 ease-out transform rotate-0"
                                 :class="{ '-rotate-180' : show }" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </h4>
                        <p class="px-1 pt-0 mt-1 text-purple-200 sm:text-lg py-7" data-primary="purple-600"
                           x-transition:enter="transition-all ease-out duration-300"
                           x-transition:enter-start="opacity-0 transform -translate-y-4"
                           x-transition:enter-end="opacity-100 transform -translate-y-0"
                           x-transition:leave="transition-all ease-out hidden duration-200"
                           x-transition:leave-start="opacity-100 transform -translate-y-0"
                           x-transition:leave-end="opacity-0 transform -translate-y-4" x-show="show"
                           style="display: none;">Absolutely! Our AI-powered writing assistant is designed to adapt to
                            various industries and niches. Simply provide context and relevant information, and the tool
                            will generate content tailored to your specific needs.</p>
                    </div>
                </div>


            </div>

        </div>
    </section>


    <!-- CTA -->

    <section class="bg-white tails-selected-element">
        <div class="px-8 py-8 mx-auto sm:py-10 lg:py-16 max-w-7xl">
            <div
                class="relative py-6 overflow-hidden rounded-lg bg-gradient-to-r from-pink-500 to-purple-500 lg:py-12 md:px-6 lg:p-16 lg:flex lg:items-center lg:justify-between md:shadow-xl md:bg-purple-1000"
                data-primary="purple-600" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                <div
                    class="absolute top-0 right-0 hidden w-full -mt-20 transform rotate-45 translate-x-1/2 bg-white sm:block h-96 opacity-5"></div>
                <div
                    class="absolute top-0 left-0 hidden w-full -mt-20 transform rotate-45 -translate-x-1/2 bg-pink-300 sm:block h-96 opacity-5"></div>
                <div class="relative p-6 rounded-lg md:p-0 md:pb-4">
                    <h2 class="text-3xl font-extrabold leading-9 tracking-tight text-white sm:text-4xl sm:leading-10">
                        Upgrade Your Writing Experience Today!</h2>
                    <p class="w-full mt-5 text-base font-medium leading-6 text-pink-100 md:w-3/4"
                       data-primary="pink-600">
                        Join the content creation revolution and harness the power of our AI writing tool. Get started
                        for free and witness your content evolve!.
                    </p>
                </div>
                <div
                    class="relative flex flex-col items-center w-full px-6 space-y-5 md:space-x-5 md:space-y-0 md:flex-row md:w-auto lg:flex-shrink-0 md:px-0">
                    <a href="{{ route('register') }}"
                       class="block w-full px-5 py-3 text-base font-medium leading-6 text-center text-purple-600 transition duration-150 ease-in-out bg-purple-100 rounded-md md:inline-flex md:shadow md:w-auto hover:bg-white focus:outline-none focus:shadow-outline"
                       data-primary="purple-600" data-rounded="rounded-md">Try it free!</a>
                    <!--<a href="#_" class="text-white">Try it free</a>-->
                </div>
            </div>
        </div>
    </section>


</x-appLayout>

