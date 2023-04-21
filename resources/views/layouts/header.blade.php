<div class="bg-white">
    <header x-data="{ open: false }" @keydown.window.escape="open = false" class="absolute inset-x-0 top-0 z-50">
        <nav class="mx-auto max-w-7xl flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="/" class="-m-1.5 p-1.5">
                    <span class="sr-only">CopyPhrase</span>
                    <img class="h-8 w-auto"
                         src="{{ asset('logo.png') }}" alt="">
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

                <a href="/#features" class="text-base font-semibold leading-6 text-gray-900">Features</a>

                <a href="/#pricing" class="text-base font-semibold leading-6 text-gray-900">Pricing</a>

                <a href="/#faq" class="text-base font-semibold leading-6 text-gray-900">FAQ</a>

            </div>
            <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:gap-x-6">

                @if(auth()->check())
                    <a href="{{ route('dashboard') }}"
                       class="rounded-md bg-indigo-600 px-3 py-2 text-base font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Dashboard <span aria-hidden="true">→</span></a>
                @else
                    <a href="{{ route('login') }}"
                       class="hidden lg:block lg:text-base lg:font-semibold lg:leading-6 lg:text-gray-900">
                        Log in <span aria-hidden="true">→</span></a>
                    <a href="{{ route('register') }}"
                       class="rounded-md bg-indigo-600 px-3 py-2 text-base font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Sign up</a>
                @endif
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
                        <div class="space-y-2 py-6" @click="open = false">

                            <a href="/#features"
                               class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Features</a>

                            <a href="/#pricing"
                               class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Pricing</a>

                            <a href="/#faq"
                               class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">FAQ</a>
                        </div>
                        <div class="py-6">

                            @if(auth()->check())
                                <a href="{{ route('dashboard') }}" class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
                                    Dashboard <span aria-hidden="true">→</span>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                    Log in
                                </a>

                                <a href="{{ route('register') }}" class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
                                    Sign up
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
