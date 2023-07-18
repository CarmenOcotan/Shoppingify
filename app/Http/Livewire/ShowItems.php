<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Item;
use App\Models\Listname;
use Illuminate\Support\Collection;
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
    public $selectedItemName;
    public $selectedItemNote;
    public $selectedItemCategory;
    public $selectedItem;
    public $showNoItems = true;
    public $selectedCategories;
    public $selectedCategory;

    public function mount()
    {
        $this->selectedCategories = new Collection();
    }

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
        // Lógica para agregar un nuevo elemento a la base de datos
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

        // Restablece el estado y muestra la lista nuevamente
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

        // Almacenar los datos del item en propiedades del componente
        $this->selectedItemId = $item->id;
        $this->selectedItemImage = $item->image;
        $this->selectedItemName = $item->name;
        $this->selectedItemNote = $item->note;
        $this->selectedItemCategory = $item->category->name;
        $this->selectedItem = $item;

        // Resetear la colección de categorías seleccionadas
        $this->selectedCategories = new Collection();
    }

    public function resetSelectedItem()
    {
        $this->selectedItemId = null;
        $this->selectedItemImage = null;
        $this->selectedItemName = null;
        $this->selectedItemCategory = null;
        $this->selectedItemNote = null;
        $this->selectedItem = null;

        $this->showNoItems = true;

        // Resetear la colección de categorías seleccionadas
        $this->selectedCategories = new Collection();
    }

    public function deleteSelectedItem()
    {
        // Lógica para eliminar el item seleccionado de la base de datos

        // Después de eliminar el item, restablece el estado y muestra la lista nuevamente
        $this->resetSelectedItem();
    }

    public function showItemCat($itemId)
    {
        // Buscar el item en la base de datos por su ID
        $item = Item::find($itemId);

        // Almacenar el item seleccionado en la propiedad del componente
        $this->selectedItem = $item;

        // Agregar la categoría seleccionada a la colección
        $this->selectedCategories->push($item->category->name);

        // Mostrar el div de "ItemsSelect" y ocultar el div de "NoItems"
        $this->showNoItems = false;
    }


    

}
