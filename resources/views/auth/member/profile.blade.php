<!-- Bootstrap 5 CSS (Make sure this is included in your page) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body text-center p-4">

                    <!-- Profile Icon -->
                    {{-- <div class="mb-3">
                        <img src="{{ asset('storage/' . $customer->userphoto) }}" alt="Profile Photo" class="rounded-circle shadow" width="100" height="100" style="object-fit: cover;">
                    </div> --}}


                <!-- Avatar -->
                <div class="mb-3">
                    {{-- <label for="avatar" class="form-label">Profile Picture</label><br> --}}
                    @if ($customer->userphoto)
                        <img src="{{ asset('storage/' . $customer->userphoto) }}" alt="Profile Picture" class="rounded-circle mb-2" width="100" height="100" style="object-fit: cover;">
                    @else
                        <img src="{{ asset('storage/customer_pictures/defaultprofile.png') }}" alt="Default Profile Picture" class="rounded-circle mb-2" width="100" height="100" style="object-fit: cover;">
                    @endif
                    {{-- <input type="file" class="form-control mt-2" id="avatar" name="avatar"> --}}
                </div>

                             

                    <!-- Greeting -->
                    <h2 class="fw-bold mb-3">សួស្តី, {{ $customer->first_name }}!</h2>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Profile Update Form -->
                    <form action="{{ route('member.profile.update') }}" method="POST" enctype="multipart/form-data" class="text-start">
                        @csrf

                        <!-- Example: Uncomment if you want editable name -->
                        <!--
                        <div class="mb-3">
                            <label for="first_name" class="form-label">ឈ្មោះ</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $customer->first_name }}" required>
                        </div>
                        -->

                        <!-- Submit button if form has fields -->
                        {{-- <button type="submit" class="btn btn-primary w-100">Update Profile</button> --}}
                    </form>

                    <!-- Divider -->
                    <hr class="my-4">

                    <!-- Logout Button -->
                    <button class="btn btn-outline-danger w-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ចាកចេញ
                    </button>

                    <!-- Hidden Logout Form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
