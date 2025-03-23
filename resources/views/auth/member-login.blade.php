

<x-guest-layout>
    <div style="padding-top:50px;">
        <h1 style="text-align:center; font-size: 32px;">ចូលគណនី</h1>

        <!-- Display Session Messages -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('memberLogin') }}">
            @csrf

            <!-- Phone Number or Email -->
            <div>
                <x-input-label for="username" :value="__('បញ្ចូលលេខទូរសព្ទដែលបានចុះឈ្មោះ')" />
                <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" required autofocus />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

<!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />
    <div class="relative">
        <x-text-input id="password" class="block mt-1 w-full pr-20" type="password" name="password" required />
        <button type="button" class="absolute right-2 top-2 text-sm text-gray-600 toggle-password" data-target="password">បង្ហាញលេខសម្ងាត់</button>
    </div>
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

            

            <div class="grid items-center justify-center mt-4">
                <x-primary-button class="w-100 text-center">
                    ចូល
                </x-primary-button>
            </div>
        </form>

        <p class="text-center mt-3">
            តើលោកអ្នកមិនទាន់មានគណនីទេឬ? <a href="{{ route('memberFormRegister') }}">បង្កើតថ្មី </a>
        </p>

        {{-- <p class="text-center mt-3">
            <a href="{{ route('forgotPasswordForm') }}">Forgot your password?</a>
        </p> --}}
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleButtons = document.querySelectorAll('.toggle-password');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const input = document.getElementById(this.dataset.target);
                    const type = input.getAttribute("type") === "password" ? "text" : "password";
                    input.setAttribute("type", type);
                    this.textContent = type === "password" ? "បង្ហាញលេខសម្ងាត់" : "បិទលេខសម្ងាត់";
                });
            });
        });
    </script>
    


</x-guest-layout>

