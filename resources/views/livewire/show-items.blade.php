<div class="bg-gray-100 px-20">
    <div class=" flex  pt-9 relative flex-1">
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
                <input wire:model="search" type="text" class="block p-4 pl-10 text-sm bg-white rounded-lg focus:border-none focus:ring-0" placeholder="Search Items" required>
            </div>
        </div>
    </div>
    <div class="mt-12">
        <div class="font-quicksand font-medium">
            @foreach ($categories as $category)
                <div class="mb-3 mt-8">{{$category->name}}</div>
                <div class="grid grid-cols-4 gap-3">
                    @foreach ($listnames as $listname)
                        @foreach ($listname->items as $item)
                            @if ($item->category_id === $category->id)
                                <div class="bg-white rounded-lg shadow-md flex justify-between w-40 cursor-pointer p-3">
                                    <button class="flex-grow-1 h-auto">{{$item->name}}</button>
                                    <button class="text-gray-500 dark:text-gray-400">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>