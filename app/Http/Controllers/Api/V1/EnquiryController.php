<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnquiryRequest;
use App\Http\Resources\EnquiryResource;
use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\EnquiryMail;
use Illuminate\Support\Facades\Mail;


class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EnquiryResource::collection(Enquiry::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(StoreEnquiryRequest $request): JsonResponse
    {
        try {
            $enquiry = Enquiry::create($request->validated());

            Mail::to($enquiry->email)->queue(new EnquiryMail($enquiry));
            if ($enquiry){
                $response = [
                    'message' => 'Enquiry successfully added ' ,
                    'enquiry' => new EnquiryResource($enquiry),
                ];
                return response()->json($response, 200);
            }
            return response()->json("Something went wrong, try again", 401);
        }catch (\Throwable $th){
            return response()->json([
                'status'=> false,
                'message'=> $th->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     * @param Enquiry $enquiry
     * @return EnquiryResource
     */
    public function show(Enquiry $enquiry)
    {
        return new EnquiryResource($enquiry);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enquiry $enquiry)
    {
        //
    }
}
