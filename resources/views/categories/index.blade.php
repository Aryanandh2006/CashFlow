<x-layout title="Categories">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Your Categories</h1>
        <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            + Add Category
        </a>
    </div>

    <div class="bg-base-100 rounded shadow overflow-scroll">
        <table class="w-full">
            <thead class="bg-base-100">
                <tr>
                    <th class="text-left px-6 py-3">Name</th>
                    <th class="text-left px-6 py-3">Type</th>
                    <th class="text-right px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $category->name }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 text-sm rounded 
                                                    {{ $category->type === 'income' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($category->type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('categories.edit', $category) }}"
                                class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                            No categories yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>