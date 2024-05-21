<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment=Comment::with(['user','post'])->get();
        $comments=CommentResource::collection($comment);
        return $this->apiResponse($comments,'ok',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        $request->validate();
        $comment=Comment::create([
            'body'=>$request->body,
            'posts_id'=>$request->posts_id,
            'users_id'=>Auth::id(),
        ]);
        return $this->apiResponse(new CommentResource($comment),'The Comment been Added sucessfully',200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment=Comment::with(['user','post'])->find($id);
       
        if(!$comment){
            return $this->apiResponse(null,' Oops The Comment Was Not Found',404);        
            }
            return $this->apiResponse(new CommentResource($comment),'ok',200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, string $id)
    {
        $request->validate();
        $comment= Comment::find($id);

        if(!$comment){
            return $this->apiResponse(null,'Oops The Comment Was Not Found',404); 
         }
         $request->update($comment->all());
         return $this->apiResponse(new CommentResource($comment),'The Comment been Updated',200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment=Comment::find($id);
        if(!$comment){
          return $this->apiResponse(null,'Oops The Comment Was Not Found',404);  
        }
       $comment->delete();
          return $this->apiResponse(new CommentResource($comment),'The Comment been Deleted successfully',200);
    }
}
