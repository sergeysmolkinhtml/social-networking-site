<div class="max-w-2xl mx-auto p-8">
    <h2 class="sm:text-lg sm:leading-snug font-semibold tracking-wide uppercase text-pink-600">introducing ...</h2>
    <p class="text-5xl lg:text-6xl leading-none font-extrabold text-gray-900 mb-8 mt-4">Stories</p>

    <ul class="flex space-x-6">
        <li class="flex flex-col items-center space-y-1 ">
            <div class="relative bg-gradient-to-tr from-yellow-400 to-purple-600 p-1 rounded-full">
                <a href="#" class="block bg-white p-1 rounded-full transform transition hover:-rotate-6">
                    <img class="w-24 h-24 rounded-full" src="https://placekitten.com/200/200" alt="cute kitty"
                         onclick="showModal('https://www.kindacode.com/wp-content/uploads/2022/07/flower-4.jpeg')">
                </a>
                <button class="absolute bg-blue-500 text-white text-2xl font-medium w-8 h-8 rounded-full bottom-0 right-1 border-4 border-white flex justify-center items-center font-mono hover:bg-blue-700 focus:outline-none">
                    <div class="transform -translate-y-px">+</div>
                </button>
            </div>

            <a href="#">kitty_one</a>
        </li>

        <li class="flex flex-col items-center space-y-1 ">
            <div class="bg-gradient-to-tr from-yellow-400 to-purple-600 p-1 rounded-full">
                <a href="#" class="block bg-white p-1 rounded-full transform transition hover:-rotate-6">
                    <img class="w-24 h-24 rounded-full" src="https://placekitten.com/201/200" alt="cute kitty"
                         onclick="showModal('https://www.kindacode.com/wp-content/uploads/2022/07/flower-3.jpeg')">
                </a>
            </div>

            <a href="#">kitty_two</a>
        </li>

        <li class="flex flex-col items-center space-y-1 ">
            <div class="bg-gradient-to-tr from-yellow-400 to-purple-600 p-1 rounded-full">
                <a href="#" class="block bg-white p-1 rounded-full transform transition hover:-rotate-6">
                    <img class="w-24 h-24 rounded-full" src="https://placekitten.com/200/203" alt="cute kitty"
                         onclick="showModal('https://www.kindacode.com/wp-content/uploads/2022/07/flower-2.jpeg')">
                </a>
            </div>

            <a href="#">kitty_three</a>
        </li>

        <li class="flex flex-col items-center space-y-1 ">
            <div class="bg-gradient-to-tr from-yellow-400 to-purple-600 p-1 rounded-full">
                <a href="#" class="block bg-white p-1 rounded-full transform transition hover:-rotate-6">
                    <img class="w-24 h-24 rounded-full" src="https://placekitten.com/202/201" alt="cute kitty"
                         onclick="showModal('https://www.kindacode.com/wp-content/uploads/2022/07/flower-1.jpeg')">
                </a>
            </div>

            <a href="#">kitty_four</a>
        </li>

    </ul>
</div>


<div id="modal"
     class="hidden fixed top-0 left-0 z-80 w-screen h-screen bg-black/70 flex justify-center items-center">


    <a class="fixed z-90 top-6 right-8 text-white text-5xl font-bold" href="javascript:void(0)"
       onclick="closeModal()">&times;</a>


    <img id="modal-img" class="max-w-[800px] max-h-[600px] object-cover" />
</div>

<script>
    // Get the modal by id
    var modal = document.getElementById("modal");

    // Get the modal image tag
    var modalImg = document.getElementById("modal-img");

    function showModal(src) {
        modal.classList.remove('hidden');
        modalImg.src = src;
    }

    function closeModal() {
        modal.classList.add('hidden');
    }
</script>
