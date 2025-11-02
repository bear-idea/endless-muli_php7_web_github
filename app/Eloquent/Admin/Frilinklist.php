<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Frilinklist extends BaseEloquent
{
    protected $table = 'demo_frilinklist';

    public function getList(Request $request){
        return $this->select('*')
            ->get();
    }

}