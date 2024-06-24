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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

            if ($request->cover_letter){
                $coverName = Str::random(32).".".$request->cover_letter->getClientOriginalExtension();
                Storage::disk('public')->put($coverName, file_get_contents($request->cover_letter));
            }
            $resumeName = Str::random(32).".".$request->resume->getClientOriginalExtension();
            $applicant = Applicant::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'resume' => $resumeName,
                'cover_letter'=> $coverName,
                'email' => $request->email,
                'job_id' => $request->job_id
            ]);
            Storage::disk('public')->put($resumeName, file_get_contents($request->resume));
            
            
           
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
        $applicant = Applicant::find($applicant->id);
        if(!$applicant){
          return response()->json([
             'message'=>'Product Not Found.'
          ],404);
        }
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
