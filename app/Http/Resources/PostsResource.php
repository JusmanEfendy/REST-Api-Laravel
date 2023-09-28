<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'image' => $this->image,
            'news_content' => $this->description,
            'author' => $this->penulis,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
            'jumlah_komentar' => $this->whenLoaded('comments', function () {
                return $this->comments->count();
            }),
            'komentator' => $this->whenLoaded('comments', function () {
                return $this->comments->map(function ($comment) {
                    return [
                        'comment_id' => $comment->id,
                        'post_id' => $comment->post_id,
                        'username' => $comment->komentator->username,
                        'comment_content' => $comment->comment_content,
                        'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at))
                    ];
                });
            }),         
        ];
    }
}
