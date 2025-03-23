<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f9fcfd;
        }
        .profile-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
        .btn-upload {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-upload:hover {
            background-color: #218838;
        }
        .btn-logout {
            border: 1px solid #dc3545;
            color: #dc3545;
            background: transparent;
        }
        .btn-logout:hover {
            background: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Profile Card -->
                <div class="profile-card">
                    <!-- Greeting Section -->
                    @php
                        $hour = now()->hour;
                        if ($hour >= 5 && $hour < 12) {
                            $greeting = 'អរុណសួស្តី';
                        } elseif ($hour >= 12 && $hour < 18) {
                            $greeting = 'ទិវាសួស្តី';
                        } else {
                            $greeting = 'រាត្រីសួស្តី';
                        }
                    @endphp

                    <h2 class="mb-4 text-success fw-bold">{{ $greeting }}, {{ $customer->first_name }}!</h2>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Profile Picture Upload Section -->
                    <div class="d-flex align-items-center mb-4">
                        <img id="profile-preview"
                             src="{{ $customer->userphoto ? asset('storage/' . $customer->userphoto) : asset('storage/customer_pictures/customerdefaultprofile.png') }}"
                             class="profile-picture me-3" alt="Profile Photo">

                        <!-- Upload Form -->
                        <form action="{{ route('member.profile.update.photo') }}" method="POST" enctype="multipart/form-data" id="upload-photo-form">
                            @csrf
                            <input type="file" name="photo" id="photo" class="form-control d-none"
                                   onchange="previewImage(event); document.getElementById('upload-photo-form').submit();" accept="image/*">
                            <label for="photo" class="btn btn-upload">Upload Photo</label>
                        </form>
                    </div>

                    <!-- Profile Information Form -->
                    <form action="{{ route('member.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label">ឈ្មោះពេញ:</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $customer->first_name }}" required>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">លេខទូរសព្ទ:</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $customer->phone_number }}">
                        </div>

                        <!-- Save Button -->
                        <button type="submit" class="btn btn-dark w-100 fw-bold py-2">SAVE CHANGES</button>
                    </form>

                    <!-- Logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-logout w-100">ចាកចេញ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Live Preview Script -->
    <script>
        function previewImage(event) {
            const input = event.target;
            const reader = new FileReader();

            reader.onload = function () {
                const preview = document.getElementById('profile-preview');
                preview.src = reader.result;
            }

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>