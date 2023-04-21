<x-appLayout :title="$meta->title" :description="$meta->description">
    <div class="bg-white">
        <div class="relative isolate sm:pt-6 md:pt-14">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                 aria-hidden="true">
                <div
                    class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>
            <div class="py-24 sm:py-32 lg:pb-40">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                            AI-Powered Content Writer</h1>

                        <!--<div x-data="textRotator()" class="">
                            <span x-text="currentWord"></span>
                        </div>-->

                        <p class="mt-6 text-lg leading-8 text-gray-600">
                            Amplify your content creation. Create engaging blog posts, ads, emails, ecommerce and website copies in
                            a few clicks.
                        </p>
                        <div class="mt-10 flex items-center justify-center gap-x-6">
                            <a href="{{ route('register') }}"
                               class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Get started for free</a>
                            <a href="#how" class="text-sm font-semibold leading-6 text-gray-900">Learn more <span
                                    aria-hidden="true">→</span></a>
                        </div>
                    </div>
                    <div class="mt-16 flow-root sm:mt-24 grid place-items-center">
                        <div class="max-w-3xl lg:max-w-5xl -m-2 rounded-xl bg-gray-900/5 p-2 ring-1 ring-inset ring-gray-900/10 lg:-m-4 lg:rounded-2xl lg:p-4">
                            <img src="{{ asset('img/header-img.png') }}"
                                 alt="editor screenshot"
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


    <section id="how">
    <div class="max-w-7xl px-8 mx-auto lg:px-20 py-8">
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
                            <span
                                class="absolute left-0 top-0 h-full w-1 bg-transparent group-hover:bg-gray-200 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full"
                                aria-hidden="true"></span>
                            <span class="flex items-start px-6 py-5 text-sm font-medium">
                                <span class="flex-shrink-0">
                                    <span
                                        class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gray-300">
                                        <span class="text-gray-500">01</span>
                                    </span>
                                </span>
                                <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                                    <span class="text-sm font-medium">Select Template</span>
                                    <span class="text-sm font-medium text-gray-500">Select a Template and provide a topic, keywords, or context to guide the AI writing assistant in generating relevant content tailored to your needs.</span>
                                </span>
                            </span>
                    </div>
                </li>

                <li class="relative overflow-hidden lg:flex-1">
                    <div class="overflow-hidden border border-gray-200 lg:border-0">
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
                                <span class="text-sm font-medium text-gray-500">
                                    Watch as the AI-powered tool processes your input and creates engaging, high-quality text in a matter of seconds.
                                </span>
                            </span>
                        </span>

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
    </section>


    <section id="features">
        <div class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap items-center">
                    <div class="w-full lg:w-1/2 mb-12 lg:mb-0">
                        <div class="max-w-md lg:mx-auto">
                            <span class="text-green-600 font-bold">The perfect AI writing tool</span>
                            <h2 class="my-2 text-4xl lg:text-5xl font-bold font-heading">
                                For everyone
                            </h2>
                            <p class="mb-6 text-gray-500 leading-loose">
                                Write like a pro. Say Goodbye to Writer's Block!
                            </p>


                            <div class="flex flex-wrap text-gray-500 font-bold">
                                <div class="w-1/2 p-2">
                                    <i class="ri-ball-pen-line text-indigo-500 mr-1"></i>
                                    <span>Writers</span>
                                </div>

                                <div class="w-1/2 p-2">
                                    <i class="ri-bar-chart-box-line text-indigo-500 mr-1"></i>
                                    <span>Marketers</span>
                                </div>

                                <div class="w-1/2 p-2">
                                    <i class="ri-bubble-chart-line text-indigo-500 mr-1"></i>
                                    <span>Entrepreneurs</span>
                                </div>

                                <div class="w-1/2 p-2">
                                    <i class="ri-wordpress-line text-indigo-500 mr-1"></i>
                                    <span>Bloggers</span>
                                </div>

                                <div class="w-1/2 p-2">
                                    <i class="ri-graduation-cap-line text-indigo-500 mr-1"></i>
                                    <span>Academics</span>
                                </div>

                                <div class="w-1/2 p-2">
                                    <i class="ri-briefcase-line text-indigo-500 mr-1"></i>
                                    <span>Professionals</span>
                                </div>

                            </div>

                            <div class="mt-4">
                                <a class="w-40 inline-block text-center py-2 px-2 rounded-l-xl rounded-t-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold leading-loose transition duration-200"
                                   href="{{ route('login') }}">
                                    Get Started
                                </a>
                            </div>



                        </div>

                    </div>

                    <div class="w-full lg:w-1/2 flex flex-wrap -mx-4">
                        <div class="mb-8 lg:mb-0 w-full md:w-1/2 px-4">
                            <div class="mb-8 py-6 pl-6 pr-4 shadow rounded bg-white">
                                 <span class="mb-4 inline-flex p-3 rounded bg-indigo-100">
                                        <span class="h-10 w-10 flex items-center justify-center text-indigo-600"
                                              aria-hidden="true">
                                            <i class="ri-ai-generate" style="font-size: 40px;"></i>
                                        </span>
                                </span>

                                <h4 class="mb-2 text-2xl font-bold font-heading">Intuitive AI Assistant</h4>
                                <p class="text-gray-500 leading-loose">
                                    Let our smart AI help you craft impactful content effortlessly for any format or
                                    purpose.
                                </p>
                            </div>
                            <div class="py-6 pl-6 pr-4 shadow rounded bg-white">
                                 <span class="mb-4 inline-flex p-3 rounded bg-indigo-100">
                                        <span class="h-10 w-10 flex items-center justify-center text-indigo-600"
                                              aria-hidden="true">
                                            <i class="ri-edit-box-line" style="font-size: 40px;"></i>
                                        </span>
                                </span>

                                <h4 class="mb-2 text-2xl font-bold font-heading">Powerful Editor</h4>
                                <p class="text-gray-500 leading-loose">
                                    Effortlessly refine your content with our sleek, user-friendly editor.
                                </p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 lg:mt-20 px-4">
                            <div class="mb-8 py-6 pl-6 pr-4 shadow rounded-lg bg-white">
                                <span class="mb-4 inline-flex p-3 rounded bg-indigo-100">
                                        <span class="h-10 w-10 flex items-center justify-center text-indigo-600"
                                              aria-hidden="true">
                                            <i class="ri-bar-chart-horizontal-line" style="font-size: 40px;"></i>
                                        </span>
                                </span>
                                <h4 class="mb-2 text-2xl font-bold font-heading">50+ Templates</h4>
                                <p class="text-gray-500 leading-loose">
                                    Choose from over 50+ templates that suits your use case.
                                </p>
                            </div>
                            <div class="py-6 pl-6 pr-4 shadow rounded-lg bg-white">
                                 <span class="mb-4 inline-flex p-3 rounded bg-indigo-100">
                                        <span class="h-10 w-10 flex items-center justify-center text-indigo-600"
                                              aria-hidden="true">
                                            <i class="ri-global-line" style="font-size: 40px;"></i>
                                        </span>
                                </span>
                                <h4 class="mb-2 text-2xl font-bold font-heading">Multi-Lingua</h4>
                                <p class="text-gray-500 leading-loose">
                                    Expand your global reach with our multi-language support.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="features" class="">
        <div class="px-6 py-8 ml-auto mr-auto bg-top bg-cover max-w-7xl">

            <h2 class="mb-2 text-2xl font-bold text-center  md:text-3xl lg:text-4xl">
                Common Use Cases
            </h2>
            <p class="mb-6 text-center text-gray-600">
                50+ templates you can choose from
            </p>


            <div class="relative grid gap-6 bg-top bg-cover sm:grid-cols-2 lg:grid-cols-4">

                @foreach($templates as $template)

                    <div
                        class="flex flex-col items-start justify-between p-6 space-y-4 overflow-hidden transition-shadow duration-200 bg-white bg-top bg-cover border border-gray-100 shadow-xl rounded-2xl group hover:shadow-2xl">
                        <div
                            class="flex items-center justify-center w-10 h-10 text-center bg-top bg-cover rounded-full bg-indigo-50">
                            <p class="relative">

                                <span class="w-5 h-5 text-indigo-500">
                                    <i class="{{ $template->icon }}" style="font-size: 24px;"></i>
                                </span>

                            </p>
                        </div>
                        <p class="font-bold text-gray-700">{{ $template->name }}</p>
                        <p class="text-sm leading-5 text-gray-500">{{ $template->description }}</p>
                    </div>

                @endforeach

            </div>
        </div>
    </section>


    <section id="pricing" class="bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="py-20 bg-gray-50" x-data="{yearly: false}">
                <div class="container mx-auto px-4">
                    <div class="max-w-2xl mx-auto text-center mb-16">
                        <span class="text-green-600 font-bold">Affordable Plans for All Creators</span>
                        <h2 class="mb-2 text-4xl lg:text-5xl font-bold font-heading">Choose your best plan</h2>
                        <p class="mb-6 text-gray-600">
                            Explore our diverse range of pricing options, designed to accommodate every content
                            creator's needs and budget.
                        </p>

                        <div class="inline-block py-1 px-1 bg-white rounded-lg">
                            <button class="mr-1 text-sm py-2 px-4 text-gray-900 rounded-lg shadow font-bold"
                                    :class="yearly === false ? 'bg-indigo-600 text-white' : 'text-gray-500'"
                                    @click="yearly = false">
                                Monthly
                                <input type="radio" name="frequency" value="monthly" class="sr-only"/>
                            </button>

                            <button class="text-sm py-2 px-4 text-gray-900 bg-gray-50 rounded-lg shadow font-bold"
                                    :class="yearly === true ? 'bg-indigo-600 text-white' : 'text-gray-500'"
                                    @click="yearly = true">
                                Yearly
                                <input type="radio" name="frequency" value="yearly" class="sr-only"/>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-wrap justify-center -mx-4">
                        @foreach($plans as $plan)

                            <div class="w-full md:w-1/3 lg:w-1/4 px-4 mb-8 lg:mb-0">
                                <div class="p-8 bg-white shadow rounded">
                                    <h4 class="mb-2 text-2xl font-bold font-heading">{{ $plan['name'] }}</h4>

                                    @if($plan['free'])
                                        <span class="text-5xl font-bold">$0</span>
                                    @else
                                        <span class="text-5xl font-bold"
                                              x-text="yearly ? '{{ $plan['price']['yearly'] }}' : '{{ $plan['price']['monthly'] }}'">
                                    {{ $plan['price']['monthly'] }}
                                        </span>

                                        <span class="text-gray-400 text-xs"
                                              x-text="yearly ? '/year' : '/month'">/month</span>

                                        <span x-cloak x-show="yearly" class="text-indigo-500">(15% off)</span>

                                    @endif

                                    <p class="mt-3 mb-6 text-gray-500 leading-loose">{{ $plan['description'] }}</p>
                                    <ul class="mb-6 text-gray-500">

                                        @foreach($plan['features'] as $feature)
                                            <li class="mb-2 flex">
                                                <svg class="mr-2 w-5 h-5 text-indigo-600"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                                <span>{{ $feature }}</span>
                                            </li>
                                        @endforeach


                                    </ul>
                                    <a class="inline-block text-center py-2 px-4 w-full rounded-l-xl rounded-t-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold leading-loose transition duration-200"
                                       href="{{ route('register', ['plan' => $plan['name']]) }}">
                                        Get Started
                                    </a>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </section>


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
                       data-primary="indigo-600" data-rounded="rounded-md">Get Started</a>
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
                                <span class="mt-1 text-sm leading-5 text-gray-500 truncate">- Lifestyle Blogger</span>
                            </h3>
                        </div>
                        <!--
                        <img class="flex-shrink-0 w-20 h-20 bg-gray-300 rounded-full xl:w-24 xl:h-24"
                             src=""
                             alt="">-->
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
                                Anthony G.
                                <span class="mt-1 text-sm leading-5 text-gray-500 truncate">- Business owner</span>
                            </h3>
                            <p class="mt-1 text-sm leading-5 text-gray-500 truncate"></p>
                        </div>
                        <!--
                        <img class="flex-shrink-0 w-24 h-24 bg-gray-300 rounded-full"
                             src=""
                             alt="">-->
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
                                Craig S.
                                <span
                                    class="mt-1 text-sm leading-5 text-gray-500 truncate">- Freelance Copywriter</span>
                            </h3>
                            <p class="mt-1 text-sm leading-5 text-gray-500 truncate"></p>
                        </div>
                        <!--
                        <img class="flex-shrink-0 w-24 h-24 bg-gray-300 rounded-full"
                             src="w=256&amp;h=256&amp;q=60"
                             alt="">-->
                    </blockquote>
                </div>
            </div>
        </div>
    </section>


    <!--- FAQ -->

    <section id="faq" class="py-12 bg-gray-50 sm:py-16 md:py-20 lg:py-24 pb-28">
        <div class="max-w-6xl px-8 mx-auto lg:px-16">
            <h2 class="mb-2 text-2xl font-bold text-center  md:text-3xl lg:text-4xl">Frequently Asked
                Questions</h2>
            <p class="mb-6 text-center text-gray-600">
                Get quick answers to common questions about our AI-powered copywriting tool.
            </p>

            <div class="relative flex flex-col mt-8 mt-16 lg:flex-row">

                <!-- Left side of FAQs -->
                <div class="relative w-full space-y-3 lg:space-y-5 lg:w-1/2 lg:pr-4">

                    @foreach(config('faq.left') as $faq => $detail)
                        <div x-data="{ show: false }"
                             class="relative px-6 py-2 overflow-hidden text-white bg-gray-200 rounded-lg select-none"
                             data-primary="green-600" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                            <h4 @click="show=!show"
                                class="flex items-center justify-between py-4 text-base font-medium text-gray-800 cursor-pointer sm:text-lg hover:text-gray-700">
                                <span class="">{{ $faq }}</span>
                                <svg class="w-4 h-4 mr-1 transition-all duration-200 ease-out transform rotate-0"
                                     :class="{ '-rotate-180' : show }" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h4>
                            <p class="px-1 pt-0 mt-1 text-gray-800 sm:text-lg py-7"
                               x-transition:enter="transition-all ease-out duration-300"
                               x-transition:enter-start="opacity-0 transform -translate-y-4"
                               x-transition:enter-end="opacity-100 transform -translate-y-0"
                               x-transition:leave="transition-all ease-out hidden duration-200"
                               x-transition:leave-start="opacity-100 transform -translate-y-0"
                               x-transition:leave-end="opacity-0 transform -translate-y-4" x-show="show"
                               style="display: none;">{{ $detail }}</p>
                        </div>
                    @endforeach

                </div>


                <!-- Right side of FAQs -->
                <div class="relative w-full mt-3 space-y-3 lg:mt-0 lg:space-y-5 lg:w-1/2 lg:pl-4">
                    @foreach(config('faq.right') as $faq => $detail)
                        <div x-data="{ show: false }"
                             class="relative px-6 py-2 overflow-hidden text-white bg-gray-200 rounded-lg select-none"
                             data-primary="indigo-600" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                            <h4 @click="show=!show"
                                class="flex items-center justify-between py-4 text-base font-medium text-gray-800 cursor-pointer sm:text-lg hover:text-gray-700">
                                <span class="">{{ $faq }}</span>
                                <svg class="w-4 h-4 mr-1 transition-all duration-200 ease-out transform rotate-0"
                                     :class="{ '-rotate-180' : show }" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h4>

                            <p class="px-1 pt-0 mt-1 text-gray-800 sm:text-lg py-7"
                               x-transition:enter="transition-all ease-out duration-300"
                               x-transition:enter-start="opacity-0 transform -translate-y-4"
                               x-transition:enter-end="opacity-100 transform -translate-y-0"
                               x-transition:leave="transition-all ease-out hidden duration-200"
                               x-transition:leave-start="opacity-100 transform -translate-y-0"
                               x-transition:leave-end="opacity-0 transform -translate-y-4" x-show="show"
                               style="display: none;">
                                {{ $detail }}
                            </p>
                        </div>
                    @endforeach

                </div>


            </div>

        </div>
    </section>


    <!-- CTA -->

    <section class="bg-white tails-selected-element">
        <div class="px-8 py-8 mx-auto sm:py-10 lg:py-16 max-w-7xl">
            <div
                class="relative py-6 overflow-hidden rounded-lg bg-gradient-to-r from-pink-500 to-indigo-500 lg:py-12 md:px-6 lg:p-16 lg:flex lg:items-center lg:justify-between md:shadow-xl md:bg-indigo-1000"
                data-primary="indigo-600" data-rounded="rounded-lg" data-rounded-max="rounded-full">
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
                    <a href="{{ route('login') }}"
                       class="block w-full px-5 py-3 text-base font-medium leading-6 text-center text-indigo-600 transition duration-150 ease-in-out bg-indigo-100 rounded-md md:inline-flex md:shadow md:w-auto hover:bg-white focus:outline-none focus:shadow-outline"
                       data-primary="indigo-600" data-rounded="rounded-md">Try it free!</a>
                    <!--<a href="#_" class="text-white">Try it free</a>-->
                </div>
            </div>
        </div>
    </section>


</x-appLayout>

<script>
    function textRotator() {
        return {
            words: ['Content', 'Ads', 'Blogpost'],
            currentIndex: 0,
            currentWord: 'Content',

            init() {
                setInterval(() => {
                    this.currentIndex = (this.currentIndex + 1) % this.words.length;
                    this.currentWord = this.words[this.currentIndex];
                }, 2000);
            }
        }
    }
</script>
