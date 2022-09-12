<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Requests\Orders\OrderRequest;
use App\SponsorType;
use App\Apartment;
use App\ApartmentSponsorType;


class PaymentController extends Controller 
{
   
    // public function makePayment (OrderRequest $request,Gateway $gateway) {

    // dd($request);
    // $sponsor_type = SponsorType::find($request->sponsor_type);

    // $result = $gateway->transaction()->sale([
    //     'amount' =>  $sponsor_type->price,
    //     'paymentMethodNonce' => "fake-valid-nonce",
    //     'options' => [
    //         'submitForSettlement' => true
    //     ]
        // if($result->success){
        //     $data = [
        //         'success' => true,
        //         'message' => "Transazione eseguita con Successo!"
        //     ];
        //     return response()->json($data,200);
        // }else{
        //     $data = [
        //         'success' => false,
        //         'message' => "Transazione Fallita!!"
        //     ];
        //     return response()->json($data,401);
        // }
    // ]);

    public function makePayment (Request $request,Gateway $gateway, $id) {
        
        // $sponsor_type = SponsorType::find($request->sponsor_type);
        $sponsor_type = SponsorType::where('price', '=', $request->amount)->first();

        $apartment = Apartment::findOrFail($id);

        $result = $gateway->transaction()->sale([
            'amount' =>  $request->amount,
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if($result->success){

            $apartment_sponsor = new ApartmentSponsorType();
            $apartment_sponsor->apartment_id = $apartment->id;
            $apartment_sponsor->sponsor_type_id = $sponsor_type->id;

            $date_start = date('Y-m-d H:i:s', time());
            $date_end_unix = strtotime($date_start) + ($sponsor_type->duration_h * 60 * 60);
            $date_end = date('Y-m-d H:i:s', $date_end_unix);

            //controllare se già esiste una sponsorizzazione
            $relative = ApartmentSponsorType::where('apartment_id', $apartment->id)
                ->where('sponsor_start', '<=', $date_start)
                ->where('sponsor_end', '>=', $date_start)
                ->first();

            while($relative){
                //c'è già una sponsorizzaione attiva, impostare la data di inizio alla data di fine di quella attiva + 1s
                $date_start_unix = strtotime($relative->sponsor_end) + 1;
                $date_start = date('Y-m-d H:i:s', $date_start_unix);
                $date_end_unix = strtotime($date_start) + ($sponsor_type->duration_h * 60 * 60);
                $date_end = date('Y-m-d H:i:s', $date_end_unix);
    
                $relative = ApartmentSponsorType::where('apartment_id', $apartment->id)
                    ->where('sponsor_start', '<=', $date_start)
                    ->where('sponsor_end', '>=', $date_start)
                    ->first();
            }

            $apartment_sponsor->sponsor_start = $date_start;
            $apartment_sponsor->sponsor_end = $date_end;

            $apartment_sponsor->save();
            
            return redirect()->route('user.apartment.show', ['apartment' => $id])->with('message', 'Appartamento sponsorizzato con successo');
        }else{
            $data = [
                'success' => false,
                'message' => "Transazione Fallita!!"
            ];
            return response()->json($data,401);
        }
    }
    
 
}