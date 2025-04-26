<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IpaymuController extends Controller
{
    public function purchase(Request $request)
    {
        $validatedData = $request->validate([
            'product' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $va = '0000001221723861';  // Virtual Account
        $apiKey = 'SANDBOXEF649FC8-F90F-4E29-9C47-B33167239B9A-20220326121000';
        $url = 'https://sandbox.ipaymu.com/api/v2/payment';
        $method = 'POST';

        $body = [
            'product' => [$validatedData['product']],
            'qty' => [$validatedData['quantity']],
            'price' => [$validatedData['price']],
            'imageUrl' => ['https://progesio.my.id/icon.png'],
            'returnUrl' => route('ipaymu.success'),
            'cancelUrl' => route('ipaymu.cancel'),
            'notifyUrl' => route('ipaymu.notify').'?email=lag@g.com&amount='.$validatedData['price'].'&status=success',
        ];

        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $bodyHash = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $bodyHash . ':' . $apiKey;
        $signature = hash_hmac('sha256', $stringToSign, $apiKey);

        $timestamp = gmdate('Y-m-d\TH:i:s\Z'); // harus UTC, contoh: 2025-04-26T05:17:03Z

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'va' => $va,
            'signature' => $signature,
            'timestamp' => $timestamp,
        ])->post($url, $body);

        if ($response->successful()) {
            return redirect($response->json('Data.Url'));
        }

        return back()->withErrors(['message' => 'Failed to initiate payment.']);
    }

    public function success(Request $request)
    {
        Http::get('https://caseoptheligaandnewligawkwkkw.progesio.my.id/send-message-get?no=082111424592&mass=HIT SUCCESSs ');
        return view('ipaymu.success');
    }

    public function cancel()
    {
        return view('ipaymu.cancel');
    }

    public function notify(Request $request)
    {
        // if($request->return=='true'){
        Http::get('https://caseoptheligaandnewligawkwkkw.progesio.my.id/send-message-get?no=082111424592&mass=Terdapat Pembayaran Berhasil oleh '.$request->email .' dengan nominal '.$request->amount);
        // }
        return response()->json(['message' => 'Notification received.']);
    }
}
