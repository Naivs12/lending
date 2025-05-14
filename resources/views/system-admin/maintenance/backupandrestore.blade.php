@extends('layout.system-admin')
@section('title', 'Maintenance | Backup and Restore')

@section('content')
    <div class="m-6 h-full relative">
        <div class="mb-4">
            <h1 class="text-3xl font-bold mb-1">BACKUP AND RESTORE</h1>
            <div class="w-full bg-gray-500 h-1 rounded-full"></div>
        </div> 

        {{-- Backup and Restore Containers --}}
        <div class="flex space-x-6">
            {{-- Backup Container --}}
            <div class="w-1/2 bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4 text-center">Backup</h2>
                <form method="POST" action="{{ route('system-admin.maintenance.backup') }}">
                    @csrf

                    <label for="table_name" class="block text-sm font-medium text-gray-700 mb-2">Select a Table</label>
                    <select name="table_name" id="table_name"
                        class="block w-full px-3 py-2 border border-gray-300 bg-white text-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mb-4">
                        @foreach($tableArr as $table)
                            <option value="{{ $table['table'] ?? $table->table }}">{{ $table['table'] ?? $table->table }}</option>
                        @endforeach
                    </select>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Backup
                        </button>
                    </div>
                </form>
            </div>

            {{-- Restore Container --}}
            <div class="w-1/2 bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4 text-center">Restore</h2>
                <form method="POST" action="{{ route('system-admin.maintenance.restore') }}" enctype="multipart/form-data">
                    @csrf

                    <label for="restore_table_name" class="block text-sm font-medium text-gray-700 mb-2">Select Table to Restore</label>
                    <select name="table" id="restore_table_name"
                        class="block w-full px-3 py-2 border border-gray-300 bg-white text-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mb-4">
                        @foreach($tableArr as $table)
                            <option value="{{ $table['table'] ?? $table->table }}">{{ $table['table'] ?? $table->table }}</option>
                        @endforeach
                    </select>

                    <label for="sql_file" class="block text-sm font-medium text-gray-700 mb-2">Upload SQL File</label>
                    <input type="file" name="file" id="sql_file" accept=".sql"
                        class="block w-full px-3 py-2 border border-gray-300 bg-white text-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mb-4" required />

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Restore
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Success/Error Messages --}}
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
@endsection
