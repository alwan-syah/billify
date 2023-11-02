<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use App\Models\BillType;

class DashboardController extends Controller
{
	public function index()
	{
		$totalBills = Bills::count();
		$sumTotalPaid = Bills::sum('total_paid');
		$totalBillTypes = BillType::count();

		return view('pages.dashboard', compact('totalBills', 'totalBillTypes', 'sumTotalPaid'));
	}
}
