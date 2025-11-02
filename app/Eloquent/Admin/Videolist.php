<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Videolist extends BaseEloquent
{
    protected $table = 'demo_videolist';

    public function getList(Request $request){
        return $this->select('*')
            ->get();
    }

}