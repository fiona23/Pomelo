<?php namespace App\Http\Controllers;
require '../vendor/autoload.php';
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use Validator;
use Redirect;
use Session;
use Auth, DB, File;
use App\Postcard;
use Illuminate\Support\Facades\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
//use Intervention\Image\Facades\Image;

class UploadController extends Controller {
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
		//如果刚刚上传了明信片 则插入数据库一条新鲜事
		if (Session::get('timestamp')) {
			// $news = new News;
			// $news->name = $auth;
			// $news->timestamp = Session::get('timestamp');
			DB::insert('insert into news(name, timestamps) values (?, ?)', [$auth, Session::get('timestamp')]);
		}
		return view('pages.upload', ['title' => $auth,
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
	public function store(Request $request)
	{
		$files = Input::file('postcard');
		if (Session::get('count')) {
			$count = Session::get('count')+count($files);
		} else {
			$count = count($files);
		}
		if (Session::get('timestamp')) {
			$timestamp = Session::get('timestamp');
		} else {
			$timestamp = round(microtime(true) * 1000);
		}
		foreach ($files as $file) {
			$extension = $file->getClientOriginalExtension();
			$fileName =  'p'.round(microtime(true) * 1000).'.'.$extension;
			$userName = Auth::user()->name;
			$path = 'uploads/natural/'.$userName;
			$showpath = 'uploads/show/'.$userName;
			$cutpath = 'uploads/cut/'.$userName;
			if (!file_exists($showpath)) {
				File::makeDirectory($showpath, 0755, true);
				File::makeDirectory($cutpath, 0755, true);
			}
	 		$file->move($path, $fileName);
	 	    Session::flash('success', 'Upload successfully');
	 	    //记录这次一共上次了多少张图片
	 	    Session::flash('count', $count);
	 	    //这一次上传明信片的时间戳
	 	    Session::flash('timestamp' , $timestamp);
	 	    $postcard = new Postcard;
	 	    $postcard->ownuser = $userName;
	 	    //大图
	 	    $postcard->path = $path.'/'.$fileName;
	 	    $postcard->timestamp = $timestamp;
	 	    //普通显示
	 	    $imgShow = Image::make($postcard->path);
	 	    $imgShow->widen(600);
	 	    $postcard->showpath = $showpath.'/'.$fileName;
	 	    $imgShow->save($postcard->showpath);
	 	    //截图
	 	    $imgCut = Image::make($postcard->path);
	 	    $imgCut->fit(168);
	 	    $postcard->cutpath = $cutpath.'/'.$fileName;
	 	    $imgCut->save($postcard->cutpath);
	 	    if ($postcard->save()) {
	 	    		$img = view('_block.upload_block', ['src' => $postcard->cutpath])->render();
	 	    		$obj = new \stdClass();
					$obj->img = $img;
					$obj->count = $count;
					header('Content-Type: application/json');
					echo json_encode($obj);
	 	    }
			else {
				echo "上传失败";
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
