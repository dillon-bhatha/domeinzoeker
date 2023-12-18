@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Domein Zoeken') }}</div>
                <div class="card-body">
                    <div>
                        <form method="GET"  action="{{ route('domains')}}">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary" type="button">Zoeken</button>
                                </div>
                                <input type="text" class="form-control" placeholder="Is jou domain nog vrij?" name="searched_domain"
                                       value="{{$searchedDomain}}" aria-label="" aria-describedby="basic-addon1" >
                            </div>
                        </form>
                    </div>
                    <div>
                        <table class="table">
                            <tr>
                                <th scope="col">Domain</th>
                                <th scope="col">Status</th>
                                <th scope="col">Prijs</th>
                                <th scope="col"></th>
                            </tr>

                            {{-- Laad de domeinen in met de juiste data --}}
                            @foreach ($domains as $domain)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    {{-- Zorg dat de knop het product toevoegd aan de winkelwagen --}}
                                    <td><button type="button" class="btn btn-primary"></button></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
