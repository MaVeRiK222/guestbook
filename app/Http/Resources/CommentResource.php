<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //dump($this->user);
        return [
            "id" => $this->id,
            "text" => $this->text,
            "user_id" => $this->user_id,
            "created_at" => $this->created_at,
            "user" => is_null($this->user) ? NULL : new UserResource($this->user)
            // function ($data) {
            //     return is_null($data) ? NULL : $data;
            // }
        ];
    }
}
