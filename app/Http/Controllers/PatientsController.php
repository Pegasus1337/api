<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Patient ;
use App\Http\Resources\PatientResource ; 

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::paginate(10) ; 
        return PatientResource::collection($patients) ; 
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
        $patient = new Patient() ; 
        if(Patient::where('patient_username','=',$request->patient_username)->exists()){
            return new PatientResource(null) ; 
        }else {
            $patient->patient_username = $request->patient_username ; 
            $patient->patient_password = $request->patient_password ; 
            $patient->name = $request->name ; 
            $patient->lastName = $request->lastName ;
            $patient->cin = $request->cin ; 
            $patient->dob = $request->dob ;
            $patient->country = $request->country ; 
            $patient->avatar_link = "../../images/standard.jpg" ;
            if ($patient->save()){
                return new PatientResource($patient) ; 
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
    public function show($name)
    {
        $patient = Patient::where('name','LIKE',$name)->paginate(5) ; 
        return PatientResource::collection($patient) ; 
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
        $patient = Patient::findOrFail($id) ; 
        $patient->patient_username = $request->patient_username; 
        $patient->patient_password = $request->patient_password ; 
        $patient->avatar_link = $request->avatar_link ;
        if ($patient->save()){
            return new PatientResource($patient) ; 
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
        //
        $patient = Patient::findOrFail($id) ;  
        if ($patient->delete())
            return new PatientResource($patient);
    }

    public function login($username,$password){
        $patient = Patient::where('patient_username','=',$username)->where('patient_password','=',$password)->exists() ; 
        return $patient ; 

    }
}
