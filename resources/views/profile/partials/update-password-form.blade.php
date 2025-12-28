<div class="relative">
    
    <div class="absolute top-2 left-2 w-full h-full bg-[#8B5CF6] border-2 border-black rounded-xl z-0"></div>

    <section class="relative z-10 bg-white border-2 border-black rounded-xl p-6 sm:p-8 overflow-hidden">
        
        <header class="flex items-start justify-between border-b-4 border-black border-dashed pb-6 mb-8">
            <div class="max-w-md">
                <h2 class="text-2xl font-black text-black uppercase tracking-tighter transform -rotate-1">
                    {{ __('Update Password') }}
                </h2>
                <p class="mt-2 text-sm font-bold text-gray-600 bg-yellow-300 inline-block px-2 py-1 border border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    {{ __('Ensure your account is using a long, random password.') }}
                </p>
            </div>
            <div class="hidden sm:flex bg-black text-[#8B5CF6] w-12 h-12 border-2 border-black items-center justify-center rounded-lg shadow-[4px_4px_0px_0px_#8B5CF6]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <div>
                <x-input-label for="update_password_current_password" :value="__('Current Password')" class="inline-block bg-black text-white px-2 py-1 mb-1 font-bold text-xs uppercase tracking-widest rounded-tr-lg" />
                
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-20">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11.536 11l-4.414 4.414a1 1 0 01-1.414 0l-1.414-1.414a1 1 0 010-1.414l4.414-4.414a6 6 0 015.743-7.743A2 2 0 0115 7z"></path></svg>
                    </div>
                    <div class="absolute inset-y-2 left-10 w-0.5 bg-gray-300 z-20"></div>

                    <x-text-input id="update_password_current_password" name="current_password" type="password" 
                        class="pl-14 block w-full border-2 border-black rounded-lg shadow-sm focus:border-black focus:ring-0 focus:shadow-[4px_4px_0px_0px_#8B5CF6] transition-all duration-200 bg-gray-50" 
                        autocomplete="current-password" placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 font-bold text-red-600" />
            </div>

            <div>
                <x-input-label for="update_password_password" :value="__('New Password')" class="inline-block bg-black text-white px-2 py-1 mb-1 font-bold text-xs uppercase tracking-widest rounded-tr-lg" />
                
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-20">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div class="absolute inset-y-2 left-10 w-0.5 bg-gray-300 z-20"></div>

                    <x-text-input id="update_password_password" name="password" type="password" 
                        class="pl-14 block w-full border-2 border-black rounded-lg shadow-sm focus:border-black focus:ring-0 focus:shadow-[4px_4px_0px_0px_#8B5CF6] transition-all duration-200 bg-gray-50" 
                        autocomplete="new-password" placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 font-bold text-red-600" />
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="inline-block bg-black text-white px-2 py-1 mb-1 font-bold text-xs uppercase tracking-widest rounded-tr-lg" />
                
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-20">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="absolute inset-y-2 left-10 w-0.5 bg-gray-300 z-20"></div>

                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                        class="pl-14 block w-full border-2 border-black rounded-lg shadow-sm focus:border-black focus:ring-0 focus:shadow-[4px_4px_0px_0px_#8B5CF6] transition-all duration-200 bg-gray-50" 
                        autocomplete="new-password" placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 font-bold text-red-600" />
            </div>

            <div class="flex items-center gap-4 pt-2">
                <x-primary-button class="bg-[#8B5CF6] hover:bg-[#7c3aed] text-white border-2 border-black shadow-[4px_4px_0px_0px_#000000] hover:shadow-[2px_2px_0px_0px_#000000] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 rounded-lg py-3 px-6 font-black tracking-widest uppercase text-xs">
                    {{ __('Save') }}
                </x-primary-button>

                @if (session('status') === 'password-updated')
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="flex items-center gap-2 text-sm text-black font-bold bg-[#8B5CF6]/20 px-4 py-2 border-2 border-black rounded-lg transform rotate-2"
                    >
                        <i class="fas fa-shield-alt text-[#8B5CF6]"></i>
                        {{ __('Secure!') }}
                    </div>
                @endif
            </div>
        </form>
    </section>
</div>