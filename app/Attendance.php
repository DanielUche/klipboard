<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $fillable = ['firstname','lastname','a_time','a_date','status','staff_id','email'];


    static function check_duplicate($staff = null, $date = null){
    	$isDuplicate = Attendance::where('a_date',$date)->where('staff_id',$staff)->first();
    	if(count($isDuplicate)) {
    		return true;
    	}else{
    	  	return false;
    	}
    }

    static function saveAttandance($data){
    	foreach ($data as $key => $value) {
    		if(Attendance::check_duplicate($value->staff_id, $value->date)) continue;
    			$in[] = ['firstname'=>$value->first_name,'lastname'=>$value->last_name,
					'a_time'=>$value->time, 'a_date'=> date('Y-n-j',strtotime($value->date)),'status'=>$value->status,
					'email'=>$value->email,'staff_id'=>$value->staff_id];
    		}

		if(!empty($in)){
			DB::table('attendances')->insert($in);
			return "saved";
		}
    } 

    static function overViewAllStaffYearMonth($year, $staff = null)
    {

        $monthsValue = [1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',
                       6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December'];

        $monthlyAttendane = array();

        $months = DB::table('attendances')
            ->select(DB::raw('distinct Month(a_date) as month'))->whereYear('a_date', '=' ,$year)->get();

        if($staff){
            $staffs = DB::table('attendances')
            ->select(DB::raw('distinct staff_id'))->whereYear('a_date', '=' ,$year)->where('staff_id',$staff)->get();
        }else{
            $staffs = DB::table('attendances')
            ->select(DB::raw('distinct staff_id'))->whereYear('a_date', '=' ,$year)->get();
        }
        

        foreach ($months as $value) {  
            foreach ($staffs as $key => $s) {
                $late = $early = 0; 

                 $attendYr = DB::table('attendances')
                    ->select(DB::raw('a_time, a_date'))->whereYear('a_date', '=' ,$year)
                    ->whereMonth('a_date','=',$value->month)->where('staff_id',$s->staff_id)->get();

                if($attendYr){
                    $late = Attendance::getLateness($attendYr);
                    $early = (Attendance::getEarliness($attendYr));
                    $name = Attendance::getStaffnames($s->staff_id);
                    $fullname = $name->firstname ." " .$name->lastname;
                    $totalattend = count($attendYr); 
                    $latepercent = round(($late / $totalattend) * 100,2);
                    $earlypercent = round(($early / $totalattend) * 100,2);
                } 
                $monthlyAttendane[] = ['id' => $s->staff_id, 'month'=> $monthsValue[$value->month],'name'=> $fullname,'total'=>$totalattend,'late'=> $late, 'earlypercent'=> $earlypercent, 'early'=>$early, 'latepercent'=>$latepercent];  
            }    
        }	 
        return $monthlyAttendane;	
    }



    static function getLateness($late){
        $normalTime = "8:00AM";
        $totalLate = 0;
        foreach ($late as $key => $value) {
            $arrivalTime = $value->a_time;
            if ((strtotime($arrivalTime) - strtotime($normalTime)) > 0){
                $totalLate += 1;
            }else{
                $totalLate = $totalLate;
            }
        }
        return $totalLate;
    }

    static function getEarliness($late){
        $normalTime = "8:00AM";
        $totalEarly = 0;
        foreach ($late as $key => $value) {
            $arrivalTime = $value->a_time;
            if ((strtotime($arrivalTime) - strtotime($normalTime)) < 0){
                $totalEarly += 1;
            }
        }
        return $totalEarly;
    }

    static function getStaffnames($id){
        return Attendance::where('staff_id',$id)->first();
    }


}
