@extends('layouts.app')
@section('content')
<main class="container">
    <h2 class="mb-4">About</h2>
    <h3>Useful information</h3>
    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-video-tab" data-toggle="pill" href="#v-pills-video" role="tab" aria-controls="v-pills-video" aria-selected="true">Tips for beginners on zerowaste life</a>
                <a class="nav-link" id="v-pills-info-tab" data-toggle="pill" href="#v-pills-info" role="tab" aria-controls="v-pills-info" aria-selected="false">What's a zero waste lifestyle?</a>
                <a class="nav-link" id="v-pills-statistics-tab" data-toggle="pill" href="#v-pills-statistics" role="tab" aria-controls="v-pills-statistics" aria-selected="false">Food waste statistics and comparison</a>
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-video" role="tabpanel" aria-labelledby="v-pills-video-tab">
                    <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube-nocookie.com/embed/sO76q932VOo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="tab-pane fade" id="v-pills-info" role="tabpanel" aria-labelledby="v-pills-info-tab">
                    <div class="media">
                        <img width="150" src="http://www.vidasostenible.org/wp-content/uploads/granel1000.jpg" class="mr-3 img-thumbnail">
                        <div class="media-body">
                            <h5 class="mt-0">Zero waste lifestyle</h5>
                            Zero waste lifestyle is a trend which more and more people adopted to combat with the above-mentioned issue. The aim of the zero waste is to achieve a resource lifecycle that no trash are sent to landfill or incinerator. By adopting the zero waste lifestyle, consumers are able to save money and built up a healthy lifestyle as they only buy what is needed, improving diet and have taken up walking and biking as the alternatives of transport. Moreover, it can achieve sustainability, improve product’s lifespan, mitigate environmental pollution, combat global warming, reduce the burden of landfill and incinerator and reduce environmental footprint. <a href="http://www.vidasostenible.org/informes/zero-waste-lifestyle-a-simple-living-philosophy-which-everyone-can-take-part-in/">More information</a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-statistics" role="tabpanel" aria-labelledby="v-pills-statistics-tab">
                    Statistical information about food waste of USA in 2012
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Weight</th>
                                <td>38 million tons a year</td>
                            </tr>
                            <tr>
                                <th scope="row">Volume</th>
                                <td>The size of a college stadium</td>
                            </tr>
                            <tr>
                                <th scope="row">Nutrients</th>
                                <td>The amount of food thrown away in the United States in 2012 would have been enough to feed 190 million adults every day that year</td>
                            </tr>
                            <tr>
                                <th scope="row">Footprint</th>
                                <td>4.4 gigatonnes of CO<sub>2</sub></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@push('scripts')
<script src="{{ mix('/js/app.js') }}" defer></script>
@endpush
@endsection
