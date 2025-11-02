<?php 
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;

class Product extends BaseEloquent
{
    protected $table = 'demo_product';
	
	public $timestamps = false;
	
	public function productformat()
    {
        return $this->hasMany(Productformat::class, 'aid');
    }

    public function productphoto()
    {
        return $this->hasMany(Productphoto::class, 'aid');
    }

    public function productpost()
    {
        return $this->hasMany(Productpost::class, 'pid');
    }

    public function productreply()
    {
        //            hasManyThrough(遠端模型 , 中介模型 , 中介模型外來鍵 ,遠端模型外來鍵 ,主要模型主鍵 ,中介模型主鍵);
        return $this->hasManyThrough(Productreply::class, Productpost::class, 'pid', 'pid', 'id', 'id');
    }

    public function productdiscount()
    {
        return $this->belongsTo(Productdiscount::class, 'discountid');
    }
}
?>