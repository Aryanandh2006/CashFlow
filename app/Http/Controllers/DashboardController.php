<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DatePeriod;
use DateInterval;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        // 1. Calculate Summary (MySQL Compatible)
        $income = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $expense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $balance = $income - $expense;

        // 2. Fetch Recent Transactions
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->with('category')
            ->latest('date')
            ->take(8)
            ->get();

        // 3. Fetch Monthly Dataset for Trend Processing
        $monthlyTransactions = Transaction::where('user_id', $user->id)
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->get();

        $trendLabels = [];
        $trendIncome = [];
        $trendExpense = [];

        // 4. Generate Complete Month Array (Fills in days with 0 transactions)
        $period = new DatePeriod($startOfMonth, new DateInterval('P1D'), $endOfMonth->copy()->addDay());
        foreach ($period as $date) {
            $dayLabel = $date->format('d M');
            $trendLabels[] = $dayLabel;
            $trendIncome[$dayLabel] = 0;
            $trendExpense[$dayLabel] = 0;
        }

        // 5. Populate Data Map
        foreach ($monthlyTransactions as $transaction) {
            $dayLabel = Carbon::parse($transaction->date)->format('d M');
            if (isset($trendIncome[$dayLabel])) {
                if ($transaction->type === 'income') {
                    $trendIncome[$dayLabel] += (float) $transaction->amount;
                } else {
                    $trendExpense[$dayLabel] += (float) $transaction->amount;
                }
            }
        }

        $charts = [
            'trend' => [
                'labels' => $trendLabels,
                'income' => array_values($trendIncome),
                'expense' => array_values($trendExpense),
            ]
        ];

        return view('dashboard', compact('income', 'expense', 'balance', 'recentTransactions', 'charts'));
    }
}
