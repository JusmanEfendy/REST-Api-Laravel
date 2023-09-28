<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'author' => $this->penulis->username,
            'news_content' => $this->description,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
            'jumlah_komentar' => $this->whenLoaded('comments', function () {
                return $this->comments->count();
            }),
            'komentator' => $this->whenLoaded('comments', function () {
                return $this->comments->map(function ($comment) {
                    return [
                        'username' => $comment->komentator->username,
                        'comment_content' => $comment->comment_content,
                        'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at))
                    ];
                });
            })
        ];
    }
}
