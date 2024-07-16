@php
    $about = \App\Models\about::latest()->first();
@endphp

@if (!empty($about))
    <section id="about-us" class="about-us">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>About Us</strong></h2>
            </div>

            <div class="row content">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2>{{ $about->title }}</h2>
                    <h3>{!! nl2br($about->short_dis) !!}</h3>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
                    <p>{!! nl2br($about->long_dis) !!}</p>
                </div>
            </div>

        </div>
    </section>
@endif
