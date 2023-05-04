<header class="flex justify-between sm:hidden mx-3 py-2 h-16">
    <button class="bg-red rounded-full w-12"><i class="fa fa-user text-2xl"></i></button>
    <a href="/chat" class="align-self-center bg-red rounded-full w-12 flex justify-center items-center"><i class="fa fa-comments text-2xl"></i></a>
</header>

<header class="hidden justify-between bg-red p-3 sm:flex">
    <div class="flex gap-x-5 ml-3">
        <button class=""><i class="fa fa-house text-2xl"></i></button>
        <button class=""><i class="fa fa-compass text-2xl"></i></button>
    </div>

    <div class="flex gap-x-5 mr-3">
        <div id="notify"></div>
        <button class=""><i class="fa fa-search text-2xl"></i></button>
        <a href="/chat"><i class="fa fa-comments text-2xl"></i></a>
        <div class="relative inline-block text-left">
            <button type="button" class="" id="user-menu" aria-expanded="false" aria-haspopup="true"
                onclick="toggleMenu()">
                <i class="fa fa-user text-2xl"></i>
            </button>

            <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                role="menu" aria-orientation="vertical" aria-labelledby="user-menu" id="dropdown-menu">
                <div class="py-1" role="none">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                        role="menuitem">Profile</a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                        role="menuitem">Configuration</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900
                             :href="route('logout')"
                                             onclick="event.preventDefault();
                            this.closest('form').submit();" role="menuitem"><button>Log Out</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    var menu = document.getElementById("dropdown-menu");
    menu.style.display = "none"

    function toggleMenu() {
        var menu = document.getElementById("dropdown-menu");
        if (menu.style.display === "block") {
            menu.style.display = "none";
        } else {
            menu.style.display = "block";
        }
    }
</script>
