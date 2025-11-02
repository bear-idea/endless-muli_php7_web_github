<?php 
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;

class Productphoto extends BaseEloquent
{
    protected $table = 'demo_productphoto';
	
    public $timestamps = false;
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'id');
    }
	
}
?>