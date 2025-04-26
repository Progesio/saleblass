# saleblass

# API Documentation

## Overview
This API allows users to interact with the system for various functionalities, including user registration, login, and payment processing using IPaymu.

## Base URL
```
http://localhost:8000
```

## Endpoints

### 1. User Registration
**POST** `/register`

#### Request Body
```json
{
  "name": "string",
  "email": "string",
  "password": "string"
}
```

#### Response
```json
{
  "user": {
    "id": "integer",
    "name": "string",
    "email": "string"
  }
}
```

### 2. User Login
**POST** `/login`

#### Request Body
```json
{
  "email": "string",
  "password": "string"
}
```

#### Response
```json
{
  "user": {
    "id": "integer",
    "name": "string",
    "email": "string"
  }
}
```

### 3. Use Token
**POST** `/api/use-token`

#### Headers
```
Authorization: Bearer YOUR_TOKEN
```

#### Request Body
```json
{
  "nomor": "string",
  "pesan": "string"
}
```

#### Response
```json
{
  "message": "string",
  "remaining_limit": "integer"
}
```

### 4. Payment Processing (IPaymu)
**POST** `/ipaymu/purchase`

#### Request Body
```json
{
  "product": "string",
  "price": "number",
  "quantity": "integer",
  "buyerName": "string",
  "buyerEmail": "string",
  "buyerPhone": "string"
}
```

#### Response
Redirects to the payment URL provided by IPaymu.

### 5. Payment Success
**GET** `/ipaymu/success`

#### Response
Displays a success message.

### 6. Payment Cancel
**GET** `/ipaymu/cancel`

#### Response
Displays a cancellation message.

### 7. Payment Notification
**POST** `/ipaymu/notify`

#### Response
```json
{
  "message": "Notification received."
}
```

## Example Usage

### Use Token Example
#### cURL Command
```bash
curl --location --request POST 'http://localhost:8000/api/use-token' \
--header 'Authorization: Bearer YOUR_TOKEN' \
--header 'Accept: application/json' \
--data-raw '{
    "nomor": "123456789",
    "pesan": "Hello, this is a test message."
}'
```

#### Response
```json
{
  "message": "Request berhasil",
  "remaining_limit": 9
}
```

## Example Usage in Different Languages

### PHP Example
```php
<?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost:8000/api/use-token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode([
        'nomor' => '123456789',
        'pesan' => 'Hello, this is a test message.'
    ]),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer YOUR_TOKEN',
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
```

### Rust Example
```rust
use reqwest::Client;
use serde_json::json;
use tokio;

#[tokio::main]
async fn main() -> Result<(), reqwest::Error> {
    let client = Client::new();
    let url = "http://localhost:8000/api/use-token";

    let response = client
        .post(url)
        .header("Authorization", "Bearer YOUR_TOKEN")
        .header("Content-Type", "application/json")
        .json(&json!({
            "nomor": "123456789",
            "pesan": "Hello, this is a test message."
        }))
        .send()
        .await?;

    let body = response.text().await?;
    println!("{}", body);

    Ok(())
}
```

### Ruby Example
```ruby
require 'net/http'
require 'uri'
require 'json'

uri = URI.parse("http://localhost:8000/api/use-token")
request = Net::HTTP::Post.new(uri)
request["Authorization"] = "Bearer YOUR_TOKEN"
request["Content-Type"] = "application/json"
request.body = JSON.dump({
  "nomor" => "123456789",
  "pesan" => "Hello, this is a test message."
})

response = Net::HTTP.start(uri.hostname, uri.port) do |http|
  http.request(request)
end

puts response.body
```

### Python Example
```python
import requests

url = "http://localhost:8000/api/use-token"
headers = {
    "Authorization": "Bearer YOUR_TOKEN",
    "Content-Type": "application/json"
}
data = {
    "nomor": "123456789",
    "pesan": "Hello, this is a test message."
}

response = requests.post(url, json=data, headers=headers)
print(response.json())
```

## Notes
- Ensure to replace `YOUR_TOKEN` with a valid token obtained after login.
- For IPaymu integration, ensure the API key and Virtual Account (VA) are correctly configured in the `.env` file.