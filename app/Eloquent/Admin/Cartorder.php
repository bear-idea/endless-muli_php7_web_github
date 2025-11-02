<?php 
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;

class Cartorder extends BaseEloquent
{
    protected $table = 'demo_cartorders';

    public $timestamps = false;

    protected $guarded = ['id'];

}
?>