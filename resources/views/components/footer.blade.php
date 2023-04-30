<footer class="flex justify-around bg-red p-3 sm:hidden h-16">
    <a href="/home" class=""><i class="fa fa-house text-2xl"></i></a>
    <a href="/discover" class=""><i class="fa fa-compass text-2xl"></i></a>
    <div id="post2"></div>
    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'search-user-responsive')">
        <i class="fa fa-search text-2xl"></i>
    </button>
    <div id="notify2"></div>
</footer>
<div id="post1" class="mb-3">
</div>

<x-search-responsive/>