<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    
    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
        {{ session('error') }}
    </div>
@endif                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Registered Users</h3>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th class="px-6 py-3">ID</th>
            <th class="px-6 py-3">Name</th>
            <th class="px-6 py-3">Role</th> <th class="px-6 py-3">Email</th>
            <th class="px-6 py-3">Phone</th>
            <th class="px-6 py-3">Joined Date</th>
            <th class="px-6 py-3 text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr class="bg-white border-b hover:bg-gray-50 transition">
            <td class="px-6 py-4 font-medium text-gray-900">#{{ $user->id }}</td>
            <td class="px-6 py-4 text-gray-700">{{ $user->name }}</td>
            
            <td class="px-6 py-4">
                <span class="px-2 py-1 rounded text-xs font-bold uppercase
                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : '' }}
                    {{ $user->role === 'staff' ? 'bg-blue-100 text-blue-700' : '' }}
                    {{ $user->role === 'user' ? 'bg-gray-100 text-gray-700' : '' }}">
                    {{ $user->role ?? 'user' }}
                </span>
            </td>

            <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
            <td class="px-6 py-4 text-gray-600">{{ $user->phone ?? 'N/A' }}</td>
            <td class="px-6 py-4 text-gray-600">{{ $user->created_at->format('d M Y') }}</td>
            
<td class="px-6 py-4">
    <div class="flex items-center justify-center gap-3">
        <a href="{{ route('admin.postmanagement', ['user_id' => $user->id]) }}" 
   class="inline-flex items-center px-3 py-1.5 bg-amber-50 text-amber-700 border border-amber-200 rounded-md text-xs font-bold uppercase tracking-widest hover:bg-amber-600 hover:text-white transition-colors duration-200">
    Posts
</a>

        @if($user->id !== auth()->id())
            <a href="{{ route('admin.user.edit', $user->id) }}" 
               class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-md text-xs font-bold uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-colors duration-200">
                Edit
            </a>

            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 border border-red-200 rounded-md text-xs font-bold uppercase tracking-widest hover:bg-red-600 hover:text-white transition-colors duration-200">
                    Delete
                </button>
            </form>
        @else
            <span class="inline-flex items-center px-3 py-1.5 bg-green-50 text-green-700 border border-green-200 rounded-md text-[10px] font-black uppercase tracking-widest">
                Your Account
            </span>
        @endif
    </div>
</td>
        </tr>
        @endforeach
    </tbody>
</table>
                </div>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>