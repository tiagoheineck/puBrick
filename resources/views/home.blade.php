@extends('layouts.app')

@section('content')


            <div id="map" style="height: 100%"></div>


@endsection

@section('javascript')
    <script src="{!! asset('js/maps-board.js') !!}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={!! env('GOOGLE_MAPS_KEY') !!}&signed_in=true&callback=initMap"
            async defer>
    </script>
@endsection
