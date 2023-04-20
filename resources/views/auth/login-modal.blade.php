<!-- Login modal work-->
<div id="loginModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="absolute bottom-0 right-0 mr-4">
        <div class="rounded-lg w-full max-w-md">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display(['data-callback' => 'callback']) !!}
        </div>
    </div>
</div>

<!-- Login modal no work-->
{{-- <div id="loginModal" tabindex="-1" aria-hidden="true" class="fixed bottom-0 left-0 right-0 z-50 hidden w-full max-h-full">
    <div class="absolute bottom-0 right-0 mr-4 mb-4">
        <div class="rounded-lg w-full max-w-md">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display(['data-callback' => 'callback']) !!}
        </div>
    </div>
</div> --}}
  

