<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ url('bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ url('bootstrap.min (1).css') }}">
</head>
<body class="container mt-5">
    <h1 class="text-center">Dashboard</h1>
    <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Profile</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="api-tab" data-bs-toggle="tab" data-bs-target="#api" type="button" role="tab" aria-controls="api" aria-selected="false">API</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="documentation-tab" data-bs-toggle="tab" data-bs-target="#documentation" type="button" role="tab" aria-controls="documentation" aria-selected="false">Dokumentasi</button>
        </li>
    </ul>
    <div class="tab-content" id="dashboardTabsContent">
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h2 class="mt-3">User Profile</h2>
            <p>Name: {{ auth()->user()->name }}</p>
            <p>Email: {{ auth()->user()->email }}</p>
        </div>
        <div class="tab-pane fade" id="api" role="tabpanel" aria-labelledby="api-tab">
            <h2 class="mt-3">API Tokens</h2>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Token</th>
                        <th>Remaining Token Limit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        @if ($item->token_limit > 0)
                            <tr>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->token }}</td>
                                <td>{{ $item->token_limit }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="col-12">
                <div class="container">
                    @include('Produk.blink')
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">
            <h2 class="mt-3">API Usage Instructions</h2>
            <p>To use the API, include your token in the Authorization header of your requests.</p>
            <p>Example:</p>
            <div class="accordion" id="documentationAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingCurl">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCurl" aria-expanded="true" aria-controls="collapseCurl">
                            cURL Example
                        </button>
                    </h2>
                    <div id="collapseCurl" class="accordion-collapse collapse show" aria-labelledby="headingCurl" data-bs-parent="#documentationAccordion">
                        <div class="accordion-body">
                            <pre class="bg-light p-3">
                                <code>
                                    curl --location --request POST '{{ url('/api/use-token') }}' \
                                    --header 'Authorization: Bearer YOUR_TOKEN' \
                                    --header 'Accept: application/json' \
                                    --data-raw '{
                                        "nomor": "123456789",
                                        "pesan": "Hello, this is a test message."
                                    }'
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingAjax">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAjax" aria-expanded="false" aria-controls="collapseAjax">
                            AJAX Example
                        </button>
                    </h2>
                    <div id="collapseAjax" class="accordion-collapse collapse" aria-labelledby="headingAjax" data-bs-parent="#documentationAccordion">
                        <div class="accordion-body">
                            <pre class="bg-light p-3">
                                <code>
                                    $.ajax({
                                        url: '{{ url('/api/use-token') }}',
                                        method: 'POST',
                                        headers: {
                                            'Authorization': 'Bearer YOUR_TOKEN',
                                            'Accept': 'application/json'
                                        },
                                        data: {
                                            nomor: '123456789',
                                            pesan: 'Hello, this is a test message.'
                                        },
                                        success: function(response) {
                                            console.log(response);
                                        },
                                        error: function(error) {
                                            console.error(error);
                                        }
                                    });
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFetch">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFetch" aria-expanded="false" aria-controls="collapseFetch">
                            Fetch API Example
                        </button>
                    </h2>
                    <div id="collapseFetch" class="accordion-collapse collapse" aria-labelledby="headingFetch" data-bs-parent="#documentationAccordion">
                        <div class="accordion-body">
                            <pre class="bg-light p-3">
                                <code>
                                    const url = '{{ url('/api/use-token') }}';
                                    const token = 'YOUR_TOKEN';
                                    const data = {
                                        nomor: '123456789',
                                        pesan: 'Hello, this is a test message.'
                                    };

                                    fetch(url, {
                                        method: 'POST',
                                        headers: {
                                            'Authorization': `Bearer ${token}`,
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify(data)
                                    })
                                    .then(response => response.json())
                                    .then(data => console.log(data))
                                    .catch(error => console.error('Error:', error));
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPHP">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePHP" aria-expanded="false" aria-controls="collapsePHP">
                            PHP Example
                        </button>
                    </h2>
                    <div id="collapsePHP" class="accordion-collapse collapse" aria-labelledby="headingPHP" data-bs-parent="#documentationAccordion">
                        <div class="accordion-body">
                            <pre class="bg-light p-3">
                                <code>
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
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
                <!-- Add similar accordion items for Rust, Ruby, and Python examples -->
            </div>
            {{-- <h3 class="mt-4">Documentation</h3>
            <p>Example Usage in Different Languages:</p>
            <h4>PHP Example</h4>
            <pre class="bg-light p-3">
                <code>
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
                </code>
            </pre>
            <h4>Rust Example</h4>
            <pre class="bg-light p-3">
                <code>
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
                </code>
            </pre>
            <h4>Ruby Example</h4>
            <pre class="bg-light p-3">
                <code>
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
                </code>
            </pre>
            <h4>Python Example</h4>
            <pre class="bg-light p-3">
                <code>
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
                </code>
            </pre> --}}
            <h3 class="mt-4">Sandbox</h3>
            <form id="sandboxForm" class="mt-3">
                <div class="mb-3">
                    <label for="sandboxToken" class="form-label">Authorization Token:</label>
                    <input type="text" id="sandboxToken" class="form-control" placeholder="Enter your token">
                </div>
                <div class="mb-3">
                    <label for="sandboxNomor" class="form-label">Nomor:</label>
                    <input type="text" id="sandboxNomor" class="form-control" placeholder="Enter nomor">
                </div>
                <div class="mb-3">
                    <label for="sandboxPesan" class="form-label">Pesan:</label>
                    <input type="text" id="sandboxPesan" class="form-control" placeholder="Enter pesan">
                </div>
                <button type="button" class="btn btn-primary" onclick="testApi()">Test API</button>
            </form>
            <div id="sandboxResult" class="mt-3">
                <h4>Result:</h4>
                <pre class="bg-light p-3" id="sandboxOutput"></pre>
            </div>
        </div>
    </div>
    <script>
        async function testApi() {
            const endpoint = '/api/use-token';
            const token = document.getElementById('sandboxToken').value;
            const nomor = document.getElementById('sandboxNomor').value;
            const pesan = 'Pesan ini adalah percobaan sanbox dari {{url("/")}} '+document.getElementById('sandboxPesan').value;

            try {
                const url = `${endpoint}?nomor=${encodeURIComponent(nomor)}&pesan=${encodeURIComponent(pesan)}`;
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });

                const result = await response.json();
                document.getElementById('sandboxOutput').textContent = JSON.stringify(result, null, 2);
            } catch (error) {
                document.getElementById('sandboxOutput').textContent = `Error: ${error.message}`;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
