<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KrasnalipaReservation;
use App\LiberecReservation;
use App\Reservation;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function indexKrasnaLipa(Request $request) {
        $date = $request->input('date');
        $info = DB::table('krasnalipa_reservations')->where('date', $date)->first();
        if ($info) {
            return response()->json($info);
        } else {
            $res = new KrasnalipaReservation([
                'date' => $request->input('date'),
                'h_7' => true,
                'h_8' => true,
                'h_9' => true,
                'h_10' => true,
                'h_11' => true,
                'h_12' => true,
                'h_13' => true,
                'h_14' => true,
                'h_15' => true,
            ]);
            $res->save();
            $info = DB::table('krasnalipa_reservations')->where('date', $date)->first();
            return response()->json($info);
        }
    }
    public function indexLiberec(Request $request) {
        $date = $request->input('date');
        $info = DB::table('liberec_reservations')->where('date', $date)->first();
        if ($info) {
            return response()->json($info);
        } else {
            $res = new LiberecReservation([
                'date' => $request->input('date'),
                'h_7' => true,
                'h_8' => true,
                'h_9' => true,
                'h_10' => true,
                'h_11' => true,
                'h_12' => true,
                'h_13' => true,
                'h_14' => true,
                'h_15' => true,
            ]);
            $res->save();
            $info = DB::table('liberec_reservations')->where('date', $date)->first();
            return response()->json($info);
        }
    }
    public function Reserve (Request $request) {

        function lockHour($hour, $res) {
            switch ($hour) {
                case 7: $res->h_7 = false;
                    break;
                case 8: $res->h_8 = false;
                    break;
                case 9: $res->h_9 = false;
                    break;
                case 10: $res->h_10 = false;
                    break;
                case 11: $res->h_11 = false;
                    break;
                case 12: $res->h_12 = false;
                    break;
                case 13: $res->h_13 = false;
                    break;
                case 14: $res->h_14 = false;
                    break;
                case 15: $res->h_15 = false;
                    break;
            }
            $res->save();
        }

        if ($request->input('place') == 'Liberec') {
            $res = LiberecReservation::where('date', $request->input('date'))->first();

            lockHour($request->input('hour'), $res);
        }
        if ($request->input('place') == 'Krásná Lípa') {
            $res = KrasnalipaReservation::where('date', $request->input('date'))->first();

            lockHour($request->input('hour'), $res);
        }
        if (Reservation::where('date', $request->input('date'))
                ->where('hour', $request->input('hour'))
                ->where('place', $request->input('place'))->first()) {
            return response()->json([
               'message' => 'Zvolený čas je obsazen'
            ]);
        } else {
            $res = new Reservation([
                'name' => $request->input('name'),
                'date' => $request->input('date'),
                'place' => $request->input('place'),
                'hour' => $request->input('hour'),
                'type' => $request->input('type'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
            ]);
            $res->save();
            return response()->json([
                'message' => 'Rezervováno'
            ]);
        }
    }
    public function Reserved(Request $request) {
        $reserved = Reservation::where('date', $request->input('date'))->get();

        return response()->json($reserved);
    }
    public function RemoveReserved(Request $request) {

        function unlockHour($hour, $res) {
            switch ($hour) {
                case 7: $res->h_7 = true;
                    break;
                case 8: $res->h_8 = true;
                    break;
                case 9: $res->h_9 = true;
                    break;
                case 10: $res->h_10 = true;
                    break;
                case 11: $res->h_11 = true;
                    break;
                case 12: $res->h_12 = true;
                    break;
                case 13: $res->h_13 = true;
                    break;
                case 14: $res->h_14 = true;
                    break;
                case 15: $res->h_15 = true;
                    break;
            }
            $res->save();
        }

        if ($request->input('place') == 'Liberec') {
            $res = LiberecReservation::where('date', $request->input('date'))->first();

            unlockHour($request->input('hour'), $res);
        }
        if ($request->input('place') == 'Krásná Lípa') {
            $res = KrasnalipaReservation::where('date', $request->input('date'))->first();

            unlockHour($request->input('hour'), $res);
        }
        Reservation::where('id', $request->input('id'))->delete();
    }
}
