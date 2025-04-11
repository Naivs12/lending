<nav class="w-64 bg-[#028051] text-white flex flex-col p-4 space-y-4 h-screen">
    <div class="flex justify-center items-center mx-4 my-4">
        <img class="h-20 w-auto" src="{{ asset('storage/images/logo.png') }}" alt="JLC">
    </div>

    <!-- Loan Module -->
    <div x-data="{ open: {{ Request::routeIs('admin.loan.*') ? 'true' : 'false' }} }"> <!-- Open when the Loan routes are active -->
        <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-yellow-300 space-x-2 focus:outline-none">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21V3m4 18V3m-8 18V3"></path>
                </svg>
                <span>Loan</span>
            </div>
            <svg :class="{'rotate-90': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <div x-show="open" class="ml-6 mt-2 space-y-2 ms-5" x-collapse>
            <a href="{{route('admin.loan.loan')}}" class="flex items-center px-3 py-2 rounded-md hover:bg-yellow-300 {{ Request::routeIs('admin.loan.loan') ? 'bg-yellow-300' : '' }}">
                <span>Loan</span>
            </a>
            <a href="{{route('admin.loan.release')}}" class="flex items-center px-3 py-2 rounded-md hover:bg-yellow-300 {{ Request::routeIs('admin.loan.release') ? 'bg-yellow-300' : '' }}">
                <span>Release</span>
            </a>
            <a href="{{route('admin.loan.review')}}" class="flex items-center px-3 py-2 rounded-md hover:bg-yellow-300 {{ Request::routeIs('admin.loan.review') ? 'bg-yellow-300' : '' }}">
                <span>Review</span>
            </a>
        </div>
    </div>

    <!-- Payment Info -->
    <div x-data="{ open: {{ Request::routeIs('admin.payment_info.*') ? 'true' : 'false' }} }"> <!-- Open when the Payment Info routes are active -->
        <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-yellow-300 space-x-2 focus:outline-none">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21V3m4 18V3m-8 18V3"></path>
                </svg>
                <span>Payment Info</span>
            </div>
            <svg :class="{'rotate-90': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <div x-show="open" class="ml-6 mt-2 space-y-2 ms-5" x-collapse>
            <a href="{{ route('admin.payment_info.client_info')}}" class="flex items-center px-3 py-2 rounded-md hover:bg-yellow-300 {{ Request::routeIs('admin.payment_info.client_info') ? 'bg-yellow-300' : '' }}">
                <span>Client</span>
            </a>
            <a href="{{ route('admin.payment_info.investor_info')}}" class="flex items-center px-3 py-2 rounded-md hover:bg-yellow-300 {{ Request::routeIs('admin.payment_info.investor_info') ? 'bg-yellow-300' : '' }}">
                <span>Investor</span>
            </a>
        </div>
    </div>

    <!-- Client Link -->
    <a href="{{ route('admin.client') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-yellow-300 space-x-2 {{ Request::routeIs('admin.client') ? 'bg-yellow-300' : '' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A5 5 0 0112 20a5 5 0 016.879-2.196M12 14a4 4 0 110-8 4 4 0 010 8z"></path>
        </svg>
        <span>Client</span>
    </a>

    <!-- Investor Link -->
    <a href="{{ route('admin.investor') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-yellow-300 space-x-2 {{ Request::routeIs('admin.investor') ? 'bg-yellow-300' : '' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21V3m4 18V3m-8 18V3"></path>
        </svg>
        <span>Investor</span>
    </a>

    <!-- Sign out -->
    <div class="mt-auto">
        <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-red-600 space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"></path>
            </svg>
            <span>Sign out</span>
        </a>
    </div>
</nav>
