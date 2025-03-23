<x-guest-layout>
    <div style="padding-top:50px;">
        <h1 style="text-align:center; font-size: 32px;">បង្កើតគណនីថ្មី</h1>

        <form method="POST" action="{{ route('memberRegister') }}">
            @csrf

            <!-- Full Name -->
            <div>
                <x-input-label for="full_name" :value="__('ឈ្មោះពេញ')" />
                <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" required autofocus />
                <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-input-label for="phone_number" :value="__('លេខទូរសព្ទ')" />
                <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" required />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('លេខសម្ងាត់')" />
                <x-text-input id="password" class="block mt-1 w-full pr-20" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('បញ្ជាក់លេខសម្ងាត់')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-20" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Show/Hide Password Button -->
            <div class="mt-2 text-right">
                <button type="button"
                    class="px-2 py-1 text-xs bg-gray-200 rounded toggle-both-passwords text-gray-600">
                    បង្ហាញលេខសម្ងាត់
                </button>
            </div>

            <div class="grid items-center justify-center mt-4">
                <x-primary-button class="w-100 text-center">
                    បង្កើតថ្មី
                </x-primary-button>
            </div>
        </form>

        <p class="text-center mt-3">
            តើអ្នកមានគណនីហើយឬនៅ? <a href="{{ route('memberFormLogin') }}">ចូលប្រើ</a>
        </p>
    </div>

    <!-- Toggle Both Passwords Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleBtn = document.querySelector('.toggle-both-passwords');
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirmation');

            toggleBtn.addEventListener('click', function () {
                const type = passwordInput.type === "password" ? "text" : "password";
                passwordInput.type = type;
                confirmInput.type = type;
                toggleBtn.textContent = type === "password" ? "បង្ហាញលេខសម្ងាត់" : "បិទលេខសម្ងាត់";
            });
        });
    </script>
</x-guest-layout>
