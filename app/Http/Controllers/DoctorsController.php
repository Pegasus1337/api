<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\DoctorResource ; 
use App\Doctor ; 

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::paginate(10) ; 
        return DoctorResource::collection($doctors) ; 
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

        $doctor = new Doctor() ; 
        if(Doctor::where('doctor_username','=',$request->doctor_username)->exists()){
            return new DoctorResource(null) ; 
        }else {
            $doctor->doctor_username = $request->doctor_username ; 
            $doctor->doctor_password = $request->doctor_password ; 
            $doctor->name = $request->name ; 
            $doctor->lastName = $request->lastName ;
            $doctor->matriculation = $request->matriculation ; 
            $doctor->dob = $request->dob ;
            $doctor->specialty = $request->specialty ;
            $doctor->RIB = $request->RIB ;
            $doctor->country = $request->country ; 
            $doctor->avatar_link = "../../images/standard.jpg" ;
            if ($doctor->save()){
                return new DoctorResource($doctor) ; 
            }else {
                return null ; 
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ShowByName($name)
    {
        $name = trim($name) ; 
        $pos = strpos($name,' ') ; 
        if ($pos !== false){
            $firstName = explode(' ',$name)[0] ; 
            $lastName = explode(' ',$name)[1] ; 
            $doctors = Doctor::where('name','LIKE','%'.$firstName.'%')->where('lastName','LIKE','%'.$lastName.'%')->paginate(10) ; 
        }else{
            $doctors = Doctor::where('name','LIKE','%'.$name.'%')->paginate(10) ;
        }
        return  DoctorResource::collection($doctors) ; 
    }

    public function showBySpecialty($specialty)
    {
        $doctors = Doctor::where('specialty','=',$specialty)->paginate(10) ; 
        return  DoctorResource::collection($doctors) ; 
    }


    public function showByNameNdSpecialty($name,$specialty){
        $name = trim($name) ; 
        $pos = strpos($name,' ') ; 
        if ($pos !== false){
            $firstName = explode(' ',$name)[0] ; 
            $lastName = explode(' ',$name)[1] ; 
            $doctors = Doctor::where('name','LIKE','%'.$firstName.'%')->where('lastName','LIKE','%'.$lastName.'%')->where('specialty','=',$specialty)->paginate(10) ; 
        }else{
            $doctors = Doctor::where('name','LIKE','%'.$name.'%')->where('specialty','=',$specialty)->paginate(10) ;
        }
        return  DoctorResource::collection($doctors) ; 
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
        $doctor = Doctor::findOrFail($id) ; 
        $doctor->RIB = $request->RIB ; 
        $doctor->avatar_link = $request->avatar_link ; 
        $doctor->matriculation = $request->matriculation ; 
        $doctor->doctor_username = $request->doctor_username ; 
        $doctor->doctor_password = $request->doctor_password ; 
        if ($doctor->save()){
            return new DoctorResource($doctor)  ; 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id) ; 
        $doctor->delete() ; 
        return new DoctorResource($doctor) ; 
    }


    public function login($username,$password){
        $doctor = Doctor::where('doctor_username','=',$username)->where('doctor_password','=',$password)->exists() ; 
        return $doctor ; 

    }
}
