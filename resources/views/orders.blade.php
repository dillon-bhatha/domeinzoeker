@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bestellingen') }}</div>
                <div class="card-body">

                    {{-- Laadt alle bestellingen zien --}}
                    @foreach($orders as $order)
                        <div>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
