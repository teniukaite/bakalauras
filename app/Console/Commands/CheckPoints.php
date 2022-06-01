<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckPoints extends Command
{
    protected $signature = 'check:points';

    protected $description = 'Command to check points';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $points = 0;
        $freelancers = User::where('role', 1)->get();

        foreach ($freelancers as $freelancer) {
            $offers = $freelancer->offers;
            foreach ($offers as $offer) {
                $reviews = $offer->reviews;
                foreach ($reviews as $review) {
                    if ($review->created_at->diffInDays(now()) <= 7) {
                        $points += $review->points;
                        switch ($review->rating) {
                            case 2:
                            case 3:
                            case 1:
                                $points += 0;
                                break;
                            case 4:
                                $points += 1;
                                break;
                            case 5:
                                $points += 2;
                                break;
                        }
                    }
                }
            }

            $freelancer->points += $points;
            $freelancer->save();

            $points = 0;
        }
    }
}
