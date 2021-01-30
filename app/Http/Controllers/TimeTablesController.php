<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeTable ;
use App\Consultation ; 

use DateTime;
use DatePeriod;
use DateInterval;

use App\Http\Resources\TimeTableResource ;

class TimeTablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $timeTable = new TimeTable() ;
        $timeTable->doctor_id=$request->doctor_id ;
        $timeTable->Monday= $request->Monday ; 
        $timeTable->Tuesday= $request->Tuesday ; 
        $timeTable->Wednesday= $request->Wednesday ; 
        $timeTable->Thursday= $request->Thursday ; 
        $timeTable->Friday= $request->Friday ; 
        if ($timeTable->save()){
            return new TimeTableResource($timeTable) ; 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($doctor_id)
    {
        $timeTable = TimeTable::where('doctor_id','=',$doctor_id) ; 
        return new TimeTableResource($timeTable) ; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($doctor_id)
    {
        $timeTable = TimeTable::where('doctor_id','=',$doctor_id) ; 
        if ($timeTable->delete()){
            return new TimeTableResource($timeTable) ; 
        }
        
    }

    public function getFreeTime($doctor_id)
    {
        $timeTable = TimeTable::where('doctor_id','=',$doctor_id) ; 
        $time = strtotime('monday this week');
        $currentDate = date("l d-m-Y",$time)  ; 
        $endDate = date("l d-m-Y", strtotime("+4 days"));
        $array = $this->getDatesFromRange($currentDate, $endDate); 
        // Attributes each working period to each day 
        $array[0] = $array[0]." ".$timeTable->value('Monday') ; 
        $array[1] = $array[1]." ".$timeTable->value('Tuesday') ; 
        $array[2] = $array[2]." ".$timeTable->value('Wednesday') ; 
        $array[3] = $array[3]." ".$timeTable->value('Thursday') ; 
        $array[4] = $array[4]." ".$timeTable->value('Friday') ; 
        
        

        
        return new TimeTableResource($array) ; 

    }

    public function getDatesFromRange($start, $end, $format = 'l d-m-Y')
     { 
        $array = array();  
        $interval = new DateInterval('P1D'); 
        $realEnd = new DateTime($end); 
        $realEnd->add($interval); 
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
        foreach($period as $date) {                  
            $array[] = $date->format($format);  
        }  
        return $array; 
    } 
}
