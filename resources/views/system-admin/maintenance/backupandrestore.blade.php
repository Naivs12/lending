@extends('layout.system-admin')
@section('title', 'Maintenance | Backup and Restore')

@section('content')
    <div class="m-6 h-full">
        <form method="POST" action="{{ route('system-admin.maintenance.backup') }}">
            @csrf

            <label for="table_name" class="block text-sm font-medium text-gray-700 mb-2">Select a Table</label>
            <select name="table_name" id="table_name"
                class="block w-[20%] px-3 py-2 border border-gray-300 bg-white text-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mb-4">
                @foreach($tableArr as $table)
                    <option value="{{ $table['table'] ?? $table->table }}">{{ $table['table'] ?? $table->table }}</option>
                @endforeach
            </select>

            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Backup
            </button>
        </form>
    </div>

    <script>
        const tableArr = @json($tableArr);
        console.log("tableArr:", tableArr);
    </script>
@endsection
