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
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
            'comment_content' => $this->comment_content,
            'komentator' => $this->komentator,
            'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
        ];
    }
}
