<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\System\Definitions\Area;
use App\Models\System\Definitions\BuildingBlock;
use App\Models\System\Definitions\District;
use App\Models\System\Definitions\ServiceSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;

class ClientRegisterController extends Controller
{
    public function signup(): \Inertia\Response
    {
        $district_id = request('district');
        $area_id = request('area');
        $spot_id = request('spot');

        $districts = District::ForSelectBox();

        if (request('district')) {
            $areas = Area::where('is_active', 1)->where('district_id', $district_id)->select('id', 'name')->get();
        } else {
            $areas = [];
        }

        if (request('area')) {
            $spots = ServiceSpot::where('is_active', 1)->where('area_id', $area_id)->select('id', 'name')->get();
        } else {
            $spots = [];
        }

        if (request('spot')) {
            $blocks = BuildingBlock::where('is_active', 1)->where('service_spot_id', $spot_id)->select('id', 'name')->get();
        } else {
            $blocks = [];
        }

        return Inertia::render('Client/Auth/SignUp', [
            'districts' => $districts,
            'areas' => $areas,
            'spots' => $spots,
            'blocks' => $blocks,
            'request' => request()
        ]);
    }

    public function createAccount(): \Inertia\Response
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $client_number = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);

        $client = new Client();
        $client->is_active = 0;
        $client->first_name = request('first_name');
        $client->last_name = request('last_name');
        $client->email = request('email');
        $client->client_number = 'C'. $client_number;
        $client->save();

        $client_profile = new Client\ClientProfile();
        $client_profile->client_id = $client->id;
        $client_profile->national_id = request('national_id');
        $client_profile->locale = App::getLocale();
        $client_profile->save();

        $client_phone = new Client\ClientPhone();
        $client_phone->client_id = $client->id;
        $client_phone->is_default = 1;
        if (\request('is_international') == true) {
            $client_phone->domestic = 0;
            $client_phone->code = request('int_code');
        } else {
            $client_phone->domestic = 1;
            $client_phone->code = '0090';
        }
        $client_phone->phone_number = request('phone_number');
        $client_phone->save();


        $client_address = new Client\ClientAddress();
        $client_address->client_id = $client->id;
        $client_address->district_id = request('district_id');
        $client_address->area_id = request('area_id');
        $client_address->service_spot_id = request('spot_id');
        $client_address->flat_no = request('flat_no');
        if (\request('name') != null) {
            $client_address->name = request('name');
        } else {
            $client_address->name = 'Default Address';
        }
        $client_address->save();

        return Inertia::render('Client/Auth/AccountActivation', []);
    }
}
