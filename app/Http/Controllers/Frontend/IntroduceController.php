<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\StoreRegion;

class IntroduceController extends Controller
{
    public function index()
    {
        $regions = StoreRegion::active()
            ->ordered()
            ->with(['stores' => fn ($q) => $q->active()])
            ->get();

        return view('frontend.introduce', compact('regions'));
    }
}