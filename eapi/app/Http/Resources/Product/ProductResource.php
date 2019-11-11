<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'user_id' => $this->user_id,
            'description' => $this->details,
            'orginal_price' => $this->price,
            'stock' => $this->stock == 0 ? 'Out of stock!' : $this->stock,
            'discount' => $this->discount,

            'total_price' => $this->price - round((($this->discount/100) * $this->price), 2),

            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(), 2) : 'No Rating Yet!',
            'href' => [
                'reviews' => route('reviews.index', $this->id)
            ]
        ];
    }
}
