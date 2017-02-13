<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Requests;

use App\Attendance;

use DB;
use Auth;
use Excel;
use Validator;

class HomeController extends Controller {

	public function __construct()
    {
        //$this->middleware('auth',['except' => ['search_videos','get_videos','browse']]);
    }

	public function index(Request $request){
		$date = date("Y");
		$attendance = null;
		if($request->isMethod('post')){
			$attendance = Attendance::overViewAllStaffYearMonth($request->input('year'));
		}else{
			$attendance = Attendance::overViewAllStaffYearMonth($date);
		}
		return View('home.index')->with('attendance', $attendance);
	}

	public function import_attend(Request $request)
	{
		if($request->isMethod("post")){
			if($request->hasFile("attend")){
				$path = $request->file("attend")->getRealPath();
				$data = Excel::load($path, function($reader){})->get();
				if(!empty($data) && $data->count()){
					$result = Attendance::saveAttandance($data);
					if($result)
						return \Redirect::back()->withSuccess('Attendance uploaded Successfully');
				}
				return \Redirect::back()->withWarning('You uploaded an empty sheet');
			}
			return \Redirect::back()->withWarning('No file selected for upload');
		}
		return View('home.embed_modal');	
	}


	public function staff(Request $request, $staffName =null){
		$date = date("Y");
		$attendance = null;
		if($request->isMethod('post')){
			$attendance = Attendance::overViewAllStaffYearMonth($request->input('year'), $staffName);
		}else{
			$attendance = Attendance::overViewAllStaffYearMonth($date, $staffName);
		}
	
		return View('home.staff')->with(['attendance'=> $attendance,'id'=>$staffName ? $staffName : ""]);
	}
}

?>