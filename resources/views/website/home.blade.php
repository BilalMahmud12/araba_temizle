@extends('website.layouts.web')

@section('content')
    <main>
        <article id="home_page">
            @include('website.partials.hero')
            @include('website.partials.advantages-section')
            @include('website.partials.how-it-work-section')
            @include('website.partials.key-service-points')
            @include('website.partials.for-residents')
        </article>
    </main>
@endsection
