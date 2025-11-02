<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Productlist extends BaseEloquent
{
    protected $table = 'demo_productlist';

    public function getList(Request $request){
        return $this->select('*')
            ->get();
    }

}