<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
	protected $table = 'bills';

	protected $fillable = ['description', 'slug', 'total_paid', 'image', 'paid_date', 'type_id'];

	public function billType()
	{
		return $this->belongsTo(BillType::class, 'type_id', 'id');
	}
}
