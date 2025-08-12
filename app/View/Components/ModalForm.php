<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalForm extends Component
{
    public $id;
    public $title;
    public $action;
    public $method;
    public $buttonText;
    public $categoria;

    public function __construct($id, $title, $action, $method = 'POST', $buttonText = 'Guardar')
    {
        $this->id = $id;
        $this->title = $title;
        $this->action = $action;
        $this->method = $method;
        $this->buttonText = $buttonText;
    }

    public function render()
    {
        return view('components.modal-form');
    }
}
