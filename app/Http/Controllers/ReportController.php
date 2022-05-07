<?php

namespace App\Http\Controllers;

use App\Models\Category;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $begin = new DateTime(request('start'));
        $end = new DateTime(request('end'));

        $end->modify('+1 month');
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($begin, $interval, $end);

        $categories = Category::all();

        return view('report.index', compact('categories', 'period'));
    }

    public function transactions()
    {
        $start = request('start');
        $end = request('end');

        $reports = DB::table('transaction_details')
            ->join('accounts', 'transaction_details.id_account', '=', 'accounts.id')
            ->join('transactions', 'transaction_details.id_transaction', '=', 'transactions.id')
            ->whereBetween(DB::raw('DATE(transaction_details.created_at)'), [$start, $end])
            ->orderBy('transaction_details.created_at', 'asc')
            ->get();

        return view('report.transaction', compact('reports'));
    }
}
