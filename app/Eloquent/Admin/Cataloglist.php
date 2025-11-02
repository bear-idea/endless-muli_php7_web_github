<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Cataloglist extends BaseEloquent
{
    protected $table = 'demo_cataloglist';

    public function getList(Request $request){
        return $this->select('*')
            ->get();
    }

}