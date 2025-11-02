<?php 
namespace App\Eloquent;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model as Eloquent; 
use App\Eloquent\Product;
use App\Eloquent\Productreply;

class Productpost extends Eloquent
{
    protected $table = 'demo_productpost';
	
    public $timestamps = false;

    public function productreply()
    {
        return $this->hasMany(Productreply::class, 'pid');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'id');
    }
	
}
?>