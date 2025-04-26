<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <pre class="bg-light p-3">
                <code>
                    curl -X GET \
                    -H "Authorization: YOUR_TOKEN" \
                    https://your-api-endpoint.com/resource
                </code>
            </pre>
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
            const pesan = document.getElementById('sandboxPesan').value;

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
