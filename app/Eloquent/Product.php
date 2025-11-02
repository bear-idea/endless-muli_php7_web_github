<?php 
namespace App\Eloquent;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model as Eloquent; 

class Product extends Eloquent
{
    protected $table = 'demo_product';
}
?>