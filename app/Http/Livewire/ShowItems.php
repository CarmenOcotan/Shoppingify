<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Item;
use App\Models\Listname;
use Livewire\Component;

class ShowItems extends Component
{
    public $search;

    public function render()
    {
        $categories = Category::all();
        $listnames = Listname::all();
        $items = Item::where("name", "LIKE", "%" . $this->search . "%")->get();

        return view('livewire.show-items', compact("items", "categories", "listnames"));

    }
}
