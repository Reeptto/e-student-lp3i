@extends('layouts.app')

@section('content')
<div class="w-full">

    <!-- HEADER -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-indigoDye">Assignments</h2>
        <p class="text-sm text-gray-500">Upload & track your submitted tasks</p>
    </div>

    <!-- FILTER -->
    <div class="bg-white shadow-sm rounded-xl p-5 mb-6 border border-gray-100">
        <form method="GET" action="{{ route('tugas') }}" class="flex flex-col md:flex-row items-start md:items-center gap-4">
            
            <div class="w-full md:w-64">
                <label class="text-sm font-semibold text-gray-700 mb-1 block">Filter by Subject</label>
                <select name="matkul" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-viridian">
                    <option value="">— All Subjects —</option>
                    
                </select>
            </div>

            <button type="submit"
                class="px-5 py-2 bg-viridian text-white rounded-lg hover:bg-[#008c94] transition">
                Apply
            </button>

        </form>
    </div>

    <!-- LIST TUGAS -->
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
        
        <table class="w-full text-left">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">Subject</th>
                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">Title</th>
                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">Deadline</th>
                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">Action</th>
                </tr>
            </thead>

            <tbody>
                
            </tbody>

        </table>

    </div>

</div>
@endsection
