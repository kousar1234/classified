<?php

namespace Plugin\ClassiLooksCore\Http\ApiResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AdsConditionCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {
                return [
                    'id' => (int) $data->id,
                    'title' => $data->translation('title', session()->get('api_locale')),
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
