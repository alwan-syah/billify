<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillType extends Model
{
	protected $table = 'bill_type';

	protected $fillable = ['name'];

	public function bill()
	{
		return $this->hasMany(Bills::class, 'type_id', 'id');
	}
}
