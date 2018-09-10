<?php

namespace App\Http\Controllers\Modules\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    //
    public function showIndex()
    {
        //

        return view('modules.profile.site.show-index');
    }
}
