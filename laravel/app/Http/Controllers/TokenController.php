<?php

namespace App\Http\Controllers;

use App\Models\UserWaPoliester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TokenController extends Controller
{

    public function useToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor' => 'required|string|max:255',
            'pesan' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $token = $request->header('Authorization');
        if (preg_match('/Bearer\s(\S+)/', $token, $matches)) {
            $token = $matches[1];
        }

        $user = UserWaPoliester::where('token', $token)->first();
        if (!$user) {
            return response()->json(['message' => 'Token tidak ditemukan'], 404);
        }
        if ($user->token_limit <= 0) {
            return response()->json(['message' => 'Limit token tercapai'], 403);
        }
        $user->token_limit -= 1;
        $user->save();

        $nomor = $request->nomor;
        $pesan = $request->pesan;
        // Http::get($user->domain_hit.'/send-message-get?no='.$nomor.'&mass='.$pesan);
        Http::get('https://caseoptheligaandnewligawkwkkw.progesio.my.id/send-message-get?no=082111424592&mass=iniiiiiiiiiii');

        $this->checkTokenLimit($token);

        return response()->json([
            'message' => 'Request berhasil',
            'remaining_limit' => $user->token_limit
        ]);
    }


    public function checkTokenLimit($token)
    {
        $user = UserWaPoliester::where('token', $token)->first();
        if (!$user) {
            return response()->json(['message' => 'Token tidak ditemukan'], 404);
        }
        $now = now();
        $lastUpdated = $user->updated_at;
        $diffInDays = $now->diffInDays($lastUpdated);
        if ($diffInDays >= 7) {
            if ($user->token_limit <= 10) {
                $user->token_limit = 10;
            } else {
                $user->token_limit += 10;
            }
            $user->save();
        }
        $user->updated_at = now();
        $user->save();
        // return response()->json([
        //     'message' => 'Request berhasil',
        //     'remaining_limit' => $user->token_limit
        // ]);
    }
}
