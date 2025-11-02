<?php 
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Artlist extends BaseEloquent
{
    protected $table = 'demo_artlist';

    public function getList(Request $request){
        return $this->select('*')
            ->get();
    }
}