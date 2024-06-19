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
use App\Http\Resources\ApplicantResource;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ApplicantResource::collection(Applicant::all());
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
            $request->validated($request->all());
            $applicant = new Applicant();
            $firstName = $request->input('first_name');
            $lastName = $request->input('last_name');
            $email = $request->input('email');
            $resume = $request->file('resume');
            $jobID = $request->input('job_id');

            if ($request->hasFile('cover_letter')) {
                $coverLetter = $request->file('cover_letter');
                $path = $coverLetter->getClientOriginalName();
                $coverFile = $firstName.'.'.$path;
                $coverLetter->move('coverLetters', $coverFile);
                $applicant->cover_letter = $coverFile;
            }

            $resumeFileName = $firstName.'.'.$resume->getClientOriginalName();
            $resume->move('resumes', $resumeFileName);

            $applicant->resume = $resumeFileName;
            $applicant->email = $email;
            $applicant->first_name = $firstName;
            $applicant->last_name = $lastName;
            $applicant->job_id = $jobID;
            $applicant->save();

            $response = [
                'message' => 'Job Application successfully added',
                'data' => new ApplicantResource($applicant),
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
     * @param Applicant $applicant
     * 
     */
    public function show(Applicant $applicant)
    {
        return new ApplicantResource($applicant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant)
    {

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
