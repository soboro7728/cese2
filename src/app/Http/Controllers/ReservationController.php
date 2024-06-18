<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;



class ReservationController extends Controller
{
    //店舗登録欄
    public function reservation_create(Request $request)
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
}
