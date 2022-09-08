<h2 id="api_sub_title">Local Amount API</h2>
<p>This API will return the converted amount of the local currency. This API will use the geolocation to get the origin of the request and based on that the local currency will be obtained. If geolocation is not passed the API will use ip address to obtain the local currency. </p>
<h3>Endpint</h3>
<p class="bg-dark text-light p-2 rounded">localhost/_api/_local_amount_api.php</p>
<h3>Parameters</h3>
<p>The following parameters required by the API. </p>
<ul>
    <li>lat (Optional)</li>
    <li>lon (Optional)</li>
    <li>new_currency (Required)</li>
    <li>amount (Required)</li>
    <li>api_ey (Required)</li>
</ul>
<h3>Response</h3>
<img src="resources/pictures/api_pages/local_amount_api_response.png" alt="Local Amount API Response" class="mb-5 mt-2">



