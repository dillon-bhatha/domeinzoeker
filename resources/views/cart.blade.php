@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Domein Zoeken') }}</div>
                <div class="card-body">

                    <div>
                        <table class="table">
                            <tr>
                                <th scope="col">Domein</th>
                                <th scope="col">Prijs</th>
                                <th scope="col"></th>
                            </tr>

                            @foreach ($cartItems as $domain)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    {{-- Zorg dat de knop het product verwijdert uit de winkelwagen --}}
                                    <td><button type="button" class="btn btn-danger"></button></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h5 class="mb-0">Overzicht</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                            Producten
                            <span>€ XX.XX</span>
                        </li>
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                            <div>
                                <strong>Total</strong>
                                <strong>
                                    <p class="mb-0">(inclusief € XX.XX BTW )</p>
                                </strong>
                            </div>
                            <span><strong>€ XX.XX</strong></span>
                        </li>
                    </ul>

                    <button type="button" class="btn btn-primary btn-lg btn-block">
                        Go to checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
