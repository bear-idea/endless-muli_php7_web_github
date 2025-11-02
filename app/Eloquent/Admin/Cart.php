<?php 
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;

class Cart extends BaseEloquent
{
    protected $table = 'demo_cart';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function cartdiscount()
    {
        return $this->belongsTo(Productdiscount::class, 'id');
    }
}
?>