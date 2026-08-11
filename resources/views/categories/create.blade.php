<x-layout title="Add Category">
    <div class="flex justify-center">
        <div class="bg-base-200 rounded shadow p-6 max-w-lg w-full">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2"
                        required>
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-1 font-medium">Type</label>
                    <select name="type" class="select select-bordered w-full border rounded px-3 py-2" required>
                        <option value="">Select type</option>
                        <option value="income" {{ old('type') === 'income' ? 'selected' : '' }}>Income</option>
                        <option value="expense" {{ old('type') === 'expense' ? 'selected' : '' }}>Expense</option>
                    </select>
                    @error('type')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Save Category
                    </button>
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 border rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>