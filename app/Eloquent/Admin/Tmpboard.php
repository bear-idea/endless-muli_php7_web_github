<?php 
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;

class Tmpboard extends BaseEloquent
{
    protected $table = 'demo_tmpboard';

    public $timestamps = false;
}
?>