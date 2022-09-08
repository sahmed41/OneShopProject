<h2 id="api_sub_title">Login API</h2>
<p>The users of this API may not need maintain a database or table dedicated for user records for authentication. The parameters are email and password. If they match they return the user information. This uses POST method pass email and password, and GET method to pass api key.</p>
<h3>Endpoint</h3>
<p class="bg-dark text-light p-2 rounded">localhost/_api/_login_api.php</p>

<h3>Parameters</h3>
<p>The following parameters required by the API. </p>
<ul>
    <li>email (Required)</li>
    <li>password (Required)</li>
    <li>api_key (Required)</li>
</ul>

<h3>Response</h3>
<img src="resources/pictures/api_pages/login_api_response.png" alt="Login API Response" class="mb-5 mt-2">




