<x-layout title="Transactions">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Your Transactions</h1>
        <a href="{{ route('transactions.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            + Add Transaction
        </a>
    </div>

    {{-- Simple Search --}}
    <form method="GET" class="mb-6 flex gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search transactions..."
            class="border rounded px-3 py-2 w-64">
        <select name="type" class="border rounded px-3 py-2">
            <option value="">All Types</option>
            <option value="income" {{ request('type') === 'income' ? 'selected' : '' }}>Income</option>
            <option value="expense" {{ request('type') === 'expense' ? 'selected' : '' }}>Expense</option>
        </select>
        <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <div class="bg-base-100 rounded shadow overflow-scroll">
        <table class="w-full">
            <thead class="bg-base-100">
                <tr>
                    <th class="text-left px-6 py-3">Date</th>
                    <th class="text-left px-6 py-3">Title</th>
                    <th class="text-left px-6 py-3">Category</th>
                    <th class="text-left px-6 py-3">Type</th>
                    <th class="text-right px-6 py-3">Amount</th>
                    <th class="text-right px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $transaction->date->format('d M Y') }}</td>
                        <td class="px-6 py-4">{{ $transaction->title }}</td>
                        <td class="px-6 py-4">{{ $transaction->category->name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 text-sm rounded 
                                                                        {{ $transaction->type === 'income' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($transaction->type) }}
                            </span>
                        </td>
                        <td
                            class="px-6 py-4 text-right font-medium 
                                                                    {{ $transaction->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transaction->type === 'income' ? '+' : '-' }}€{{ number_format($transaction->amount, 2) }}
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('transactions.edit', $transaction) }}"
                                class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            No transactions found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
</x-layout>