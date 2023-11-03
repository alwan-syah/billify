<?php

namespace App\Http\Controllers\Pages;

use App\Models\BillType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class BillTypeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$model = BillType::with('bill')->latest();
			return DataTables::of($model)
				->addColumn('actions', function ($model) use ($request) {
					$id = $model->id;
					$link = $request->url() . '/' . $id;
					return '
						<div class="d-flex align-items-center justify-content-center">
							<a href="" data-delete-url="' . $link . '" class="btn btn-danger btn-sm mx-2 delete-data" data-bs-toggle="modal" data-bs-target="#deleteModal"><span class="bi bi-trash-fill"></span></a>
						</div>
					';
				})
				->addColumn('total_item', function ($model) use ($request) {
					return $model->bill->count();
				})
				->rawColumns(['actions'])
				->make(true);
		}

		return view('pages.bill_type.list');
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('pages.bill_type.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string'
		]);

		$data = $request->all();

		BillType::create($data);

		return to_route('jenis-pembayaran.index')->with('success', 'Berhasil membuat jenis pembayaran');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$type = BillType::findOrFail($id);

		if ($type->bill->count() > 0) {
			return to_route('jenis-pembayaran.index')->with('warning', 'Ga bisa dihapus karena ada data pembayaran yang berkaitan.');
		}

		$type->delete();

		return to_route('jenis-pembayaran.index')->with('danger', 'Jenis pembayaran udah dihapus.');
	}
}
