<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $users = User::all()->count();
        $categories = Category::all()->count();
        $accounts = Account::all()->count();
        $transactions = Transaction::all()->count();
        $transactions_today = Transaction::whereDate('created_at', today())->where('id_user', auth()->user()->id)->count();
        $total_expense = DB::table('transaction_details')->where(DB::raw('YEAR(created_at)'), date('Y'))->sum('credit');

        $income_chart = DB::table('transaction_details')
            ->selectRaw('month(created_at) as created_at, sum(debit) as debit')
            ->where(DB::raw('YEAR(created_at)'), date('Y'))
            ->groupByRaw('month(created_at)')
            ->get();


        $income_chart_value = $income_chart->pluck('debit')->toArray();
        $income_chart_label = $income_chart->pluck('created_at')->map(function ($date) {
            return $this->MonthNumberToMonthName($date);
        })->toArray();

        $expense_chart = DB::table('transaction_details')
            ->selectRaw('month(created_at) as created_at, sum(credit) as credit')
            ->where(DB::raw('YEAR(created_at)'), date('Y'))
            ->groupByRaw('month(created_at)')
            ->get();


        $expense_chart_value = $expense_chart->pluck('credit')->toArray();
        $expense_chart_label = $expense_chart->pluck('created_at')->map(function ($date) {
            return $this->MonthNumberToMonthName($date);
        })->toArray();

        return view('dashboard.index', compact(
            'users',
            'categories',
            'accounts',
            'transactions',
            'transactions_today',
            'total_expense',
            'income_chart_value',
            'income_chart_label',
            'expense_chart_value',
            'expense_chart_label'
        ));
    }

    private function MonthNumberToMonthName($monthNumber)
    {
        $monthName = '';
        switch ($monthNumber) {
            case 1:
                $monthName = 'Januari';
                break;
            case 2:
                $monthName = 'Februari';
                break;
            case 3:
                $monthName = 'Maret';
                break;
            case 4:
                $monthName = 'April';
                break;
            case 5:
                $monthName = 'Mei';
                break;
            case 6:
                $monthName = 'Juni';
                break;
            case 7:
                $monthName = 'Juli';
                break;
            case 8:
                $monthName = 'Agustus';
                break;
            case 9:
                $monthName = 'September';
                break;
            case 10:
                $monthName = 'Oktober';
                break;
            case 11:
                $monthName = 'November';
                break;
            case 12:
                $monthName = 'Desember';
                break;
        }
        return $monthName;
    }
}
