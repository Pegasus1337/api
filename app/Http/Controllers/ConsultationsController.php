<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ConsultationResource ; 
use App\Consultation ; 

class ConsultationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $consultations = Consultation::paginate(10) ; 
       return ConsultationResource::collection($consultations) ; 
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
         
        $free = true  ;
        // we need to check if the timestamp of the consultation is free or not
        if ($free){
            $consultation = new Consultation() ; 
            $consultation->doctor_id = $request->doctor_id ;
            $consultation->patient_id = $request->patient_id ;
            $consultation->price = $request->price ;
            $consultation->consultation_time = $request->consultation_time ; 
            $consultation->room_key = trim(strtolower(base64_encode(rand(1,999999))),"="); ;
            if ($consultation->save()){
                return new ConsultationResource($consultation) ; 
            }
        }else {
            return null ; 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByPatient($id)
    {
        //
        $consultations = Consultation::where('patient_id','=',$id)->paginate(10) ; 
        return  ConsultationResource::collection($consultations) ; 
    }

    public function showByDoctor($id)
    {
        //
        $consultations = Consultation::where('doctor_id','=',$id)->paginate(10) ; 
        return  ConsultationResource::collection($consultations) ; 
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

        $consultation = Consultation::findOrFail($id) ; 
        $consultation->state = $request->state;  
        if ($consultation->save()){
            return new ConsultationResource($consultation) ; 
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
        $consultation = Consultation::findOrFail($id) ; 
        $consultation->delete() ; 
        return new ConsultationResource($consultation) ; 
    }
}
