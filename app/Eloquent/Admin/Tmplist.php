<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Tmplist extends BaseEloquent
{
    protected $table = 'demo_tmplist';

    public function getList(Request $request){
        return $this->select('*')
            ->get();
    }

}