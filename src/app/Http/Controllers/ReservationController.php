<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Shoptime;
use App\Http\Requests\ReservationRequest;



class ReservationController extends Controller
{
    //店舗登録欄
    public function reservation_create(ReservationRequest $request)
    {
        $auths = Auth::user();
        $reservation = [
            'user_id' => $auths->id,
            'shop_id' => $request->id,
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number
        ];
        Reservation::create($reservation);
        return view("shop.thanks");
    }
    public function reservation_delete(Request $request)
        {
            $reservation_id = $request->id;
            $reservation = Reservation::find($reservation_id);
            $reservation->delete();
            return redirect('/mypage');
        }
    public function reservation_change(Request $request)
    {
        $shoptimes = Shoptime::all();
        $id = $request->id;
        $reservation = Reservation::with('shop')
        ->where('id', $id)
        ->first();
        return view("auth.change", compact('reservation', 'shoptimes'));
    }
    public function update(ReservationRequest $request)
    {
        $reservation=Reservation::find($request->id);
        $reservation->fill (
            [
                'date' => $request->date,
                'time' => $request->time,
                'number' => $request->number,
        ]);
        $reservation->save();
        return view("shop.thanks");
    }
}
