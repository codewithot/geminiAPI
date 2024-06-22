<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function Illuminate\Process\input;
use Carbon\Carbon;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return JobResource::collection(Job::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreJobRequest $request
     * @return JsonResponse
     */
    public function store(StoreJobRequest $request)
    {
        try {
            $job = new Job();
            $title = $request->input('title');
            $description = $request->input('description');
            $department = $request?->input('department');
            $employment_type = $request->input('employment_type');
            $location = $request?->input('location');
            $salary = $request?->input('salary');
            $deadline = $request->input('deadline');
            $experience = $request->input('experience');
            // $deadline = Carbon::createFromFormat('m/d/Y', $deadline)->format('Y-m-d');
         

            if($salary){
                $job->salary = $salary;
            }
            if($department){
                $job->department = $department;
            }
            if($location){
                $job->location = $location;
            }

            $job->title = $title;
            $job->description = $description;
            $job->employment_type = $employment_type;
            $job->deadline = $deadline;
            $job->experience = $experience;
            $job->save();

            $response = [
                'message' => 'Job Opening successfully added',
                'data' => new JobResource($job),
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
     * @param Job $job
     * @return JobResource
     */
    public function show(Job $job)
    {
        return new JobResource($job);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Job $job
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Job $job
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param Job $job
     */
    public function destroy(Job $job)
    {
        //
    }
}
