<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\City;
use App\Models\Offer;
use App\Models\Order;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController
{
    public function getUsersCountInCity(Request $request): JsonResponse
    {
        $cities = City::with('users')->get();
        $response = [];

        foreach ($cities as $city) {
            $response[$city->name] = $city->users()->count();
        }

        return new JsonResponse([
            'usersCount' => $response,
        ]);
    }

    public function getOrdersCountInEachCategory(Request $request): JsonResponse
    {
        $categories = Category::with('offers.orders')->get();
        $response = [];

        foreach ($categories as $category) {
            $offers = $category->offers;
            foreach ($offers as $offer) {
                $response[$category->name]= $offer->orders()->count();
            }
        }

        return new JsonResponse([
            'ordersCount' => $response,
        ]);
    }
}
