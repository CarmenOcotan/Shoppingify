<div class="flex font-quicksand">
    <div class="px-20">
        <div class="flex pt-9 relative flex-1">
            <div class="font-quicksand text-2xl font-bold">
                <p>
                    <span class="text-[#F9A109]">Shoppingify</span> allows you to take your shopping list wherever you go.
                </p>
            </div>
            <div>  
                <div class="relative focus:border-none focus:ring-0 outline-none">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input wire:model="search" type="text" class="shadow-md block p-4 pl-10 text-sm bg-white rounded-lg focus:outline-none focus:border-none focus:ring-0" placeholder="Search Items" required>
                </div>
            </div>
        </div>
        <div class="mt-12">
            <div class="font-quicksand font-medium">
                @if (count($items) == 0)
                    <h2 class="font-quicksand font-bold">No se encontraron resultados</h2>
                @else
                    @foreach ($categories as $category)
                        @php
                            $categoryItems = $items->where('category_id', $category->id);
                        @endphp
                        @if ($categoryItems->count() > 0)
                            <div class="mb-3 mt-8">{{ $category->name }}</div>
                            <div class="grid grid-cols-4 gap-3">
                                @foreach ($categoryItems as $item)
                                    <div class="bg-white rounded-lg shadow-md flex justify-between w-40 cursor-pointer p-3">
                                        <button wire:click="showItemDetails({{ $item->id }})" class="flex-grow-1 h-auto">{{ $item->name }}</button>
                                        <button wire:click="showItemCat({{ $item->id }})" class="text-gray-500 dark:text-gray-400">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div> 
    <div class="">
        <div class="">
            <aside id="right" class="sticky overflow-y-auto h-screen top-0 right-0 w-96 " aria-label="Sidebar">
                <div class="p-8 pb-0 flex h-full flex-col bg-[#FFF0DE] justify-between items-center">
                    <div class="bg-[#80485B]  flex h-[129.91px] rounded-3xl flex-row gap-12 w-auto">
                        <div class="ml-4 mr-12 mb-6">
                            <img class="absolute left-13 top-3" src="img/source.svg" alt="">
                        </div>
                        <div class="pb-3 pt-3 pl-4 pr-4 font-quicksand font-bold">
                            <p class="font-quicksand font-bold text-white mb-2 ">Didn't find what you need?</p>
                            <button wire:click="toggleForm" class="w-28 h-10 flex items-center justify-center bg-white text-[#34333A] rounded-lg hover:bg-slate-100 font-bold" type="submit">Add item</button>  
                        </div>
                    </div>
                <div class="ItemsSelect flex flex-col ">
                    @if ($selectedItem)
                        <div class="font-bold text-2xl ">
                            Shopping list
                        </div>
                        <div class="flex flex-col gap-3 font-medium">
                            <div class="text-[#828282]">
                                {{ $selectedItem->category->name }}
                            </div>
                            <div class="text-lg">
                                {{ $selectedItem->name }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="NoItems" wire:loading.remove>
                    @if ($showNoItems)
                        <div>
                            <h1 class="font-bold">No items</h1>
                        </div>
                        <div>
                            <img src="img/undraw_shopping_app_flsj.svg" alt="">
                        </div>
                    @endif
                </div>
                </div> 
                <div class="h-24 bg-white flex justify-center">
                    <form class="text-black flex justify-center items-center ">
                        <div class="flex border-2 rounded-lg border-[#BDBDBD]"> 
                            <input wire:model="name" type="text" id="name" class="h-14 focus:outline-none bg-inherit placeholder-[#BDBDBD] text-sm w-full p-2.5" placeholder="Enter a name" required disabled>
                            <button type="submit" class="h-14 text-white bg-[#C1C1C4] rounded-lg text-sm w-auto sm:w-auto px-5 py-2.5 text-center cursor-not-allowed">Save</button>
                        </div>
                    </form>
                </div>
            </aside>
        </div>
        @if ($showForm)
            <div id="add" class="fixed inset-0 z-50 flex items-center justify-end">
                <div class="p-8 bg-gray-100 h-screen w-96 overflow-y-auto">
                    <form wire:submit.prevent="addItem">
                        <div class="font-quicksand">
                            <h5 class="mb-5 text-2xl">Add a new item</h5>
                            <div class="gap-4 flex flex-col">
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-black">Name</label>
                                    <input wire:model="name" type="text" id="name" class="h-14 focus:outline-none bg-inherit border-2 border-[#BDBDBD] placeholder-[#BDBDBD] text-sm rounded-lg w-full p-2.5" placeholder="Enter a name" required>
                                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="note" class="block mb-2 text-sm font-medium text-black">Note (optional)</label>
                                    <textarea wire:model="note" rows="4" id="note" class="focus:outline-none bg-inherit border-2 border-[#BDBDBD] placeholder-[#BDBDBD] text-sm rounded-lg w-full p-2.5" placeholder="Enter a note"></textarea>
                                    @error('note') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="image" class="block mb-2 text-sm font-medium text-black">Image (optional)</label>
                                    <input wire:model="imageUrl" type="text" id="image" class="h-14 focus:outline-none bg-inherit border-2 border-[#BDBDBD] placeholder-[#BDBDBD] text-sm rounded-lg w-full p-2.5" placeholder="Enter a URL">
                                    @error('imageUrl') <span class="text-red-500">{{ $message }}</span> @enderror   
                                </div>
                                <div>
                                    <label for="category" class="block mb-2 text-sm font-medium text-black">Category</label>
                                    <select wire:model="category" id="category" class="h-14 focus:outline-none bg-inherit border-2 border-[#BDBDBD] placeholder-[#BDBDBD] text-sm rounded-lg w-full p-2.5 appearance-none"> required>
                                        <option class="text-[#BDBDBD]" value="">Enter a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                                
                            </div>
                        </div>
                        <div class="mt-8 flex justify-center items-center gap-4 font-bold">
                            <button wire:click="toggleForm" type="button" class="text-black text-sm w-full sm:w-auto px-5 py-2.5 text-center">Cancel</button>
                            <button type="submit" class="h-16 text-white bg-[#F9A109] rounded-lg text-sm w-20 sm:w-auto px-5 py-2.5 text-center">Save</button>
                        </div>
                    </form>
                </div> 
            </div>
        @endif
        @if ($selectedItemId)
        <div id="show" class="sticky inset-0 z-50 flex justify-end">
            <div class="p-8 bg-white h-screen w-96 overflow-y-auto">
                <div class="flex justify-center mb-6">
                    <img class="w-auto rounded-3xl" src="{{ asset('storage/' . $selectedItemImage) }}" alt="img">
                </div>
                <div class="flex flex-col gap-3">
                    <div>
                        <div class="text-xs text-[#C1C1C4] font-medium">
                            name
                        </div>
                        <div class="text-2xl font-medium">
                            {{ $selectedItemName }}
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-[#C1C1C4] font-medium">
                            category
                        </div>
                        <div class="font-medium">
                            {{ $selectedItemCategory}}
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-[#C1C1C4] font-medium">
                            note
                        </div>
                        <div class="font-medium">
                            {{ $selectedItemNote }}
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-center items-center gap-4 font-bold">
                    <button wire:click="deleteSelectedItem" type="button" class="text-black text-sm w-full sm:w-auto px-5 py-2.5 text-center">delete</button>
                    <button type="submit" class="h-16 text-white bg-[#F9A109] rounded-lg text-sm w-20 sm:w-auto px-5 py-2.5 text-center">Add to list</button>
                </div>   
            </div>
        </div>
        @endif
    </div>
</div>
