@extends('store.layouts.main')
@push('css')
    @include('store.layouts.components.plugins.filepond.css');
@endpush
@section('title')
    @lang('translation.users')
@endsection
@section('css')
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('store.layouts.components.breadcrumb')
        @slot('li_1')
            @lang('translation.users')
        @endslot
        @slot('title')
            @lang('translation.manage-users')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted">Use <code>custom-verti-nav-pills</code> class to create custom vertical tabs.</p>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills text-center"
                                role="tablist" aria-orientation="vertical">
                                <a class="nav-link active show" id="custom-v-pills-home-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-home" role="tab" aria-controls="custom-v-pills-home"
                                    aria-selected="true">
                                    <i class="ri-home-4-line d-block fs-20 mb-1"></i>
                                    Basic Information</a>
                                <a class="nav-link" id="custom-v-pills-profile-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-profile" role="tab" aria-controls="custom-v-pills-profile"
                                    aria-selected="false">
                                    <i class="ri-user-2-line d-block fs-20 mb-1"></i>
                                    Media</a>
                                <a class="nav-link" id="custom-v-pills-messages-tab" data-bs-toggle="pill"
                                    href="#custom-v-pills-messages" role="tab" aria-controls="custom-v-pills-messages"
                                    aria-selected="false">
                                    <i class="ri-mail-line d-block fs-20 mb-1"></i>
                                    Adress and Location</a>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-lg-9">
                            <div class="tab-content text-muted mt-3 mt-lg-0">
                                <div class="tab-pane fade active show" id="custom-v-pills-home" role="tabpanel"
                                    aria-labelledby="custom-v-pills-home-tab">
                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('assets/images/small/img-4.jpg') }}" alt=""
                                                width="150" class="rounded">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="mb-0">Experiment and play around with the fonts that you already
                                                have in the software you’re working with reputable font websites. commodo
                                                enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo
                                                nostrud organic, assumenda labore aesthetic magna delectus.</p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-grow-1 me-3">
                                            <p class="mb-0">Always want to make sure that your fonts work well together
                                                and try to limit the number of fonts you use to three or less. Experiment
                                                and play around with the fonts that you already have in the software you’re
                                                working with reputable font websites.</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('assets/images/small/img-5.jpg') }}" alt=""
                                                width="150" class="rounded">
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane fade" id="custom-v-pills-profile" role="tabpanel"
                                    aria-labelledby="custom-v-pills-profile-tab">
                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('assets/images/small/img-3.jpg') }}" alt=""
                                                width="150" class="rounded">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="mb-0">In some designs, you might adjust your tracking to create a
                                                certain artistic effect. It can also help you fix fonts that are poorly
                                                spaced to begin with. A wonderful serenity has taken possession of my entire
                                                soul, like these sweet mornings of spring which I enjoy with my whole heart.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-grow-1 me-3">
                                            <p class="mb-0">Each design is a new, unique piece of art birthed into this
                                                world, and while you have the opportunity to be creative and make your own
                                                style choices. For that very reason, I went on a quest and spoke to many
                                                different professional graphic designers.</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('assets/images/small/img-6.jpg') }}" alt=""
                                                width="150" class="rounded">
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane fade" id="custom-v-pills-messages" role="tabpanel"
                                    aria-labelledby="custom-v-pills-messages-tab">
                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('assets/images/small/img-7.jpg') }}" alt=""
                                                width="150" class="rounded">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="mb-0">Trust fund seitan letterpress, keytar raw denim keffiyeh etsy
                                                art party before they sold out master cleanse gluten-free squid scenester
                                                freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore
                                                wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-grow-1 me-3">
                                            <p class="mb-0">They all have something to say beyond the words on the page.
                                                They can come across as casual or neutral, exotic or graphic. That's why
                                                it's important to think about your message, then choose a font that fits.
                                                Cosby sweater eu banh mi, qui irure terry richardson ex squid.</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('assets/images/small/img-8.jpg') }}" alt=""
                                                width="150" class="rounded">
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row-->
                </div><!-- end card-body -->
            </div>
            <!--end card-->
        </div>
    </div>
@endsection
