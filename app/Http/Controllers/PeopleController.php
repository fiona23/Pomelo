<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Exchange, App\User;
use App\Postcard;
class PeopleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		return view('errors.404', ['title' => '404', 'auth' => Auth::user()->name]);
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
		$user = User::find($id);
		if (!$user) {
			return view('errors.404', ['title' => '404', 'auth' => $auth]);
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

			$postcardsEx = Postcard::whereRaw('ownuser=? and status=?',[$id, 0])->get();
			$postcardsWall = Postcard::whereRaw('getuser=? and status=?',[$id, 1])->get();			

			return view('pages.people', ['auth' => $auth,
										 'title' => $id,
										 'nickname' => $user->nickname,
										 'btnHTML' => $btnHTML,
										 'class' =>$class,
										 'postcards' => $postcardsEx,
										 'postcardsWall' => $postcardsWall
										 // 'status' => $status,
										 ]);
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
