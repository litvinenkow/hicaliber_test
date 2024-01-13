<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Property;

class SearchController extends Controller
{
    public function search(SearchRequest $request) {
        $params = $request->all();

        $data = Property::query()
            ->when(!empty($params['name']), function ($q) use ($params) {
                return $q->where('name', 'like', '%'.$params['name'].'%');
            })
            ->when(!empty($params['price']), function ($q) use ($params) {
                return $q->whereBetween('price', $params['price']);
            })
            ->when(!empty($params['bedrooms']), function ($q) use ($params) {
                return $q->where('bedrooms', '=', $params['bedrooms']);
            })
            ->when(!empty($params['bathrooms']), function ($q) use ($params) {
                return $q->where('bathrooms', '=', $params['bathrooms']);
            })
            ->when(!empty($params['storeys']), function ($q) use ($params) {
                return $q->where('storeys', '=', $params['storeys']);
            })
            ->when(!empty($params['garages']), function ($q) use ($params) {
                return $q->where('garages', '=', $params['garages']);
            })
            ->get();

        return response()->json($data->toArray());

    }
}
