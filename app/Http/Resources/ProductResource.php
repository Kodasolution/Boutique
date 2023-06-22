<?php

namespace App\Http\Resources;

use App\Models\ProductSize;
use App\Http\Resources\SizeResource;
use PhpParser\ErrorHandler\Collecting;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'name' => $this->name,
                "price" => $this->price,
                "quantity" => $this->quantity,
                "marque" => $this->marque,
                "status" => $this->status,
                "category" => new CategoryResource($this->category),
                "color" => ColorResource::collection($this->colorPros),
                "size" =>  SizeResource::collection($this->sizePros),
                "photo"=> PhotoResource::collection($this->photos)
            ];
    }
}
