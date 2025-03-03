<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use App\Models\Educations;
use App\Models\experience;
use App\Models\Projects;
use App\Models\Skills;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $title = 'CMS Portfolio Dashboard';
        $active = 'dashboard';
        $subActive = null;
     
        return view('pages.dashboard', compact('title','active', 'subActive'));
    }
}
