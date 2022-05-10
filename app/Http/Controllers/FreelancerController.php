<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class FreelancerController extends Controller
{
    public function index(): View
    {
        $freelancers = User::where('role', 1)->orderBy('points', 'desc')->paginate(10);

        return view('freelancer.top', compact('freelancers'));
    }
}
