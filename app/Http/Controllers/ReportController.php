<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $start_year = substr(request('start'), 0, 4);
        $end_year = substr(request('end'), 0, 4);

        $start_month = substr(request('start'), 5, 2);
        $end_month = substr(request('end'), 5, 2);

        $reports = DB::table('transaction_details')
            ->select(DB::raw("categories.name as category,
            accounts.name as account,
            sum(debit) as income,
            sum(credit) as expense,
            DATE_FORMAT(transaction_details.created_at, '%Y-%m') as month"))
            ->join('accounts', 'transaction_details.id_account', '=', 'accounts.id')
            ->join('categories', 'accounts.id_category', '=', 'categories.id')
            ->whereBetween(DB::raw('MONTH(transaction_details.created_at)'), [$start_month, $end_month])
            ->whereBetween(DB::raw('YEAR(transaction_details.created_at)'), [$start_year, $end_year])
            ->groupBy('category', 'month')
            ->get();

        return view('report.index', compact('reports'));
    }

    public function transactions()
    {
        $start = request('start');
        $end = request('end');

        $reports = DB::table('transaction_details')
            ->join('accounts', 'transaction_details.id_account', '=', 'accounts.id')
            ->join('transactions', 'transaction_details.id_transaction', '=', 'transactions.id')
            ->whereBetween(DB::raw('DATE(transaction_details.created_at)'), [$start, $end])
            ->get();

        return view('report.transaction', compact('reports'));
    }
}
