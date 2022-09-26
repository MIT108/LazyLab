<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferDetail;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    //
    public function listOffers(){

        $offers = Offer::get();
        return view('pages/offer/offer-management')->with('offers', $offers);
    }


    public function createOffer(Request $request)
    {
        $fields = $request->validate([
            "name" => 'required',
            'description' => 'required',
            'price' => ''
        ]);

        if ($this->checkName($fields['name'])) {
            $fields += [
                "role_id" => 2
            ];
            try {
                //code...
                Offer::create($fields);
                return redirect()->back()->with('success', 'offer created successfully');
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with('error', 'Server Error');
            }
        } else {
            return redirect()->back()->with('error', 'This name already exist');
        }
    }

    public function checkName($name)
    {
        if (Offer::where('name', '=', $name)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteOffer($id)
    {
        try {
            //code...
            $offer = Offer::find($id);
            if ($offer) {
                Offer::where('id', $id)->delete();
                return redirect()->back()->with('success', 'offer deleted successful');
            } else {
                return redirect()->back()->with('error', 'this offer does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function deleteOfferDetail($id){

        try {
            //code...
            $offerDetail = OfferDetail::find($id);
            if ($offerDetail) {
                OfferDetail::where('id', $id)->delete();
                return redirect()->back()->with('success', 'offer detail deleted successful');
            } else {
                return redirect()->back()->with('error', 'this offer detail does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function recommendOffer($id){

        try {
            //code...
            $offer = Offer::find($id);
            if ($offer) {
                $updates = Offer::where('id', '>', 0)->update([
                    "recommended" => 0
                ]);
                $offer->recommended = 1;
                $offer->save();
                return redirect()->back()->with('success', 'offer recommended successful');
            } else {
                return redirect()->back()->with('error', 'this offer does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function viewOffer($id){

        try {
            //code...
            $offer = Offer::find($id);
            if ($offer) {
                $offer = Offer::where('id', $offer->id)->with('offer_detail')->get()[0];
                return view('pages/offer/view-offer')
                ->with('offer', $offer);
            } else {
                return redirect()->back()->with('error', 'this offer does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function updateOffer(Request $request)
    {

        $fields = [];

        $offer = Offer::find($request['offer_id']);

        if ($offer) {

            if ($request['name'] != null) {
                if ($request['name'] != $offer->name) {
                    if ($this->checkName($request['name'])) {
                        $fields['name'] = $request['name'];
                    } else {
                        return redirect()->back()->with('error', "this name has already been used");
                    }
                }
            }
            if ($request['description'] != null) {
                $fields['description'] = $request['description'];
            }

            if ($request['price'] != null) {
                $fields['price'] = $request['price'];
            }


            try {

                Offer::where('id', $offer->id)->update($fields);
                return redirect()->back()->with('success', 'Offer updated successful');
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with('error', $th->getMessage());
            }
        } else {
            return redirect()->back()->with('error', "offer does not exist");
        }
    }

    public function offerDetail(Request $request){
        $fields = $request->validate([
            'offer_id' => 'required',
            'name' => 'required',
        ]);

        try {

            OfferDetail::create($fields);
            return redirect()->back()->with('success', 'Offer detail created successful');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }

    }
}
