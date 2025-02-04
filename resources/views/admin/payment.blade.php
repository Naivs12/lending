@extends('layout.admin')
@section('title', 'Loan | Payment')

@section('content')
<div class="bg-gray-100 flex items-center justify-center p-4" id="main_content">
    <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-[1000px] h-[600px] overflow-hidden mt-3">
        <div class="card-container relative overflow-x-auto overflow-y-auto h-full">
            <p class="fs-2 fw-bold text-center mb-4">Payment</p>
            <!-- <form action="/submit" method="POST" class="space-y-3">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label for="first_name" class="text-gray-700 font-medium">Name</label>
                        <input type="text" id="first_name" name="first_name" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div class="flex flex-col">
                        <label for="middle_name" class="text-gray-700 font-medium">Amount</label>
                        <input type="number" id="middle_name" name="middle_name" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>
            </form> -->
            
        </div>
    </div>
</div>
@endsection
