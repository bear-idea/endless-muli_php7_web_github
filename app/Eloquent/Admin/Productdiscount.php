<?php 
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;

class Productdiscount extends BaseEloquent
{
    protected $table = 'demo_productdiscount';
	
	public $timestamps = false;
	
	public function product()
    {
        return $this->hasMany(Product::class, 'discountid');
    }

}
?>