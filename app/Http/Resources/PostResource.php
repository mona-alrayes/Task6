<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Post_resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'number'=>$this->id,
            'title'=>$this->title,
            'body'=>$this->body,
            'category_Name'=>$this->category->name,
            'User_Name'=>$this->user->name,
        ];
    }
}
