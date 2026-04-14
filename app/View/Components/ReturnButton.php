<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReturnButton extends Component
{
    public function render(): View|Closure|string
    {
        $previous = session()->previousUrl() ?? route('fiche-commande.index');
        return view('components.return-button', compact('previous'));
    }
}
