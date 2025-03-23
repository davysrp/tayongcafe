<h2>សួស្តី, {{ $customer->first_name }}!</h2>

@if(session('success'))
    <div style="color: green; font-weight: bold;">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('member.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>ឈ្មោះពេញ:</label>
    <input type="text" name="first_name" value="{{ $customer->first_name }}" required><br>

    {{-- <label>Last Name:</label>
    <input type="text" name="last_name" value="{{ $customer->last_name }}"><br> --}}

    <label>លេខទូរសព្ទ:</label>
    <input type="text" name="phone_number" value="{{ $customer->phone_number }}"><br>

    <label>បញ្ជូលរូបភាព:</label>
    <input type="file" name="photo"><br><br>

    <button type="submit">កែប្រែប្រវត្តិរូប</button>
</form>
<!-- Logout Button -->
<button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    ចាកចេញ
</button>

<!-- Hidden Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>


@if($customer->userphoto)
    <p>រូបភាពរបស់អ្នក:</p>
    <img src="{{ asset('storage/' . $customer->userphoto) }}" width="100">
@endif
