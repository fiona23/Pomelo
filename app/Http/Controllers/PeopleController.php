<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Auth;
class PeopleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		return view('errors.404', ['title' => '404']);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Request::ajax()) {
			$auth = Auth::user()->name;
			if (isset($_POST['followId'])) {
				$followId = $_POST['followId'];
				DB::insert('insert into followers (user1, user2) values (?, ?)', [$followId, $auth]);
				return;
			} else if (isset($_POST['unfollowId'])) {
				$unfollowId = $_POST['unfollowId'];
				DB::delete('delete from followers
							where user1 = "'.$unfollowId.'"
							and user2="'.$auth.'"');
				return;
			}
			
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	
		$auth = Auth::user()->name;
		$results = DB::select('select name from users
								where name = :username',  ['username' => $id]);
		if (!$results) {
			return view('errors.404', ['title' => '404']);
		} else {
			$followResult = DB::select('select * from followers
										where user1 = "'.$id.'"
										and user2="'.$auth.'"');
			if ($followResult) {
				$btnHTML = '取消关注';
				$class = 'unfollow-btn';
			} else {
				$btnHTML = '关注';
				$class = 'follow-btn';
			}

			$postcards = DB::select('select path from postcards
										  where ownuser = "'.$id.'"');
			$nickname = $results[0]->name;
			return view('pages.people', ['auth' => $auth,
										 'title' => $id,
										 'nickname' => $nickname,
										 'btnHTML' => $btnHTML,
										 'class' =>$class,
										 'postcards' => $postcards]);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
