<?php 
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;

class Productformat extends BaseEloquent
{
    protected $table = 'demo_productformat';
	
	public $timestamps = false;
	
	public function product()
    {
        return $this->belongsTo(Product::class, 'id');
    }
	
}
?>