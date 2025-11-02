<?php 
namespace App\Eloquent;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model as Eloquent; 
use App\Eloquent\Product;

class Productdiscount extends Eloquent
{
    protected $table = 'demo_productdiscount';
	
	public $timestamps = false;
	
	public function product()
    {
        return $this->hasMany(Product::class, 'discountid');
    }

}
?>