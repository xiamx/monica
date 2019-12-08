<?php

namespace App\Http\Controllers;
use App\Helpers\InstanceHelper;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('landing.pricing', [
            'numberOfCustomers' => InstanceHelper::getNumberOfPaidSubscribers(),
        ]);
    }
}
