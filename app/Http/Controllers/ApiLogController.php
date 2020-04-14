<?php

namespace App\Http\Controllers;

use App\Contracts\ApiLoggerInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class ApiLogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ApiLoggerInterface $logger)
    {
        $apilogs = $logger->getLogs();

        if(count($apilogs)>0){
            $apilogs = $apilogs->sortBy('created_at');
        }
        else{
            $apilogs = [];
        }
        return view('apilog::index',compact('apilogs'));

    }
    public function delete(ApiLoggerInterface $logger)
    {
        $logger->deleteLogs();

        return redirect()->back();

    }

}
