<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Number'=>$this->id,
            'Comment'=>$this->body,
            'Commenter_user_name'=>$this->user->name, 
            'Related_Post'=>$this->post->title,
        ];
    }
}
