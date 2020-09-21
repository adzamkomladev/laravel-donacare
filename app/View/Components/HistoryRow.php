<?php

namespace App\View\Components;

use App\History;
use Illuminate\View\Component;

class HistoryRow extends Component
{
    /**
     * The History.
     *
     * @var History
     */
    public $history;

    /**
     * The history data.
     *
     * @var array
     */
    public $data;

    /**
     * The iteration number
     *
     * @var int
     */
    public $iteration;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(History $history, int $iteration)
    {
        $this->history = $history;
        $this->iteration = $iteration;
        $this->data = json_decode($history->data, true);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.history-row');
    }

    /**
     * Determine if the given option is the current selected option.
     *
     * @param  string  $option
     * @return bool
     */
    public function details()
    {
        if ($this->history->type === 'donation') {
            return "{$this->data['patient']['profile']['full_name']} requested for {$this->data['value']}";
        }
    }
}
