<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $content;
    public $chart;
    public $dataIcon;
    public function __construct($type='success',$content='con tent',$chart,$dataIcon='check')
    {
        $this->type = $type;
        $this->chart = $chart;
        $this->content = $content;
        $this->dataIcon = $dataIcon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
