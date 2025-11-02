<?php 
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;

class Productpost extends BaseEloquent
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