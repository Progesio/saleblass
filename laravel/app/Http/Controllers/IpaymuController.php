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

        // $va = env('IPAYMU_VA');
        $va = '1179002111424592';  // Virtual Account
        // $apiKey = env('IPAYMU_API_KEY');
        $apiKey = '22711A7C-8AB0-4139-96B9-B43A06ACF710';
        // $url = env('IPAYMU_API_URL', 'https://sandbox.ipaymu.com/api/v2/payment');
        $url = 'https://sandbox.ipaymu.com/api/v2/payment';
        $body = [
            'product' => [$validatedData['product']],
            'qty' => [$validatedData['quantity']],
            'price' => [$validatedData['price']],
            'returnUrl' => route('ipaymu.success'),
            'cancelUrl' => route('ipaymu.cancel'),
            'notifyUrl' => route('ipaymu.notify'),
        ];

        dump($body);

        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $signature = hash_hmac('sha256', $va . $jsonBody . $url, $apiKey);

        dump($signature);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'va' => $va,
            'signature' => $signature,
            'timestamp' => now()->format('YmdHis'),
        ])->post($url, $body);

        dd($response->json());

        if ($response->successful()) {
            return redirect($response->json('Data.Url'));
        }

        return back()->withErrors(['message' => 'Failed to initiate payment.']);
    }

    public function success()
    {
        return view('ipaymu.success');
    }

    public function cancel()
    {
        return view('ipaymu.cancel');
    }

    public function notify(Request $request)
    {
        // Handle IPaymu notification logic here
        return response()->json(['message' => 'Notification received.']);
    }
}
