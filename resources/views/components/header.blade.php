<header class="flex justify-between sm:hidden mx-3 py-2 h-16">
    <div class="bg-red rounded-full mx-3 mt-2 mb-0 py-1 px-2">
        <button type="button" class="" id="user-menu" aria-expanded="false" aria-haspopup="true"
            onclick="toggleMenu()">
            <i class="fa fa-user text-2xl"></i>
        </button>

        <div class="origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
            role="menu" aria-orientation="vertical" aria-labelledby="user-menu" id="dropdown-menu2">
            <div class="py-1" role="none">
                <a href="{{ route('my') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                    role="menuitem">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
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
    <a href="/chat" class="bg-red rounded-full mx-3 mt-2 mb-0 py-1 px-2"><i class="fa fa-comments text-2xl"></i></a>
</header>

<header class="hidden justify-between bg-red p-3 sm:flex">
    <div class="flex gap-x-5 ml-3">
        <a href="/home" class=""><i class="fa fa-house text-2xl"></i></a>
        <a href="/discover" class=""><i class="fa fa-compass text-2xl"></i></a>
    </div>

    <div class="flex gap-x-5 mr-3">
        <div id="notify"></div>

        <div id="search"></div>

        <a href="/chat"><i class="fa fa-comments text-2xl"></i></a>

        <div class="relative inline-block text-left">
            <button type="button" class="" id="user-menu" aria-expanded="false" aria-haspopup="true"
                onclick="toggleMenu()">
                <i class="fa fa-user text-2xl"></i>
            </button>

            <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                role="menu" aria-orientation="vertical" aria-labelledby="user-menu" id="dropdown-menu">
                <div class="py-1" role="none">
                    <a href="{{ route('my') }}"
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
    var menu2 = document.getElementById("dropdown-menu2");
    menu2.style.display = "none"

    function toggleMenu() {
        var menu = document.getElementById("dropdown-menu");
        var menu2 = document.getElementById("dropdown-menu2");

        if (menu.style.display === "block") {
            menu.style.display = "none";
        } else {
            menu.style.display = "block";
        }

        if (menu2.style.display === "block") {
            menu2.style.display = "none";
        } else {
            menu2.style.display = "block";
        }
    }
</script>
