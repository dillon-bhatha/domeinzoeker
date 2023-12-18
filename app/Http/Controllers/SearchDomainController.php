<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchDomainController extends \Illuminate\Routing\Controller
{
    public function view(Request $request) {

        $searchedDomain = isset($request->searched_domain) ? $request->searched_domain : "" ;

//        Haal de bestellingen op vanuit de MintyClooud Api
        $domains = [];

        return view('domains')->with([
            "domains" => $domains,
            "searchedDomain" => $searchedDomain,
        ]);
    }
}
