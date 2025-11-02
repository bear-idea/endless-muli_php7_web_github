<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Albumlist extends BaseEloquent
{
    protected $table = 'demo_albumlist';

    public function getList(Request $request){
        return $this->select('*')
            ->get();
    }

}