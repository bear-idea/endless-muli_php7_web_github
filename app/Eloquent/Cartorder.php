<?php 
namespace App\Eloquent;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model as Eloquent; 

class Cartorder extends Eloquent
{
    protected $table = 'demo_cartorders';

    public $timestamps = false;

    protected $guarded = ['id'];

}
?>