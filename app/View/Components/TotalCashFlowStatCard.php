<?php

namespace App\View\Components;

use App\Services\PaymentService;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class TotalCashFlowStatCard extends Component
{
    /** @var \App\Services\PaymentService $paymentService  */
    protected $paymentService;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.total-cash-flow-stat-card');
    }

    /**
     * Total Cash Flow
     *
     * @return string
     **/
    public function totalCashFlow()
    {
        $payments = $this->payments();

        $total = collect($payments)->reduce(function ($total, $payment) {
            $total += $payment->amount;
        });

        return '₵ ' . round($total / 100.00, 2);
    }

    /**
     * All payments of a user
     *
     * @return \App\Payment[]
     **/
    private function payments()
    {
        return $this->paymentService->findAllByUser(Auth::user());
    }
}
