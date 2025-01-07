<?php

namespace App\Http\Resources\Contracts;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;


class CollectionResource extends ResourceCollection
{
    public function paginationInformation($request, $paginated, $default)
    {
        $metaData = [
            'meta_data' => [
                'current_page' => $default['meta']['current_page'],
                'total' => $default['meta']['total'],
            ]
        ];

        return $metaData;
    }
}
