<?php header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php 
require('vendor/autoload.php');
$Tp_Page = "About"; // 目前頁面所使用之分類(tp)
$Tp_MdName = strtolower($Tp_Page);
require_once('app/init/bootstrap.php');

use Illuminate\Container\Container;
use Illuminate\Support\Collection; 
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model as Eloquent; 
//use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator; 
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;


$db = new DB;

// 创建链接
$db->addConnection($database);

// 设置全局静态可访问
$db->setAsGlobal();

// 启动Eloquent
$db->bootEloquent();

// https://jsnwork.kiiuo.com/archives/2776/php-%E5%A6%82%E4%BD%95%E5%B0%87-eloquent-%E6%87%89%E7%94%A8%E5%9C%A8%E9%9D%9E-laravel-framework-%E4%B8%AD/

/*
->where('user_id', $request['user_id'])->limit(48)->get()->toArray();
        //当前页数 默认1
        $page = $request->page?:1;
        //每页的条数
        $perPage = 16;
        //计算每页分页的初始位置
        $offset = ($page * $perPage) - $perPage;
        //实例化LengthAwarePaginator类，并传入对应的参数
        $data = new LengthAwarePaginator(array_slice($video_list, $offset, $perPage, true), count($video_list), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]);
        return $data;*/

/*echo $users = News::select(['id', 'name', 'userid'])
	->filters($filters)
    ->get();
    */
abstract class QueryFilter
{
    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    public function filters()
    {
        return $this->request->all();
    }
}

class BookFilter extends QueryFilter
{
    public function name($name)
    {
        return $this->builder->where('name', 'like', "%{$name}%");
    }

}

class Book extends Eloquent
{
    protected $table = 'demo_news';

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}


function escape_like_str($str)
{
    $like_escape_char = '!';

    return str_replace([$like_escape_char, '%', '_'], [
        $like_escape_char.$like_escape_char,
        $like_escape_char.'%',
        $like_escape_char.'_',
    ], $str);
}

//echo News::where('userid', '=', 1)->get();
$results = DB::table('demo_tmp')
    ->select(['id', 'name', 'userid'])
    ->where('userid', '=', 1)
    //->where('name', 'LIKE', "%".escape_like_str($_GET['name'])."%")
	//->limit(2)
    ->paginate(5);
    //->toJson();
    //echo $result->count();

    $results->withPath('test.php');


    //var_dump($result);

    echo $results->nextPageUrl();


    var_dump($results->toJson());

    /*
        //当前页数 默认1
		if (isset($_GET['page'])) {
		  $page = $_GET['page'];
		}else{
		  $page = 0;
		}
        //每页的条数
        $perpage = 2;
        //计算每页分页的初始位置
        $offset = ($page * $perpage) - $perpage;
        //实例化LengthAwarePaginator类，并传入对应的参数

        $total = count($result);

        $itemstoshow = array_slice($result, $offset, $perpage, true);

        $result = new LengthAwarePaginator($itemstoshow ,$total,  $perpage, $page);
        //$data->setPath('http://localhost/agroexpresslink.com/profile');

        //$result = $result->toJson();
        $result = $result->toArray();

		foreach($result['data'] as $about)
		{
			echo $about->name;
        }
        */

        //var_dump($result);

        //$cart = json_decode($result);
        
        //var_dump($cart);

       
//var_dump($result);

?>

