<x-layout title="Edit Transaction">
    <div class="flex justify-center">
        <div class="bg-base-200 rounded shadow p-6 max-w-lg w-full">
            <form action="{{ route('transactions.update', $transaction) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Title</label>
                    <input type="text" name="title" value="{{ old('title', $transaction->title) }}"
                        class="w-full border rounded px-3 py-2" required>
                    @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Amount</label>
                    <input type="number" step="0.01" name="amount" value="{{ old('amount', $transaction->amount) }}"
                        class="w-full border rounded px-3 py-2" required>
                    @error('amount')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Type</label>
                    <select name="type" class="w-full border rounded px-3 py-2" required>
                        <option value="income" {{ old('type', $transaction->type) === 'income' ? 'selected' : '' }}>Income
                        </option>
                        <option value="expense" {{ old('type', $transaction->type) === 'expense' ? 'selected' : '' }}>
                            Expense
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Category</label>
                    <select name="category_id" class="w-full border rounded px-3 py-2" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }} ({{ $category->type }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Date</label>

                    <!-- Trigger Button using Anchor Positioning -->
                    <button type="button" popovertarget="cally-popover1"
                        class="input input-bordered w-full text-left flex items-center justify-between" id="cally1"
                        style="anchor-name:--cally1">
                        {{ old('date', date('Y-m-d')) }}
                    </button>

                    <!-- Hidden Input for Form Submission -->
                    <input type="hidden" id="date-input" name="date" value="{{ old('date', date('Y-m-d')) }}" required>

                    <!-- Popover Calendar Container -->
                    <div popover id="cally-popover1" class="dropdown bg-base-100 rounded-box shadow-lg p-2 mt-1"
                        style="position-anchor:--cally1">
                        <calendar-date id="cally-calendar" class="cally" value="{{ old('date', date('Y-m-d')) }}">
                            <svg aria-label="Previous" class="fill-current size-4" slot="previous"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M15.75 19.5 8.25 12l7.5-7.5"></path>
                            </svg>
                            <svg aria-label="Next" class="fill-current size-4" slot="next"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
                            </svg>
                            <calendar-month></calendar-month>
                        </calendar-date>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-1 font-medium">Note (optional)</label>
                        <textarea name="note" rows="3"
                            class="w-full border rounded px-3 py-2">{{ old('note', $transaction->note) }}</textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Update Transaction
                        </button>
                        <a href="{{ route('transactions.index') }}" class="px-4 py-2 border rounded">Cancel</a>
                    </div>
            </form>
        </div>
    </div>
</x-layout>