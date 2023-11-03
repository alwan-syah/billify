<?php

namespace App\Http\Controllers\Pages;

use App\Models\Bills;
use App\Models\BillType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class BillsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$model = Bills::with('billType')->latest();
			return DataTables::of($model)
				->addColumn('actions', function ($model) use ($request) {
					$id = $model->slug;
					$link = $request->url() . '/' . $id;
					return '
						<div class="d-flex align-items-center">
							<a href="' . route('pembayaran.edit', $id) . '" class="btn btn-primary btn-sm"><span class="bi bi-pencil-square"></span></a>
							<a href="" data-delete-url="' . $link . '" class="btn btn-danger btn-sm mx-2 delete-data" data-bs-toggle="modal" data-bs-target="#deleteModal"><span class="bi bi-trash-fill"></span></a>
						</div>
					';
				})
				->addColumn('bill_type', function ($model) use ($request) {
					return $model->billType->name;
				})
				->filterColumn('bill_type', function ($query, $keyword) {
					$query->whereHas('billType', function ($query) use ($keyword) {
						$query->where('name', 'like', '%' . $keyword . '%');
					});
				})
				->addColumn('total_paid', function ($model) use ($request) {
					return number_format($model->total_paid);
				})
				->addColumn('image', function ($model) use ($request) {
					if (filter_var($model->image, FILTER_VALIDATE_URL)) {
						return '
							<img src="' . $model->image . '" style="max-height:150px;">
							<a class="ml-2" href="' . $model->image . '" target="_blank">
								<i class="bi bi-eye-fill text-warning fs-5" title="Lihat gambar"></i>
							</a>
						';
					} else {
						return '
							<img src="' . asset('uploads/' . $model->image) . '" style="max-height:150px;">
							<a class="ml-2" href="' . asset('uploads/' . $model->image) . '" target="_blank">
								<i class="bi bi-eye-fill text-warning fs-5" title="Lihat gambar"></i>
							</a>
						';
					}
				})
				->addColumn('paid_date', function ($model) use ($request) {
					return Carbon::parse($model->paid_date)->format('d F Y');
				})
				->filterColumn('paid_date', function ($query, $keyword) {
					$query->where('paid_date', 'like', '%' . $keyword . '%');
				})
				->rawColumns(['actions', 'image'])
				->make(true);
		}

		return view('pages.bills.list');
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$billType = BillType::all();

		return view('pages.bills.create', compact('billType'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$request->validate(
			[
				'description' => 'required|string',
				'total_paid' => 'required|integer',
				'image' => 'sometimes|nullable|mimes:png,jpeg,jpg|max:350',
				'image_url' => 'sometimes|nullable|url',
				'paid_date' => 'required|date'
			],
			[
				'description.required' => 'Deskripsinya belum diisi nih.',
				'total_paid.required' => 'Jumlah yang dibayar belum diisi nih.',
				'paid_date.required' => 'Tanggal bayarnya belum diisi nih.',
			]
		);

		$data = $request->all();

		$data['slug'] = Str::slug($request->description);

		if ($request->hasFile('image')) {
			$data['image'] = $request->file('image')->store('images/bukti-bayar', 'public');
		} elseif ($request->filled('image_url')) {
			$data['image'] = $request->input('image_url');
		}

		Bills::create($data);

		return to_route('pembayaran.index')->with('success', 'Berhasil membuat data pembayaran');
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
		$bill = Bills::where('slug', $id)->firstOrFail();
		$billTypes = BillType::all();

		return view("pages.bills.edit", compact('bill', 'billTypes'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$request->validate(
			[
				'description' => 'required|string',
				'total_paid' => 'required|integer',
				'image' => 'sometimes|nullable|mimes:png,jpg,jpeg|max:350',
				'image_url' => 'sometimes|nullable|url',
				'paid_date' => 'required|date'
			],
			[
				'description.required' => 'Deskripsinya belum diisi nih.',
				'total_paid.required' => 'Jumlah yang dibayar belum diisi nih.',
				'paid_date.required' => 'Tanggal bayarnya belum diisi nih.',
			]
		);

		$data = $request->all();

		$bill = Bills::findOrFail($id);

		$data['slug'] = Str::slug($request->description);

		if ($request->hasFile('image')) {
			$oldImage = public_path('uploads/' . $bill->image);

			if (file_exists($oldImage)) {
				unlink($oldImage);
			}

			$data['image'] = $request->file('image')->store('images/bukti-bayar', 'public');
		} elseif ($request->filled('image_url')) {
			$data['image'] = $request->input('image_url');
		}

		$bill->update($data);

		return to_route('pembayaran.index')->with('info', 'Data pembayaran berhasil diperbarui.');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$bill = Bills::where('slug', $id)->firstOrFail();

		if ($bill->image) {
			$imagePath = public_path('uploads/' . $bill->image);

			if (file_exists($imagePath)) {
				unlink($imagePath);
			}
		}

		$bill->delete();

		return to_route('pembayaran.index')->with('danger', 'Data pembayaran berhasil dihapus.');
	}
}
