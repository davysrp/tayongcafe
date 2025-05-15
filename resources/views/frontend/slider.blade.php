{{-- <section class="home-slider owl-carousel">
    @foreach ($webpages as $page)
        <div class="slider-item" style="background-image: url({{ asset( 'webpages/'.$page->image ) }});" alt="Image">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
                    <div class="col-md-8 col-sm-12 text-center ftco-animate">
                        <!-- Replace detail_upper with name -->
                        <span style="font-family: 'Kh Metal Chrieng', sans-serif; color: yellow; font-size: 35px;">
                            {{ $page->names }}
                        </span>
                        <!-- Replace detail_middle with detail -->
                        <h1 style="font-family: 'Khmer OS Siemreap', sans-serif; font-size: 50px;">
                            {{ $page->detail }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</section> --}}



<section class="home-slider owl-carousel">
    @foreach ($webpages as $page)
        <div class="slider-item"
             style="background-image: url('{{ $page->image ? asset('storage/' . $page->image) : asset('images/') }}'); 
                    height: 100%; 
                    background-size: cover; 
                    background-position: center;">
            
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
                    <div class="col-md-8 col-sm-12 text-center ftco-animate">
                        <span style="font-family: 'Kh Metal Chrieng', sans-serif; color: yellow; font-size: 35px;">
                            {{ $page->names }}
                        </span>
                        <h1 style="font-family: 'Khmer OS Siemreap', sans-serif; font-size: 50px;">
                            {{ $page->detail }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</section>

