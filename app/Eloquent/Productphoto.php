<?php 
namespace App\Eloquent;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model as Eloquent; 
use App\Eloquent\Product;

class Productphoto extends Eloquent
{
    protected $table = 'demo_productphoto';
	
    public $timestamps = false;
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'id');
    }
	
}
?>