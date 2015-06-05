<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use Redirect, Session;
use App\User;
class UserController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$auth = Auth::user()->name;
		$nickname = User::find($auth)->nickname;
		$address = User::find($auth)->address;
		$email = User::find($auth)->email;
		return view('pages.account', ['title' => '修改信息',
									  'auth' => $auth,
									  'nickname' => $nickname,
									  'address' => $address,
									  'email' => $email
									  ]);
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
		$auth = Auth::user()->name;
		$user = User::find($auth);
		$user->nickname = \Input::get('nickname');
		$user->email = \Input::get('email');
		$user->address = \Input::get('address');
		$user->save();
		Session::flash('success', '修改成功');
		return Redirect::to('/account');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
