<section class="relative bg-white border-2 border-black rounded-xl p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden transition-all hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-1 duration-300">
    
    <div class="absolute -top-6 -right-6 w-24 h-24 bg-[#009DA5] rounded-full border-2 border-black opacity-20 pointer-events-none"></div>
    <div class="absolute top-10 right-10 w-4 h-4 bg-yellow-400 rounded-full border-2 border-black pointer-events-none"></div>
    <div class="absolute bottom-4 left-4 w-6 h-6 border-2 border-black transform rotate-45 pointer-events-none bg-pink-400"></div>

    <header class="relative z-10 mb-8">
        <div class="inline-block bg-[#009DA5] text-white px-3 py-1 border-2 border-black rounded shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] mb-2 rotate-[-2deg]">
            <h2 class="text-lg font-black uppercase tracking-widest">
                {{ __('Profile Information') }}
            </h2>
        </div>
        <p class="mt-2 text-sm font-bold text-gray-600 max-w-md">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="relative z-10 space-y-6">
        @csrf
        @method('patch')

        <div class="group">
            <x-input-label for="name" :value="__('Name')" class="font-black text-gray-800 mb-1 block uppercase text-xs tracking-wider" />
            
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 group-focus-within:text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <x-text-input id="name" name="name" type="text" 
                    class="pl-10 block w-full border-2 border-black rounded-lg bg-gray-50 focus:bg-white focus:border-[#009DA5] focus:ring-0 focus:shadow-[4px_4px_0px_0px_#009DA5] transition-all duration-200 placeholder-gray-400 font-medium" 
                    :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder="John Doe" />
            </div>
            <x-input-error class="mt-2 font-bold text-red-600 bg-red-100 p-2 border border-red-600 rounded" :messages="$errors->get('name')" />
        </div>

        <div class="group">
            <x-input-label for="email" :value="__('Email')" class="font-black text-gray-800 mb-1 block uppercase text-xs tracking-wider" />
            
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 group-focus-within:text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <x-text-input id="email" name="email" type="email" 
                    class="pl-10 block w-full border-2 border-black rounded-lg bg-gray-50 focus:bg-white focus:border-[#009DA5] focus:ring-0 focus:shadow-[4px_4px_0px_0px_#009DA5] transition-all duration-200 placeholder-gray-400 font-medium" 
                    :value="old('email', $user->email)" required autocomplete="username" placeholder="your@email.com" />
            </div>
            
            <x-input-error class="mt-2 font-bold text-red-600 bg-red-100 p-2 border border-red-600 rounded" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-yellow-50 border-2 border-dashed border-yellow-500 rounded-lg flex items-start gap-3">
                    <svg class="w-6 h-6 text-yellow-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <div>
                        <p class="text-sm text-gray-800 font-bold">
                            {{ __('Your email address is unverified.') }}
                        </p>
                        <button form="send-verification" class="mt-1 underline text-sm text-[#009DA5] hover:text-black font-bold transition-colors">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </div>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-black text-sm text-green-600 border border-green-600 bg-green-100 px-2 py-1 inline-block rounded">
                        {{ __('Link Sent!') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button class="bg-black hover:bg-[#009DA5] text-white border-2 border-black shadow-[4px_4px_0px_0px_#009DA5] hover:shadow-[2px_2px_0px_0px_#000000] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 rounded-lg py-3 px-6 font-black tracking-widest uppercase text-xs">
                {{ __('Save Changes') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="flex items-center gap-2 text-sm text-black font-bold bg-[#009DA5]/20 px-3 py-1 rounded-full border border-[#009DA5]"
                >
                    <i class="fas fa-check text-[#009DA5]"></i>
                    {{ __('Saved.') }}
                </div>
            @endif
        </div>
    </form>
</section>