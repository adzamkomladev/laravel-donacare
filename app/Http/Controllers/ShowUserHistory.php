<?php

namespace App\Http\Controllers;

use App\Services\HistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowUserHistory extends Controller
{
    /** @var \App\Services\HistoryService $historyService  */
    protected $historyService;

    public function __construct(HistoryService $historyService)
    {
        $this->historyService = $historyService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('histories.index', [
            'histories' => $this->historyService->findAllByUser(Auth::user())
        ]);
    }
}
