<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\PatientsServices;
use App\Models\Patients;

class PatientServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = DB::table('patients_services')
        ->join('patients','patients.id','=','patients_services.patient')
        ->join('genders','genders.id','=','patients.gender_id')
        ->join('services','services.id','=','patients_services.service')
        ->orderByDesc('patients_services.id')
        ->get();

        return $services;
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $patient_id = null;

        $name = $request->name;
        $dob = $request->dob;
        $gender = $request->gender;
        $service = $request->service;
        $comments = $request->comments;

        $entry = DB::table('patients')
        ->where('name','=',$name)
        ->where('dob','=',$dob)
        ->where('gender_id','=',$gender)
        ->first();

        if(is_null($entry))
        {
            $patient =  Patients::create([
                'name'=>$name,
                'dob'=>$dob,
                'gender_id'=>$gender
            ]);

            $patient_id = $patient->id;
        }
        else
        {
            $patient_id = $entry->id;
        }

        PatientsServices::create([
            'patient'=>$patient_id,
            'service'=>$service,
            'general_comments'=>$comments
        ]);
    }

}
