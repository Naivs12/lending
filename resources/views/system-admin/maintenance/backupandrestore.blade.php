@extends('layout.system-admin')
@section('title', 'Maintenance | Backup and Restore')

@section('content')
    <div class="m-6 h-full relative">

        {{-- Backup Form --}}
        <form method="POST" action="{{ route('system-admin.maintenance.backup') }}">
            @csrf

            <label for="table_name" class="block text-sm font-medium text-gray-700 mb-2">Select a Table</label>
            <select name="table_name" id="table_name"
                class="block w-[20%] px-3 py-2 border border-gray-300 bg-white text-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mb-4"
                style="z-index: 10; pointer-events: auto;">
                @foreach($tableArr as $table)
                    <option value="{{ $table['table'] ?? $table->table }}">{{ $table['table'] ?? $table->table }}</option>
                @endforeach
            </select>

            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Backup
            </button>
        </form>

        {{-- Restore Form --}}
        <form method="POST" action="{{ route('system-admin.maintenance.restore') }}" enctype="multipart/form-data" class="mt-10">
            @csrf

            <label for="restore_table_name" class="block text-sm font-medium text-gray-700 mb-2">Select Table to Restore</label>
            <select name="table" id="restore_table_name"
                class="block w-[20%] px-3 py-2 border border-gray-300 bg-white text-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mb-4">
                @foreach($tableArr as $table)
                    <option value="{{ $table['table'] ?? $table->table }}">{{ $table['table'] ?? $table->table }}</option>
                @endforeach
            </select>

            <label for="sql_file" class="block text-sm font-medium text-gray-700 mb-2">Upload SQL File</label>
            <input type="file" name="file" id="sql_file" accept=".sql"
                class="block w-[40%] px-3 py-2 border border-gray-300 bg-white text-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mb-4" required />

            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Restore
            </button>
        </form>

        @if(session('success'))
            <div class="text-green-600 font-semibold mt-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="text-red-600 font-semibold mt-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <script>
        const tableArr = @json($tableArr);
        console.log("tableArr:", tableArr);
    </script>
@endsection
