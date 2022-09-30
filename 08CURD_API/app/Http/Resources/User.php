<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class User extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    private $statusText;
    public function __construct($resource, $statusCode, $statusText = 'success')
    {
        parent::__construct($resource);
        $this->statusCode = $statusCode;

        $this->statusText = $statusText;
    }
    public function toArray($request)
    {
        // return parent::toArray($request);
        // dd($this->collection);

        return [
            'data' => $this->collection,
            'statusText' => $this->statusText,
            'statusCode' => $this->statusCode,
            'count' => $this->collection->count(),

        ];
    }
}
