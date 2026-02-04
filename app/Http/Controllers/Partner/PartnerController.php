<?php

namespace App\Http\Controllers\Partner;

use App\Models\Partner;
use App\Http\Controllers\Controller;
use App\Http\Resources\Partner\PartnerResource;
use App\Http\Resources\Partner\SelectPartnerResource;

class PartnerController extends Controller
{
    public function index()
    {
        return PartnerResource::collection(Partner::all());
    }

    public function select()
    {
        return SelectPartnerResource::collection(Partner::all());
    }
}
