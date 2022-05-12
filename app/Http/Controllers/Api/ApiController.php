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
    public function getUsersCountInCity(): JsonResponse
    {
        return new JsonResponse([
            'usersCount' => City::withCount('users')->orderBy('users_count', 'desc')->limit(10)->get()
        ]);
    }

    public function getOrdersCountInEachCategory(): JsonResponse
    {
        return new JsonResponse([
            'ordersCount' => Category::withCount('orders')->orderBy('orders_count')->limit(10)->get()
        ]);
    }
}
