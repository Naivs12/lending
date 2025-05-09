<nav class="w-64 bg-[#028051] text-white flex flex-col p-4 space-y-4">
    <div class="flex justify-center items-center mx-4 my-4">
        <img class="h-20 w-auto" src="{{ asset('storage/images/logo.png') }}" alt="JLC">
    </div>

    <!-- Alpine.js State Management -->
    <div x-data="{ openMenu: 
        @if(Request::routeIs('system-admin.loan.loan') || Request::routeIs('system-admin.loan.release') || Request::routeIs('system-admin.loan.review')) 
            1 
        @elseif(Request::routeIs('system-admin.payment_info.client_info') || Request::routeIs('system-admin.payment_info.investor_info')) 
            2 
        @elseif(Request::routeIs('system-admin.maintenance.users') || Request::routeIs('system-admin.maintenance.branch') || Request::routeIs('system-admin.maintenance.archive') || Request::routeIs('system-admin.maintenance.backup-and-restore')) 
            3 
        @else 
            null 
        @endif 
    }">
        <!-- Loan Module -->
        <div>
            <button @click="openMenu = openMenu === 1 ? null : 1" class="mb-2 flex items-center justify-between w-full px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 space-x-2 focus:outline-none">
                <div class="flex items-center space-x-2">
                   
                    <span>Loan</span>
                </div>
                <svg :class="{'rotate-90': openMenu === 1}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <div x-show="openMenu === 1" class="ml-6 mt-2 space-y-2 ms-5 mb-2" x-collapse>
                <a href="{{route('system-admin.loan.loan')}}" class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 {{ Request::routeIs('system-admin.loan.loan') ? 'bg-yellow-300' : '' }}">
                    <span>Loan</span>
                </a>
                <a href="{{route('system-admin.loan.release')}}" class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 {{ Request::routeIs('system-admin.loan.release') ? 'bg-yellow-300' : '' }}">
                    <span>Release</span>
                </a>
                <a href="{{route('system-admin.loan.review')}}" class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 {{ Request::routeIs('system-admin.loan.review') ? 'bg-yellow-300' : '' }}">
                    <span>Review</span>
                </a>
            </div>
        </div>

        <!-- Payment Info -->
        <div>
            <button @click="openMenu = openMenu === 2 ? null : 2" class=" mb-2 flex items-center justify-between w-full px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 space-x-2 focus:outline-none">
                <div class="flex items-center space-x-2">
                    <span>Payment Info</span>
                </div>
                <svg :class="{'rotate-90': openMenu === 2}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <div x-show="openMenu === 2" class="mb-2 ml-6 mt-2 space-y-2 ms-5" x-collapse>
                <a href="{{ route('system-admin.payment_info.client_info') }}" class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 {{ Request::routeIs('system-admin.payment_info.client_info') ? 'bg-yellow-300' : '' }}">
                    <span>Client</span>
                </a>
                <a href="#" class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 {{ Request::routeIs('system-admin.payment_info.investor_info') ? 'bg-yellow-300' : '' }}">
                    <span>Investor</span>
                </a>
            </div>
        </div>

        <!-- Client Link -->
        <a href="{{ route('system-admin.client') }}" class="mb-2 flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 space-x-2 {{ Request::routeIs('system-admin.client') ? 'bg-yellow-300' : '' }}">
            <span>Client</span>
        </a>

        <!-- Investor Link -->
        <a href="{{ route('system-admin.investor') }}" class="mb-2 flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 space-x-2 {{ Request::routeIs('system-admin.investor') ? 'bg-yellow-300' : '' }}">
            <span>Investor</span>
        </a>

        <!-- Maintenance -->
        <div>
            <button @click="openMenu = openMenu === 3 ? null : 3" class="mb-2 flex items-center justify-between w-full px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 space-x-2 focus:outline-none">
                <div class="flex items-center space-x-2">
                    <span>Maintenance</span>
                </div>
                <svg :class="{'rotate-90': openMenu === 3}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <div x-show="openMenu === 3" class="mb-2 ml-6 mt-2 space-y-2 ms-5" x-collapse>
                <a href="{{ route('system-admin.maintenance.users') }}" class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 {{ Request::routeIs('system-admin.maintenance.users') ? 'bg-yellow-300' : '' }}">
                    <span>Users</span>
                </a>
                <a href="{{ route('system-admin.maintenance.branch') }}" class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 {{ Request::routeIs('system-admin.maintenance.branch') ? 'bg-yellow-300' : '' }}">
                    <span>Branch</span>
                </a>
                <a href="{{ route('system-admin.maintenance.archive') }}" class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 {{ Request::routeIs('system-admin.maintenance.archive') ? 'bg-yellow-300' : '' }}">
                    <span>Archive</span>
                </a>
                <a href="{{ route('system-admin.maintenance.backup-and-restore') }}" class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 {{ Request::routeIs('system-admin.maintenance.backup-and-restore') ? 'bg-yellow-300' : '' }}">
                    <span>Backup and Restore</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Sign Out -->
    <div class="mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center px-3 py-2 rounded-md bg-red-600 hover:bg-red-700 active:bg-red-800 space-x-2 w-full">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H3"></path>
                </svg>
                <span>Sign Out</span>
            </button>
        </form>
    </div>
</nav>
