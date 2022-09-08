<h2 id="api_sub_title">Product API</h2>
<p>This API will return a list of products from OneShop systems database. The products can be filtered using any of parameters mentioned below. There should at least be one parameter in addition to the API key. This uses GET request.</p>
<h3>Endpoint</h3>
<p class="bg-dark text-light p-2 rounded">localhost/_api/_product_api.php</p>
<h3>Parameters</h3>
<p>The following parameters required by the API. </p>
<ul>
    <li>product_name (Optional)</li>
    <li>product_category (Optional)</li>
    <li>minimum_price (Optional)</li>
    <li>maximum_price (Optional)</li>
    <li>api_key (Required)</li>
</ul>

<h3>Response</h3>
<img src="resources/pictures/api_pages/product_api_response.png" alt="Product API Response" class="mb-5 mt-2 w-100">


