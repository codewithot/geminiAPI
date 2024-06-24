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

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BlogResource::collection(Blog::all());
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
            $blog = new Blog();
            $topic = $request->input('topic');
            $body = $request->input('body');
            $category = $request->input('category');
            $image = $request->file('image');

            $imageFileName = $topic.'.'.$image->getClientOriginalName();
            $image->move('blogImages', $imageFileName);

            $blog->topic = $topic;
            $blog->user_id = $userId;
            $blog->body = $body;
            $blog->category = $category;
            $blog->save();

            $blogID = $blog->id;
            $image = new Image();

            $image->blog_id = $blogID;
            $image->name = $imageFileName;
            $image->type = $imageType; 
            $image->save();
            
            if ($request->file('image_two')){
                $imageTwo = $request->file('image_two');
                $imageFileName = $topic.'2.'.$imageTwo->getClientOriginalName();
                $imageTwo->move('blogImages', $imageFileName);

                $img = new Image();
                $img->blog_id = $blogID;
                $img->name = $imageFileName;
                $img->type = $imageType; 
                $img->save();
            }

            if ($request->file('image_three')){
                $imageThree = $request->file('image_three');
                $imageFileName = $topic.'3.'.$imageThree->getClientOriginalName();
                $imageThree->move('blogImages', $imageFileName);

                $img = new Image();
                $img->blog_id = $blogID;
                $img->name = $imageFileName;
                $img->type = $imageType; 
                $img->save();
            }

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
