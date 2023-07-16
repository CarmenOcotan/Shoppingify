<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemListname;
use App\Models\Listname;

;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //Arreglo con todas las categorias
        $categories = ["Fruits and Vegetables","Meat and Fish", "Beverages"];

        //Se insertan cada elemento del arreglo en la tabla "categories"
        foreach ($categories as $category){
            DB::table("categories")->insert([
                "name" => $category
            ]);
        }

        //Ejecuto el facctory que crea los items
        Item::factory(15)->create();

        //Ejecuto el facctory que crea los nombres de las listas
        Listname::factory(5)->create();

          //Ejecuto el facctory que crea los items relasionados a las listas
        ItemListname::factory(15)->create();
    }
}
