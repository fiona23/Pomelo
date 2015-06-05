<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth, DB, Input, Redirect, Session;
use App\Postcard;
use App\PostcardComment;
use App\Exchange;
use App\User;	
class ExchangeController extends Controller {

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
		return view('pages.exchange', ['title' => $auth,
									 'auth' => $auth]);
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
		//$status = Input::get('status');
		$auth = Auth::user()->name;
		$status = Input::all();
		if ($status['status_'] === '1') {
			if (Exchange::create(Input::all())) {
				echo "保存成功";
			} else {
				echo "保存失败";
			}
		} else {
			if ($del = Exchange::whereRaw('postcard_id=? and demand_user=?', [$status['postcard_id'], $auth])->delete()) {
				echo "取消成功";
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($peopleId,$exchangeId)
	{
		$auth = Auth::user()->name;
		$postcard = Postcard::find($exchangeId);
		if ($postcard->status == 0) {
			$status = '';
			$demandUser = Exchange::where('postcard_id', '=', $exchangeId)->get();
			$demand = Exchange::whereRaw('postcard_id=? and demand_user=?', [$exchangeId, $auth])->get();
			if (count($demand)) {
				$status = '取消';
			} else {
				$status = '我想换';
			}
			return view('pages.each_postcard', ['title' => $peopleId,
										 		'auth' => $auth,
										 		'src' => $postcard->showpath,
										 		'postcard' => $postcard,
										 		'status' => $status,
										 		'demands' => $demand,
										 		'demandUsers' => $demandUser]);
		} else {
			return view('errors.404', ['title' => '404', 'auth' => Auth::user()->name]);
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

	public function showList()
	{
		$demandUser = Input::all()['demand_user'];
		$postcards = Postcard::whereRaw('ownuser=? and status = ?', [$demandUser, 0])->get();
		foreach ($postcards as $postcard){
			echo $postcard->id;
		}
		return view('_block.choose', ['postcards' => $postcards]);
	}

	public function choose()
	{
		$auth = Auth::user()->name;
		$postcardIdEd = Input::all()['postcard_id_ed'];
		$postcardId = Input::all()['postcard_id'];
		$getuser = Input::all()['get_user'];
		//
		$postcard = Postcard::find($postcardIdEd);
		$postcard->status = 1;
		$postcard->getuser = $auth;
		$postcard->save();
		//
		$postcard = Postcard::find($postcardId);
		$postcard->getuser = $getuser;
		$postcard->status = 1;
		$postcard->save();
		echo $postcardId;
		//输出地址
		Session::flash('getuser', $getuser);
		Session::flash('address', User::find($getuser)->address);
	}

	public function sure()
	{
		if (Session::get('getuser')) {
			$getuser = Session::get('getuser');
			$address = Session::get('address');
			return view('pages.sure', ['title' => '确认交换',
										'auth' => Auth::user()->name,
										'getuser' => $getuser,
									    'address' => $address]);
		} else {
			return view('errors.404', ['title' => '404', 'auth' => Auth::user()->name]);
		}
	}

}
