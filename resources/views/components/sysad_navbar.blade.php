<nav class="w-64 bg-[#028051] text-white flex flex-col p-4 space-y-4">
    <div class="flex justify-center items-center mx-4 my-4">
        <img class="h-20 w-auto" src="{{ asset('storage/images/logo.png') }}" alt="JLC">
    </div>

    <!-- Loan Module with Clickable Toggle -->
    <div x-data="{ open: {{ Request::routeIs('system-admin.loan.*') ? 'true' : 'false' }} }">
        <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 space-x-2 focus:outline-none">
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
    <div x-data="{ open: {{ Request::routeIs('system-admin.payment_info.*') ? 'true' : 'false' }} }">
        <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 space-x-2 focus:outline-none">
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
            <a href="{{ route('system-admin.payment_info.client_info') }}" class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300">
                <span>Client</span>
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300">
                <span>Investor</span>
            </a>
        </div>
    </div>

    <!-- Client Link -->
    <a href="{{ route('system-admin.client') }}" class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 space-x-2 {{ Request::routeIs('system-admin.client') ? 'bg-yellow-300' : '' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A5 5 0 0112 20a5 5 0 016.879-2.196M12 14a4 4 0 110-8 4 4 0 010 8z"></path>
        </svg>
        <span>Client</span>
    </a>

    <!-- Investor Link -->
    <a href="{{ route('system-admin.investor') }}" class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 space-x-2 {{ Request::routeIs('system-admin.investor') ? 'bg-yellow-300' : '' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21V3m4 18V3m-8 18V3"></path>
        </svg>
        <span>Investor</span>
    </a>

    <div x-data="{ open: {{ Request::routeIs('system-admin.maintenance.*') ? 'true' : 'false' }} }">
    <!-- Parent Menu -->
    <button @click="open = !open" class="flex items-center px-4 py-2">
        <span>Maintenance</span>
    </button>

    <!-- Submodule Links -->
    <div x-show="open" class="ml-6 mt-2 space-y-2 ms-5" x-collapse>
        <a href="{{ route('system-admin.maintenance.users') }}"
           class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 {{ Request::routeIs('system-admin.maintenance.users') ? 'bg-yellow-300' : '' }}">
            <span>Users</span>
        </a>
        <a href="{{ route('system-admin.maintenance.branch') }}"
           class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 {{ Request::routeIs('system-admin.maintenance.branch') ? 'bg-yellow-300' : '' }}">
            <span>Branch</span>
        </a>
        <a href="{{ route('system-admin.maintenance.archive') }}"
           class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 {{ Request::routeIs('system-admin.maintenance.other') ? 'bg-yellow-300' : '' }}">
            <span>Archive</span>
        </a>
        <a href="{{ route('system-admin.maintenance.backup-and-restore') }}"
           class="flex items-center px-3 py-2 rounded-md bg-[#028051] hover:bg-yellow-300 active:bg-yellow-300 {{ Request::routeIs('system-admin.maintenance.other') ? 'bg-yellow-300' : '' }}">
            <span>Backup and Restore</span>
        </a>
    </div>
</div>


    <!-- Sign Out -->
    <div class="mt-auto">
        <a href="#" class="flex items-center px-3 py-2 rounded-md bg-red-600 hover:bg-red-700 active:bg-red-800 space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H3"></path>
            </svg>
            <span>Sign Out</span>
        </a>
    </div>
</nav>
