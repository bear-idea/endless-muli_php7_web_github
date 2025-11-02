<?php 
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;

class Productreply extends BaseEloquent
{
    protected $table = 'demo_productreply';
	
    public $timestamps = false;

    public function productpost()
    {
        return $this->belongsTo(Productpost::class, 'id', 'pid');
    }
	
}
?>