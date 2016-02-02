@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{!! asset('js/maps.js') !!}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={!! env('GOOGLE_MAPS_KEY') !!}&signed_in=true&callback=initMap"
            async defer>
    </script>
@endsection
