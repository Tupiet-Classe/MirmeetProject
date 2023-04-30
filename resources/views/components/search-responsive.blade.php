<x-modal name="search-user-responsive">
    <form method="post" action="{{ route('search.responsive') }}" class="p-6">
        @csrf

        <div class="mt-6">
            <x-text-input id="search" name="username" type="text" class="mt-1 block w-3/4"
                placeholder="Buscar usuario" required/>

            @if ($errors->has('username'))
                <div class="mt-2 text-red-500">
                    {{ $errors->first('username') }}
                </div>
            @endif
        </div>

        <div class="mt-6 flex justify-end">
            <x-danger-button x-on:click="$dispatch('close')">
                {{ __('Cancelar') }}
            </x-danger-button>

            <x-primary-button class="ml-3 bg-green-600">
                {{ __('Buscar') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>