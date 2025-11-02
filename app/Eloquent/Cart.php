<?php 
namespace App\Eloquent;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model as Eloquent; 
use App\Eloquent\Productdiscount;

class Cart extends Eloquent
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