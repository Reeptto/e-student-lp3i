<section class="relative overflow-hidden bg-white border-4 border-black border-dashed rounded-xl p-6 sm:p-8">
    
    <div class="absolute inset-0 opacity-10 pointer-events-none" 
         style="background-image: repeating-linear-gradient(45deg, #009DA5 0, #009DA5 1px, transparent 0, transparent 50%); background-size: 10px 10px;">
    </div>

    <header class="relative z-10 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
        <div class="max-w-xl">
            <h2 class="text-2xl font-black text-black uppercase tracking-tighter bg-white inline-block px-2 border-2 border-transparent">
                {{ __('Delete Account') }}
                <span class="text-red-500">!!!</span>
            </h2>

            <p class="mt-2 text-sm font-bold text-gray-600 bg-white/80 backdrop-blur-sm p-2 border-l-4 border-black">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        </div>

        <div class="hidden sm:flex shrink-0 w-16 h-16 bg-black text-white items-center justify-center rounded-full border-4 border-white shadow-[0px_0px_0px_4px_#000000]">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </div>
    </header>

    <div class="mt-8 relative z-10">
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="bg-red-500 hover:bg-red-600 text-white border-2 border-black shadow-[4px_4px_0px_0px_#000] hover:shadow-[2px_2px_0px_0px_#000] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 rounded-lg py-3 px-6 font-black tracking-widest uppercase text-xs w-full sm:w-auto flex justify-center"
        >
            <span class="mr-2">⚠️</span> {{ __('Delete Account') }}
        </x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white border-4 border-black shadow-[8px_8px_0px_0px_#009DA5] rounded-none relative">
            @csrf
            @method('delete')

            <div class="absolute top-0 left-0 w-full h-4 bg-black flex gap-1 items-center px-2">
                <div class="w-2 h-2 rounded-full bg-red-500"></div>
                <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                <div class="w-2 h-2 rounded-full bg-[#009DA5]"></div>
            </div>

            <div class="mt-4 text-center">
                <div class="w-16 h-16 bg-red-100 text-red-600 border-2 border-black rounded-full flex items-center justify-center mx-auto mb-4">
                     <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>

                <h2 class="text-xl font-black text-black uppercase">
                    {{ __('Are you sure?') }}
                </h2>

                <p class="mt-2 text-sm font-medium text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.') }}
                </p>
            </div>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <div class="relative">
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-full border-2 border-black rounded-lg shadow-sm focus:border-black focus:ring-0 focus:shadow-[4px_4px_0px_0px_#009DA5] transition-all duration-200 bg-gray-50 text-center"
                        placeholder="{{ __('Type Password to Confirm') }}"
                    />
                </div>

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 font-bold text-red-600 text-center" />
            </div>

            <div class="mt-6 flex justify-center gap-4">
                <x-secondary-button x-on:click="$dispatch('close')" 
                    class="bg-white hover:bg-gray-100 text-black border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)] hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px] rounded-lg py-2 font-bold uppercase tracking-wide">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="bg-red-600 hover:bg-red-700 text-white border-2 border-black shadow-[4px_4px_0px_0px_#000] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] rounded-lg py-2 font-black uppercase tracking-wide">
                    {{ __('Yes, Delete It') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>