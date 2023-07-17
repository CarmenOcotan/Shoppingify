<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Item;
use App\Models\Listname;
use Livewire\Component;

class ShowItems extends Component
{
    public $search;
    public $showForm = false;
    public $name;
    public $note;
    public $image;
    public $category;
    public $imageUrl; 
    public $selectedItemId;
    public $selectedItemImage;
    public $selectedItemName ;
    public $selectedItemNote ;
    public $selectedItemCategory;


    public function render()
    {
        $categories = Category::all();
        $listnames = Listname::all();
        $items = Item::where("name", "LIKE", "%" . $this->search . "%")->get();

        return view('livewire.show-items', compact("items", "categories", "listnames"));
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function addItem()
    {
        // lógica para agregar un nuevo elemento a la base de datos
        $newItem = new Item();
        $newItem->name = $this->name;
        $newItem->note = $this->note;
        $newItem->category_id = $this->category;
        $newItem->save();

        if ($this->imageUrl) {
            $imageData = file_get_contents($this->imageUrl);
            $fileName = uniqid() . '.png';
            $savePath = storage_path('app/public') . '/' . $fileName;
            file_put_contents($savePath, $imageData);

            // Asigna el nombre del archivo guardado a la propiedad "image" del nuevo item
            $newItem->image = $fileName;
            $newItem->save();
        }

        // restablece el estado y muestra la lista nuevamente
        $this->showForm = false;
        $this->search = ''; // Limpia el campo de búsqueda si es necesario
        $this->name = '';
        $this->note = '';
        $this->image = '';
        $this->category = '';
        $this->imageUrl = ''; // Limpia la URL de la imagen
    }

    public function showItemDetails($itemId)
{
    // Buscar el item en la base de datos por su ID
    $item = Item::find($itemId);

    //Almacenar los datos del item en propiedades del componente
    $this->selectedItemId = $item->id;
    $this->selectedItemImage = $item->image;
    $this->selectedItemName = $item->name;
    $this->selectedItemNote = $item->note;
    $this->selectedItemCategory = $item->category_id;
}

public function resetSelectedItem()
{
    $this->selectedItemId = null;
    $this->selectedItemImage = null;
    $this->selectedItemName = null;
    $this->selectedItemCategory = null;
    $this->selectedItemNote = null;
}

public function deleteSelectedItem()
{
    // Aquí puedes implementar la lógica para eliminar el item seleccionado de la base de datos
    // Por ejemplo, puedes usar el ID del item almacenado en $selectedItemId para eliminarlo

    // Después de eliminar el item, restablece el estado y muestra la lista nuevamente
    $this->resetSelectedItem();
}


}
