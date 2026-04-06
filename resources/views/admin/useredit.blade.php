<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">System Role</label>
                        <select name="role" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.usermanagement') }}" class="text-gray-600 hover:underline text-sm">Cancel</a>
                        <button type="submit" class="bg-indigo-600 text-black px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                            Save Changes
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>