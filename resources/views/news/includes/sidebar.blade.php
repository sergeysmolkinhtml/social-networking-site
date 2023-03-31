<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
         xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
</button>

<aside id="logo-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
       aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <a href="https://flowbite.com/" class="flex items-center pl-2.5 mb-5">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 mr-3 sm:h-7" alt="Flowbite Logo"/>
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
        </a>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="#"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg aria-hidden="true"
                         class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">{{auth()->user()->full_name}}</span>
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg aria-hidden="true"
                         class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Marketplace</span>
                    <span
                        class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg aria-hidden="true"
                         class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path>
                        <path
                            d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Inbox</span>
                    <span
                        class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg aria-hidden="true"
                         class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Find friends</span>
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg aria-hidden="true"
                         class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Basket</span>
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg aria-hidden="true"
                         class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Sign In</span>
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg aria-hidden="true"
                         class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Sign Up</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500"><img src="data:image/jpeg;base64,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"></p>
            </div>
            <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
            <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
        </div>
        <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
            <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
            <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
            <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
            <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
        </div>
        <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
            <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
            <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
            <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
            <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
            </div>
        </div>
    </div>
</div>


