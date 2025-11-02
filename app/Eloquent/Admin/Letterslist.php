<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Letterslist extends BaseEloquent
{
    protected $table = 'demo_letterslist';

    public function getList(Request $request){
        return $this->select('*')
            ->get();
    }

}