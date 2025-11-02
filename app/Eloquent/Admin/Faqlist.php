<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Faqlist extends BaseEloquent
{
    protected $table = 'demo_faqlist';

    public function getList(Request $request){
        return $this->select('*')
            ->get();
    }

}