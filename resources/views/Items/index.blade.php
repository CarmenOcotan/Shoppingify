<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="ico" href="img/ico.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shoppingify</title>

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/674b7f77f6.js" crossorigin="anonymous"></script>

    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-100">
    
    <div class="flex">
        <div class="">
            <aside id="left" class="sticky bg-white z-50 top-0 left-0 w-20 h-screen" aria-label="Sidebar">
                <div class="flex flex-col justify-between h-full py-4  bg-white">
                    <div class="w-18 h-24 flex justify-center py-2.5">
                        <img src="img/logo.svg" alt="logo">
                    </div>
                    <ul class="flex flex-col gap-10 font-normal">
                        <li class="flex items-center pl-5" onclick="toggleHover(this)">
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30"><path d="M377-198v-60h463v60H377Zm0-252v-60h463v60H377Zm0-253v-60h463v60H377ZM189-161q-28.05 0-48.025-19Q121-199 121-227.5t19.5-48q19.5-19.5 48-19.5t47.5 19.975Q255-255.05 255-227q0 27.225-19.387 46.613Q216.225-161 189-161Zm0-252q-28.05 0-48.025-19.681Q121-452.362 121-480t19.975-47.319Q160.95-547 189-547q27.225 0 46.613 19.681Q255-507.638 255-480t-19.387 47.319Q216.225-413 189-413Zm-1-253q-27.637 0-47.319-19.681Q121-705.362 121-733t19.681-47.319Q160.363-800 188-800q27.637 0 47.319 19.681Q255-760.638 255-733t-19.681 47.319Q215.637-666 188-666Z"/></svg>
                            </a>
                        </li>
                        <li class="flex items-center pl-5" onclick="toggleHover(this)">
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30"><path d="M480-80q-75 0-140.5-28T225-185q-49-49-77-114.5T120-440h60q0 125 87.5 212.5T480-140q125 0 212.5-87.5T780-440q0-125-85-212.5T485-740h-23l73 73-41 42-147-147 147-147 41 41-78 78h23q75 0 140.5 28T735-695q49 49 77 114.5T840-440q0 75-28 140.5T735-185q-49 49-114.5 77T480-80Z"/></svg>
                            </a>
                        </li>
                        <li class="flex items-center pl-5" onclick="toggleHover(this)">
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30"><path d="M284-277h60v-275h-60v275Zm166 0h60v-406h-60v406Zm166 0h60v-148h-60v148ZM180-120q-24 0-42-18t-18-42v-600q0-24 18-42t42-18h600q24 0 42 18t18 42v600q0 24-18 42t-42 18H180Zm0-60h600v-600H180v600Zm0-600v600-600Z"/></svg>
                            </a>
                        </li>
                    </ul>
                    <div class="flex place-self-center static">
                        <div class="flex justify-center rounded-full bg-[#F9A109] text-center w-10 h-10 pt-2" >
                            <img class="w-" src="img/shopping_cart_FILL0_wght400_GRAD0_opsz48.svg" alt="shopping">
                        </div>
                    </div>

                </div>
            </aside>
        </div>
        @livewire('show-items')
    </div>  
    <script>
        function toggleHover(element) {
            const listItems = document.querySelectorAll('.flex.items-center');

            listItems.forEach(item => {
                item.classList.remove('border-l-4', 'border-yellow-500');
            });

            element.classList.add('border-l-4', 'border-yellow-500');

        }
    </script>

    @livewireScripts
   
</body>
</html>


