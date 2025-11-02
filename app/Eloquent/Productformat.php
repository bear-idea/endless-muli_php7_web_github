<?php 
namespace App\Eloquent;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model as Eloquent; 
use App\Eloquent\Product;

class Productformat extends Eloquent
{
    protected $table = 'demo_productformat';
	
	public $timestamps = false;
	
	public function product()
    {
        return $this->belongsTo(Product::class, 'id');
    }
	
}
?>