<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $income = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $expense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $balance = $income - $expense;


        $recentTransactions = Transaction::where('user_id', $user->id)
            ->with('category')
            ->latest('date')
            ->take(8)
            ->get();
            
        
        $dailyData = Transaction::where('user_id', $user->id)
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->selectRaw("strftime(date, '%d %b') as formatted_date, type, SUM(amount) as total")
            ->groupBy('formatted_date', 'type')
            ->orderBy('date')
            ->get();

        $monthlyTransactions = Transaction::where('user_id', $user->id)
        ->whereBetween('date', [$startOfMonth, $endOfMonth])
        ->get();

        $trendLabels = [];
        $trendIncome = [];
        $trendExpense = [];

        $period = new \DatePeriod($startOfMonth, new \DateInterval('P1D'), $endOfMonth->copy()->addDay());
            foreach ($period as $date) {
                $dayLabel = $date->format('d M');
                $trendLabels[] = $dayLabel;
                $trendIncome[$dayLabel] = 0;
                $trendExpense[$dayLabel] = 0;
            }

        foreach ($monthlyTransactions as $transaction) {
        $dayLabel = \Carbon\Carbon::parse($transaction->date)->format('d M');
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
