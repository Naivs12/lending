@extends('layout.login')
@section('title','Login')

@section('content')
<div class="w-full max-w-sm border-2 border-gray-300 rounded-lg p-6 bg-white shadow-lg">
    <div class="text-center">
        <img class="mx-auto h-20 w-auto mb-4" src="{{ asset('storage/images/logo.png') }}" alt="Your Company">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">SIGN IN</h2>
    </div>

    {{-- Show error message for invalid credentials --}}
    @if(session('error'))
        <div class="mt-4 text-sm text-center text-red-600 bg-red-100 border border-red-400 rounded-md p-2">
            {{ session('error') }}
        </div>
    @endif

    <form class="mt-6 space-y-6" action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="username" class="block text-sm font-medium text-gray-900">Username</label>
            <input type="text" name="username" id="username" required class="mt-1 block w-full rounded-md px-3 py-2 text-base text-gray-900 outline outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
            <input type="password" name="password" id="password" required class="mt-1 block w-full rounded-md px-3 py-2 text-base text-gray-900 outline outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600">
        </div>

        {{-- Show Password Checkbox --}}
        <div class="flex items-center">
            <input id="showPassword" type="checkbox" class="mr-2 h-4 w-4 text-indigo-600 border-gray-300 rounded">
            <label for="showPassword" class="text-sm text-gray-700">Show Password</label>
        </div>

        {{-- Button: green bg, yellow on hover --}}
        <button type="submit" class="w-full rounded-md px-3 py-2 text-sm font-semibold text-white transition duration-200"
            style="background-color: #028051;"
            onmouseover="this.style.backgroundColor='#e7bb34'"
            onmouseout="this.style.backgroundColor='#028051'">
            Sign in
        </button>

    </form>
</div>

{{-- Password Toggle Script --}}
<script>
    document.getElementById('showPassword').addEventListener('change', function () {
        const passwordInput = document.getElementById('password');
        passwordInput.type = this.checked ? 'text' : 'password';
    });
</script>
@endsection
