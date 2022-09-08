
// Taking and storing geo location so it can be passed to other APIs


// Getting geographic coordinates
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    // console.log(position.coords.latitude);
    // console.log(position.coords.longitude);
    getGeoInfo(position.coords.latitude, position.coords.longitude); // Communicates with the backend and display the proper greetings message on the home page only
    // getConvertedAmountGeo(position.coords.latitude, position.coords.longitude); // Communicates with the backend and get the conversion rate
}

// This function communicatios with the _get_current_time_geo.php to get the current time and display the greeeting accordingly using Geo Location
function getGeoInfo(lat, lon) { 
    const xhttp_current_time = new XMLHttpRequest();
    xhttp_current_time.open("GET", "_engine/_get_currency_geo.php?lat=" + lat + "&lon=" + lon);
    xhttp_current_time.send();
    xhttp_current_time.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {  
            const info_geo = JSON.parse(this.responseText); 
            var hour_geo = info_geo.current_time.slice(11,13);;
            console.log(info_geo.local_currency);
            console.log(info_geo.conversion_rate);
            if (document.querySelector("#home_carousal #welcome_message") != null) {
                if ((hour_geo > 4) && (hour_geo < 12)) {
                    document.querySelector("#home_carousal #welcome_message").innerHTML = "Good Morning";
                } else if ((hour_geo > 11) && (hour_geo < 17)) {
                    document.querySelector("#home_carousal #welcome_message").innerHTML = "Good Afternoon";
                } else {
                    document.querySelector("#home_carousal #welcome_message").innerHTML = "Good Evening";
                } 
            }
            // Initialli loading products
            load_products("#products_page_display",search, category, info_geo.local_currency, info_geo.conversion_rate, "_engine/_get_product.php" );          
            load_products("#inventory_page_display",search, category, info_geo.local_currency, info_geo.conversion_rate, "_engine/get_inventory.php");
            // Search filer
            search_button.click(function() {
                search = search_input.val();
                load_products("#products_page_display", search, category, info_geo.local_currency, info_geo.conversion_rate, "_engine/_get_product.php");
                load_products("#inventory_page_display", search, category, info_geo.local_currency, info_geo.conversion_rate, "_engine/get_inventory.php"); 
            });
            // Category filter
            Array.prototype.forEach.call(catagories, function(cat) {
                $(cat).click(function(){
                    if (($(this).text()) == 'All') {
                        category = '%';
                    } else {
                        category = $(this).text();
                    }
                    load_products("#products_page_display",  search, category, info_geo.local_currency, info_geo.conversion_rate, "_engine/_get_product.php");
                    load_products("#inventory_page_display", search, category, info_geo.local_currency, info_geo.conversion_rate, "_engine/get_inventory.php");
                    Array.prototype.forEach.call(catagories, function(cat) {
                        $(cat).css("font-weight", "normal")
                    });
                    $(this).css("font-weight", "bold")
                });
            });
            
            // Loading homepage deals            
            $('#home_page_deals').load("_engine/_get_discounted_products.php" ,{
                currency: info_geo.local_currency,
                conversion_rate: info_geo.conversion_rate       
            });
        }
    }    
    
}


// This function communicatios with the _get_current_time_geo.php to get the current time and display the greeeting accordingly using ip address
function getIpInfo() {
    const xhttp_current_time_ip = new XMLHttpRequest();
    xhttp_current_time_ip.open("GET", "_engine/_get_currency_ip.php");
    xhttp_current_time_ip.send();
    xhttp_current_time_ip.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {  
            const info = JSON.parse(this.responseText);
            console.log(info.local_currency); 
            console.log(info.conversion_rate); 
            // Displaying the time appropriate greetings on home page only
            var hour = info.current_time.slice(0,2);
            if (document.querySelector("#home_carousal #welcome_message") != null) {
                if ((hour > 4) && (hour < 12)) {
                    document.querySelector("#home_carousal #welcome_message").innerHTML = "Good Morning";
                } else if ((hour > 11) && (hour < 17)) {
                    document.querySelector("#home_carousal #welcome_message").innerHTML = "Good Afternoon";
                } else {
                    document.querySelector("#home_carousal #welcome_message").innerHTML = "Good Evening";
                } 
            }
            // Initialli loading products
            load_products("#products_page_display",search, category, info.local_currency, info.conversion_rate, "_engine/_get_product.php" );                       
            load_products("#inventory_page_display",search, category, info.local_currency, info.conversion_rate, "_engine/get_inventory.php");
            // Search filer
            search_button.click(function() {
                search = search_input.val();
                load_products("#products_page_display", search, category, info.local_currency, info.conversion_rate, "_engine/_get_product.php");
                load_products("#inventory_page_display", search, category, info.local_currency, info.conversion_rate, "_engine/get_inventory.php"); 
            });
            // Category filter
            Array.prototype.forEach.call(catagories, function(cat) {
                $(cat).click(function(){
                    if (($(this).text()) == 'All') {
                        category = '%';
                    } else {
                        category = $(this).text();
                    }
                    load_products("#products_page_display",  search, category, info.local_currency, info.conversion_rate, "_engine/_get_product.php");
                    load_products("#inventory_page_display", search, category, info.local_currency, info.conversion_rate, "_engine/get_inventory.php");
                    Array.prototype.forEach.call(catagories, function(cat) {
                        $(cat).css("font-weight", "normal")
                    });
                    $(this).css("font-weight", "bold")
                });
            });
            
            // Loading homepage deals            
            $('#home_page_deals').load("_engine/_get_discounted_products.php" ,{
                currency: info.local_currency,
                conversion_rate: info.conversion_rate       
            });

        }
    }    
}

