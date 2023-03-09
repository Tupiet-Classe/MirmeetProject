<footer class="flex justify-around bg-red p-3 sm:hidden h-16">
    <button class=""><i class="fa fa-house text-2xl"></i></button>
    <button class=""><i class="fa fa-compass text-2xl"></i></button>
    <button class="bg-purple px-3 py-1 rounded-md"><i class="fa fa-add text-2xl text-white"></i></button>
    <button class=""><i class="fa fa-search text-2xl"></i></button>
    <button class=""><i class="fa fa-bell text-2xl"></i></button>
</footer>
@section('content')
<div class="hidden sm:block absolute bottom-0 right-0 p-3">
    <add-post1 />
</div>
@endsection