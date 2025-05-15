<x-guest-layout>
    <div style="padding-top:50px;">
        <h1 style="text-align:center; font-size: 32px;">ចូលគណនី</h1>

        <!-- Session Message -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <!-- Toggle Login Options -->
        <div class="text-center mb-4">
            <a href="{!! route('memberFormLogin',['type'=>'simple']) !!}" type="button" id="btnPasswordLogin"
               class="underline text-blue-600 me-4">ចូលដោយពាក្យសម្ងាត់</a>
            <a type="button" href="{!! route('memberFormLogin',['type'=>'phone']) !!}" id="btnOtpLogin"
               class="underline text-green-600">ប្រើលេខទូរស័ព្ទ</a>
        </div>
        @if(\Illuminate\Support\Facades\Request::get('type')!='phone')
        <!-- 🔐 Password Login Form -->
            <form method="POST" action="{{ route('memberLogin') }}" id="passwordLoginForm"
            >
            @csrf

            <!-- Phone or Email -->
                <div>
                    <x-input-label for="username" :value="__('បញ្ចូលលេខទូរសព្ទដែលបានចុះឈ្មោះ')"/>
                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" required
                                  autofocus/>
                    <x-input-error :messages="$errors->get('username')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')"/>
                    <div class="relative">
                        <x-text-input id="password" class="block mt-1 w-full pr-20" type="password" name="password"
                                      required/>
                        <button type="button" class="absolute right-2 top-2 text-sm text-gray-600 toggle-password"
                                data-target="password">បង្ហាញលេខសម្ងាត់
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <div class="grid items-center justify-center mt-4">
                    <x-primary-button class="w-100 text-center">ចូល</x-primary-button>
                </div>
            </form>
            <!-- 📱 OTP Login Form -->
        @else

            <form method="POST" action="{{ route('otp.verify') }}" id="otpLoginForm"
            >
            @csrf

            <!-- Phone Input -->
                <div>
                    <x-input-label for="phone" :value="__('លេខទូរស័ព្ទ')"/>
                    <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" value="855" required/>
                    <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
                </div>

                @if (!session('otp_sent'))
                    <div class="grid items-center justify-center mt-4">
                        <x-primary-button formaction="{{ route('otp.request') }}" class="w-100 text-center">
                            ផ្ញើលេខកូដ "OTP"
                        </x-primary-button>
                    </div>
                @endif

                @if (session('otp_sent'))
                  
                    <div class="mt-4">
                        <x-input-label for="otp" :value="__('បញ្ចូលលេខ OTP')"/> 
                        <x-text-input id="otp" class="block mt-1 w-full" type="text" name="otp" required/>
                        <x-input-error :messages="$errors->get('otp')" class="mt-2"/>
                    </div>

                    {{-- <div class="grid items-center justify-center mt-4" style="display: none">
                        <x-primary-button formaction="{{ route('otp.request') }}" class="w-100 text-center">
                           ផ្ញើលេខកូដ "OTP" ម្តងទៀត
                        </x-primary-button>
                    </div> --}}
                    <div class="grid items-center justify-center mt-4">
                        <x-primary-button class="w-100 text-center">ផ្ទៀងផ្ទាត់</x-primary-button>
                    </div>
                @endif
            </form>
        @endif
        <p class="text-center mt-3">
            តើលោកអ្នកមិនទាន់មានគណនីទេឬ? <a href="{{ route('memberFormRegister') }}">បង្កើតថ្មី</a>
        </p>
    </div>



</x-guest-layout>
