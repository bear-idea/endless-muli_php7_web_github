<?php 
namespace App\Eloquent;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model as Eloquent; 
use App\Eloquent\Product;
use App\Eloquent\Productpost;

class Productreply extends Eloquent
{
    protected $table = 'demo_productreply';
	
    public $timestamps = false;

    public function productpost()
    {
        return $this->belongsTo(Productpost::class, 'id', 'pid');
    }
	
}
?>