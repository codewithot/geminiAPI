<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicantRequest;
use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Applicant;
use App\Models\Enquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function Illuminate\Process\input;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(StoreApplicantRequest $request): JsonResponse
    {
        try {
            $applicant = new Applicant();
            $firstName = $request->input('first_name');
            $lastName = $request->input('last_name');
            $email = $request->input('email');
            $resume = $request->file('resume');
            $jobTitle = $request?->input('job_title');
            $salary = $request?->input('salary');
            $coverLetter = $request?->file('cover_letter');

            $resumeFileName = time().'.'.$resume->getClientOriginalExtension();
            $resume->move('resumes', $resumeFileName);
            if($coverLetter) {
                $coverFile = time().'.'.$coverLetter->getClientOriginalExtension();
                $coverLetter->move('coverLetters', $coverFile);
                $applicant->cover_letter = $coverFile;
            }
            if($salary){
                $applicant->salary = $salary;
            }
            if($jobTitle){
                $applicant->job_title = $jobTitle;
            }
            $applicant->resume = $resumeFileName;
            $applicant->email = $email;
            $applicant->first_name = $firstName;
            $applicant->last_name = $lastName;

            $applicant->save();
            $response = [
                'message' => 'Application successfully added ' ,
                'data' => $applicant,
                ];
            return response()->json($response, 200);
        }catch (\Throwable $th){
        return response()->json([
            'status'=> false,
            'message'=> $th->getMessage()
        ], 500);
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(Applicant $applicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $applicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant)
    {
        //
    }
}