// This function communicatios with the _get_currency_geo.php to get the conversion rate and local currency using geo location
function getConvertedAmountGeo(lat, lon) {
    const xhttp_conversion_rate_geo = new XMLHttpRequest();
    xhttp_conversion_rate_geo.open("GET", "_engine/_get_currency_geo.php?lat=" + lat + "&lon=" + lon);
    xhttp_conversion_rate_geo.send();
    xhttp_conversion_rate_geo.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                const conversion = JSON.parse(this.responseText); 
                // Initialli loading products
                load_products("#products_page_display",search, category, conversion.local_currency, conversion.conversion_rate, "_engine/_get_product.php" );            
                load_products("#inventory_page_display",search, category, conversion.local_currency, conversion.conversion_rate, "_engine/get_inventory.php");
                // Search filer
                search_button.click(function() {
                    search = search_input.val();
                    load_products("#products_page_display", search, category, conversion.local_currency, conversion.conversion_rate, "_engine/_get_product.php");
                    load_products("#inventory_page_display", search, category, conversion.local_currency, conversion.conversion_rate, "_engine/get_inventory.php"); 
                });
                // Category filter
                Array.prototype.forEach.call(catagories, function(cat) {
                    $(cat).click(function(){
                        if (($(this).text()) == 'All') {
                            category = '%';
                        } else {
                            category = $(this).text();
                        }
                        load_products("#products_page_display",  search, category, conversion.local_currency, conversion.conversion_rate, "_engine/_get_product.php");
                        load_products("#inventory_page_display", search, category, conversion.local_currency, conversion.conversion_rate, "_engine/get_inventory.php");
                        Array.prototype.forEach.call(catagories, function(cat) {
                            $(cat).css("font-weight", "normal")
                        });
                        $(this).css("font-weight", "bold")
                    });
                });
                
                // Loading homepage deals            
                $('#home_page_deals').load("_engine/_get_discounted_products.php" ,{
                    currency: conversion.local_currency,
                    conversion_rate: conversion.conversion_rate       
                });
                
            } catch (err) {
                console.log(err)
            }
        }
    }  
}

// This function will get the conversion rate and local currency from _get_currency_ip.phpusing ip address
// function getConvertedAmountIp() {
//     const xhttp_conversion_rate_ip = new XMLHttpRequest();
//     xhttp_conversion_rate_ip.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {    
//             const conversion_ip = JSON.parse(this.responseText); 
//             console.log(conversion_ip.local_currency);
//             console.log(conversion_ip.conversion_rate);
//             // // Initialli loading products
//             // load_products("#products_page_display",search, category, conversion_ip.local_currency, conversion_ip.conversion_rate, "_engine/_get_product.php" );            
//             // load_products("#inventory_page_display",search, category, conversion_ip.local_currency, conversion_ip.conversion_rate, "_engine/get_inventory.php");
//             // // Search filer
//             // search_button.click(function() {
//             //     search = search_input.val();
//             //     load_products("#products_page_display", search, category, conversion_ip.local_currency, conversion_ip.conversion_rate, "_engine/_get_product.php");
//             //     load_products("#inventory_page_display", search, category, conversion_ip.local_currency, conversion_ip.conversion_rate, "_engine/get_inventory.php"); 
//             // });
//             // // Category filter
//             // Array.prototype.forEach.call(catagories, function(cat) {
//             //     $(cat).click(function(){
//             //         if (($(this).text()) == 'All') {
//             //             category = '%';
//             //         } else {
//             //             category = $(this).text();
//             //         }
//             //         load_products("#products_page_display",  search, category, conversion_ip.local_currency, conversion_ip.conversion_rate, "_engine/_get_product.php");
//             //         load_products("#inventory_page_display", search, category, conversion_ip.local_currency, conversion_ip.conversion_rate, "_engine/get_inventory.php");
//             //         Array.prototype.forEach.call(catagories, function(cat) {
//             //             $(cat).css("font-weight", "normal")
//             //         });
//             //         $(this).css("font-weight", "bold")
//             //     });
//             // });            
//             // // Loading homepage deals
//             // $('#home_page_deals').load("_engine/_get_discounted_products.php" ,{
//             //     currency: conversion_ip.local_currency,
//             //     conversion_rate: conversion_ip.conversion_rate       
//             // });
 
//         }
//     }    
    
//     xhttp_conversion_rate_ip.open("GET", "_engine/_get_currency_ip.php");
//     xhttp_conversion_rate_ip.send();
// }



getLocation(); // Getting geolocation and displaying time. 



// Checking geolocation permission 
navigator.permissions.query({name:'geolocation'}).then(function(result) {
    if (result.state == 'denied') {
        // getGreetingsIp();
        // getConvertedAmountIp();
        getIpInfo();
        
    } 
    
    result.onchange =  function() {     
        if (result.state == 'denied') {
            // getGreetingsIp();
            // getConvertedAmountIp();
            getIpInfo();
        } 
    }  
});








