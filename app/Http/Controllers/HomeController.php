<?php namespace App\Http\Controllers;
use Auth, DB;
use Illuminate\Pagination\Paginator;
class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$auth = Auth::user()->name;
		//得到当前登录用户的注册关注账户
		$follows = DB::select('select user1 from followers
							  where user2 = "'.$auth.'"');
		if (count($follows) != 0) {
			$followsArray = array();
			$followsString = '';
			foreach ($follows as $follow) {
				array_push($followsArray, '"'.$follow->user1.'"');
			}
			$followsString = '('.implode(",", $followsArray).')';
			//找到所有关注着的timestamp
			$timestamps = DB::select('select timestamps 
									  from news 
									  where news.name in '.$followsString);
			
			$allNews = '';
			foreach ($timestamps as $timestamp) {
				$eachNews = '';
				//找到每一条新鲜事对应的明信片
				$news = DB::select('select path
										 from postcards
										 where timestamp = '.$timestamp->timestamps);
				foreach ($news as $new) {
					$eachNews .= view('_block.news_block', ['news' => $new->path])->render();
					
				}
				$allNews .= '<div class="status-item">'.$eachNews.'</div>';
			}
			return view('home', ['title' => '柚子',
								 'auth' => $auth,
								 //'follow' => $follow,
								 'news' => $allNews
								 ]);
		} else {
			//新注册用户没有关注任何人
			return view('home', ['title' => '柚子',
								 'auth' => $auth,
								 //'follow' => $follow,
								 'news' => '$allNews'
								 ]);
		}
	}

}
