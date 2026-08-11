<x-layout>
    <x-slot:title>Dashboard</x-slot:title>


    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-base-200 p-6 rounded shadow">
            <h3 class="text-gray-500 text-sm">Balance</h3>
            <p class="text-2xl font-bold">€{{ number_format($balance, 2) }}</p>
        </div>
        <div class="bg-base-200 p-6 rounded shadow">
            <h3 class="text-gray-500 text-sm">Income</h3>
            <p class="text-2xl font-bold text-green-600">€{{ number_format($income, 2) }}</p>
        </div>
        <div class="bg-base-200 p-6 rounded shadow">
            <h3 class="text-gray-500 text-sm">Expense</h3>
            <p class="text-2xl font-bold text-red-600">€{{ number_format($expense, 2) }}</p>
        </div>
    </div>

    <div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="bg-base-200 p-6 rounded shadow">
                <div id="chart" data-labels="{{ json_encode($charts['trend']['labels']) }}"
                    data-income="{{ json_encode($charts['trend']['income']) }}"
                    data-expense="{{ json_encode($charts['trend']['expense']) }}">
                </div>

            </div>

            <div class="bg-base-200 rounded shadow p-6">
                <div class="mb-6">
                    <div class="inline justify-start">
                        <a href="{{ route('transactions.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            + Add Transaction
                        </a>
                    </div>


                </div>
                <h2 class="text-xl font-semibold mb-4">Recent Transactions</h2>
                <div class="flex justify-end mt-4">
                    <a href="/transactions" class="text-sm">View all <i class="fa-solid fa-arrow-right"></i></a>
                </div>

                @forelse($recentTransactions as $transaction)
                    <div class="flex justify-between items-center border-b py-3">
                        <div>
                            <p class="font-medium">{{ $transaction->title }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $transaction->category->name ?? 'No Category' }} ·
                                {{ $transaction->date->format('d M Y') }}
                            </p>
                        </div>
                        <div
                            class="font-semibold {{ $transaction->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transaction->type === 'income' ? '+' : '-' }}€{{ number_format($transaction->amount, 2) }}
                        </div>
                    </div>

                @empty
                    <p class="text-gray-500">No transactions yet.</p>
                @endforelse

            </div>
        </div>
    </div>

</x-layout>