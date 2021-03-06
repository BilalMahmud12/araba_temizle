<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\System\Definitions\Area;
use App\Models\System\Definitions\BuildingBlock;
use App\Models\System\Definitions\District;
use App\Models\System\Definitions\Package;
use App\Models\System\Definitions\PackageCategory;
use App\Models\System\Definitions\ServiceSpot;
use App\Services\SmsMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
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

    public function createAccount(): \Illuminate\Http\RedirectResponse
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $activation = new SmsMessage();
        $activation_code = $activation->createPassword();
        $message =  $activation_code . ' ' . 'is Your New Account Activation Code';
        $smsTo = request('dial_code') . request('phone_number');
        if (App::getLocale() === 'en') {
            $lang = 0;
        } elseif(App::getLocale() === 'tr') {
            $lang = 1;
        } else {
            $lang = 2;
        }

        $sms_response = $activation->sendSMS($smsTo, $message, $lang);

        if ($sms_response == true) {

            Session::put('a_code', $activation_code);

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
            if ( request('dial_code') == '90' ) {
                $client_phone->domestic = 1;
            } else {
                $client_phone->domestic = 0;
            }
            $client_phone->dial_code = request('dial_code');
            $client_phone->phone_number = request('phone_number');
            $client_phone->save();

            $client_address = new Client\ClientAddress();
            $client_address->client_id = $client->id;
            $client_address->district_id = request('district_id');
            $client_address->area_id = request('area_id');
            $client_address->service_spot_id = request('spot_id');
            $client_address->flat_no = request('flat_no');
            if (request('name') != null) {
                $client_address->name = request('name');
            } else {
                $client_address->name = 'Default Address';
            }
            $client_address->save();

            return Redirect::route('client.signup.account-activation', $client->id);
        } else {
            Session::put('sms_result', $sms_response);
            return Redirect::back()->with('info', $sms_response);
        }

    }

    public function accountActivation($id): \Inertia\Response
    {
        $client = Client::findOrFail($id);
        $activation_code = Session::get('a_code');
        return Inertia::render('Client/Auth/AccountActivation', [
            'client' => $client,
            'activation_code' => $activation_code
        ]);
    }

    public function activateClientAccount($id): \Illuminate\Http\RedirectResponse
    {
        $client = Client::findOrFail($id);
        $client->is_active = 1;
        $client->save();
        return Redirect::route('client.signup.wash-package', $client->id);
    }


    public function washPackage($id): \Inertia\Response
    {
        $client = Client::findOrFail($id);

        $washCategories = PackageCategory::where('is_active', 1)->select('id', 'name')->get();

        $category_id = request('category');
        if (request('category')) {
            $washPackages = Package::where('is_active', 1)->where('package_category_id', $category_id)->with('packageCategory')->get();
        } else {
            $washPackages = [];
        }
        return Inertia::render('Client/AccountSetup/CarPackage', [
            'client' => $client,
            'washCategories' => $washCategories,
            'washPackages' => $washPackages
        ]);
    }

}
