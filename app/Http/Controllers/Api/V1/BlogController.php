<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Image;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Http\JsonResponse;
use function Illuminate\Process\input;
use App\Http\Resources\BlogResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BlogResource::collection(Blog::all());
    }


    public function blogimages(Blog $blog)
    {
        $image = Image::where('blog_id',$blog->id)->first();

        if (!$image) {
            return response()->json([
                'message' => 'No blog image',
            ], 401);
        }
        return response()->json([
            'message' => 'image fetched successfully',
            'images' => $image
        ], 401);;


        // if ($request->image_two){
        //     $imageTwoName = Str::random(32).".".$request->image_two->getClientOriginalExtension();
        //     Storage::disk('public')->put($imageTwoName, file_get_contents($request->image_two));
        //     Image::create([
        //         "blog_id" => $blogID,
        //         "name" => $imageTwoName,
        //         "type" => $imageType
        //     ]);
        // }

        // if ($request->image_three){
        //     $imageThreeName = Str::random(32).".".$request->image_three->getClientOriginalExtension();
        //     Storage::disk('public')->put($imageThreeName, file_get_contents($request->image_three));
        //     Image::create([
        //         "blog_id" => $blogID,
        //         "name" => $imageThreeName,
        //         "type" => $imageType
        //     ]);
        // }

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
     * @param StoreBlogRequest $request
     * @return JsonResponse
     */
    public function store(StoreBlogRequest $request)
    {
        $user = $request->user();
        $userId = $user->id;
        $imageType = "blog";
        
        try {
            $body = $request->body;
            $summary = substr($body, 0, 140);
            
            $blog = Blog::create([
                'topic' => $request->topic,
                'body' => $request->body,
                'category' => $request->category,
                'user_id' => $userId,
                'summary'=> $summary
            ]);
            $blogID = $blog->id;
            
            $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();Storage::disk('public')->put($imageName, file_get_contents($request->image));
            Image::create([
                "blog_id" => $blogID,
                "name" => $imageName,
                "type" => $imageType
            ]);
            $response = [
                'message' => 'Blog post added successfully',
                'data' => new BlogResource($blog),
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
     * @param Blog $blog
     * @return BlogResource
     */
    public function show(Blog $blog)
    {
        return new BlogResource($blog);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
