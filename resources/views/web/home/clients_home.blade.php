@php
    $brands = \App\Models\Brand::all();
@endphp


<section id="clients" class="clients">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Clients</h2>
        </div>

        <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">
            @forelse ($brands as $brand)
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="client-logo">
                        <img src="{{ asset($brand->brand_url) }}" class="img-fluid" alt="">
                    </div>
                </div>
            @empty
            @endforelse

        </div>

    </div>
</section>
