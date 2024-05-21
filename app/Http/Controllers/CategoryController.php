<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Controllers\Api\ApiResponseTrait;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait;

    public function index()
    {
        $category=Category::all();
        $categories= CategoryResource::collection($category);
        return $this->apiResponse($categories,'ok',200);  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
       $request->validate();
       $category=Category::create([ 
        'name'=>$request->name,
    ]);

        return $this->apiResponse($category,'Category been Added successfully ',201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category= Category::find($id);

        if($category){
              return $this->apiResponse(new CategoryResource($category),'ok',200);;
            }
             
            return $this->apiReponse('This Category Not Found',404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $request->validate();
        $category= Category::find($id);
        if(!$category){
            return $this->apiReponse(null,'OOps It Was Not Found ',404);          
        }
          $category->update([
             'name'=>$request->name,
            ]);

            return $this->apiResponse(new CategoryResource($category),'Category been Updated',200);  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category= Category::find($id);
        if(!$category){
            return $this->apiReponse(null,'The Category Not Found',404);          
        }
        $category->delete();
        return $this->apiResponse(new CategoryResource($category),'The Category Deleted',200);  
    }
}
