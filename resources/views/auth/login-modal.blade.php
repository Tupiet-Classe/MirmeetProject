<!-- Login modal-->
<style>
    .bg-gray-900{
    --tw-bg-opacity: 0 !important;
    background-color: transparent !important;
}
</style>
<div id="loginModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="bg-green-500 rounded-md absolute bottom-0 right-0 mr-4">
        <div class="w-full max-w-md">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display(['data-callback' => 'callback']) !!}
        </div>
    </div>
</div>