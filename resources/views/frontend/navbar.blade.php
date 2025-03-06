<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar" >
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="storage/LOGO2.png" style="width: 50px; height: auto;">
        </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button><b>
      <div class="collapse navbar-collapse" id="ftco-nav" style="font-family: 'Khmer OS Siemreap', sans-serif;">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="{{url('/')}}" class="nav-link" style="font-size: 15px;">ទំព័រដើម</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="room.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 15px;">មីនុយ</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
              <a class="dropdown-item" href="">កាហ្វេ-Coffee</a>
              <a class="dropdown-item" href="">តែទឹកដោះគោ-Milk Tea</a>
              <a class="dropdown-item" href="">ផាសិន-Passion</a>
              <a class="dropdown-item" href="">តែផ្លែឈើ-Fruit Tea</a>
              <a class="dropdown-item" href="">រស់់ជាតិ-Flavor</a>
              <a class="dropdown-item" href="">សូដា-Soda</a>
              <a class="dropdown-item" href="">ក្រឡុក-Smoothie</a>
            </div>
          </li>
          <li class="nav-item"><a href="" class="nav-link" style="font-size: 15px;">អំពីតាន់យ៉ុង</a></li>
          <li class="nav-item"><a href="" class="nav-link" style="font-size: 15px;">ទំនាក់ទំនង</a></li>
          <li class="nav-item"><a href="{{url('/login')}}" class="nav-link" style="font-size: 15px;">ចូលគណនី</a></li>

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
      </div></b>
      </div>
  </nav>
