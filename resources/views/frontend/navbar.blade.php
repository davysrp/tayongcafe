<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="storage/LOGO2.png" style="width: 50px; height: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button><b>
            <div class="collapse navbar-collapse" id="ftco-nav" style="font-family: 'Khmer OS Siemreap', sans-serif;">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="{{url('/')}}" class="nav-link"
                            style="font-size: 15px;">ទំព័រដើម</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" style="font-size: 15px;">
                            មីនុយ
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @foreach($categories as $category)
                                <a class="dropdown-item font-weight-bold scroll-to-category"
                                    href="#category-{{ $category->id }}">
                                    {{ $category->names }}
                                </a>
                                <div class="dropdown-divider"></div> <!-- Divider between categories -->
                            @endforeach
                        </div>
                    </li>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            document.querySelectorAll('.scroll-to-category').forEach(anchor => {
                                anchor.addEventListener('click', function (e) {
                                    e.preventDefault();
                                    let targetId = this.getAttribute('href');
                                    let targetElement = document.querySelector(targetId);

                                    if (targetElement) {
                                        window.scrollTo({
                                            top: targetElement.offsetTop - 80, // Adjust for navbar height
                                            behavior: 'smooth'
                                        });

                                        // Activate the correct tab in the product section
                                        let tabLink = document.querySelector(`[href="${targetId}"]`);
                                        if (tabLink) {
                                            tabLink.click();
                                        }
                                    }
                                });
                            });
                        });
                    </script>



                    <li class="nav-item">
                        <a href="#about-section" class="nav-link scroll-to" style="font-size: 15px;">អំពីតាន់យ៉ុង</a>
                    </li>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            document.querySelectorAll('.scroll-to').forEach(anchor => {
                                anchor.addEventListener('click', function (e) {
                                    e.preventDefault();
                                    let targetId = this.getAttribute('href');
                                    let targetElement = document.querySelector(targetId);

                                    if (targetElement) {
                                        window.scrollTo({
                                            top: targetElement.offsetTop - 50, // Adjust to avoid header overlap
                                            behavior: 'smooth'
                                        });
                                    }
                                });
                            });
                        });
                    </script>


                    <li class="nav-item">
                        <a href="#contact-section" class="nav-link scroll-to" style="font-size: 15px;">ទំនាក់ទំនង</a>
                    </li>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            document.querySelectorAll('.scroll-to').forEach(anchor => {
                                anchor.addEventListener('click', function (e) {
                                    e.preventDefault();
                                    let targetId = this.getAttribute('href');
                                    let targetElement = document.querySelector(targetId);

                                    if (targetElement) {
                                        window.scrollTo({
                                            top: targetElement.offsetTop - 50, // Adjust to avoid header overlap
                                            behavior: 'smooth'
                                        });
                                    }
                                });
                            });
                        });
                    </script>




                    <li class="nav-item dropdown">
                        @if (Auth::guard('customer')->check())
                        
                        @if(Auth::guard('customer')->check())
                        <a href="{{ route('member.profile') }}" class="nav-link" style="font-size: 15px;">
                            គណនី {{-- Go to profile --}}
                        </a>

                    @else
                        <a href="{{ route('memberFormLogin') }}" class="nav-link" style="font-size: 15px;">
                            គណនី {{-- Go to login --}}
                        </a>
                    @endif



                            <!-- Dropdown Menu -->
                            {{-- <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <!-- Logout Option -->
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

     
                            </div> --}}
                        @else
                            <!-- Guest (Not Logged-in) Display -->
                            <li class="nav-item">
                                @if(Auth::guard('customer')->check())
                                    <a href="{{ route('member.profile') }}" class="nav-link" style="font-size: 15px;">
                                        គណនី {{-- Go to profile --}}
                                    </a>
                                @else
                                    <a href="{{ route('memberFormLogin') }}" class="nav-link" style="font-size: 15px;">
                                        គណនី {{-- Go to login --}}
                                    </a>
                                @endif
                            </li>
                        @endif
                    </li>



                    <li class="nav-item cart">
                        <a href="{{ route('cart.index') }}" class="nav-link">
                            <span class="material-icons" style="font-size: 20px; color: white;">shopping_cart</span>
                            <span class="bag" style="
                    background: #f7b733;
                    color: black;
                    border-radius: 50%;
                    width: 20px;
                    height: 20px;
                    font-size: 12px;
                    font-weight: bold;
                    position: absolute;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                ">
                                <small>{{ session('cart') ? count(session('cart')) : 0 }}</small>
                            </span>
                        </a>
                    </li>


                </ul>
            </div>
        </b>
    </div>
</nav>