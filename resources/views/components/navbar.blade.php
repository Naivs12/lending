<nav class="w-64 bg-gray-800 text-white flex flex-col p-4 space-y-4">
    <div class="flex items-center space-x-2 mx-3.5 my-4 mb-5">
        <!-- <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company Logo"> -->
        <span class="text-lg font-semibold">Your Company</span>
    </div>

    <!-- Loan Module with Clickable Toggle -->
    <div x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-gray-700 space-x-2 focus:outline-none">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21V3m4 18V3m-8 18V3"></path>
                </svg>
                <span>Loan</span>
            </div>
            <svg :class="{'rotate-90': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Submodule Links (Hidden by Default) -->
        <div x-show="open" class="ml-6 mt-2 space-y-2 ms-5" x-collapse>
            <a href="{{route('admin.loan.loan')}}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                <span>Loan</span>
            </a>
            <a href="{{route('admin.loan.release')}}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                <span>Release</span>
            </a>
            <a href="{{route('admin.loan.review')}}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                <span>Review</span>
            </a>
        </div>
    </div>
    <div x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-gray-700 space-x-2 focus:outline-none">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21V3m4 18V3m-8 18V3"></path>
                </svg>
                <span>Payment Info</span>
            </div>
            <svg :class="{'rotate-90': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Submodule Links (Hidden by Default) -->
        <div x-show="open" class="ml-6 mt-2 space-y-2 ms-5" x-collapse>
            <a href="{{ route('admin.payment_info.client_info')}}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                <span>Client</span>
            </a>
            <a href="{{ route('admin.payment_info.investor_info')}}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                <span>Investor</span>
            </a>
        </div>
    </div>

    <a href="{{ route('admin.client') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A5 5 0 0112 20a5 5 0 016.879-2.196M12 14a4 4 0 110-8 4 4 0 010 8z"></path>
        </svg>
        <span>Client</span>
    </a>

    <a href="{{ route('admin.investor') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21V3m4 18V3m-8 18V3"></path>
        </svg>
        <span>Investor</span>
    </a>

    <div class="mt-auto">
        <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-red-600 space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"></path>
            </svg>
            <span>Sign out</span>
        </a>
    </div>
</nav>