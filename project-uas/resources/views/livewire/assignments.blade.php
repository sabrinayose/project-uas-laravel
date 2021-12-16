<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Assignment
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <button wire:click="create()" class="border border-gray-500 text-black font-bold py-2 px-4 rounded my-3">Create New Assignment</button>
            @if($isOpen)
                @include('livewire.createAssignment')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Assignment Name</th>
                        <th class="px-4 py-2">Progress (%)</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignments as $assignment)
                    <tr>
                        <td class="border px-4 py-2">{{ $assignment->id }}</td>
                        <td class="border px-4 py-2">{{ $assignment->assignmentName }}</td>
                        <td class="border px-4 py-2">{{ $assignment->progress }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $assignment->id }})" class="bg-blue-500 hover:bg-blue-700 border border-gray-500 text-black font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $assignment->id }})" class="bg-red-500 hover:bg-red-700 border border-gray-500 text-black font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>