// // Vairalbes
// var welcome_message = document.querySelector("#home_carousal #welcome_message");

// // Geo Location API - Taking the Geolocation for currency conversion and greetings
// var latitude;
// var longitude;
// var country_code;
// var link_to_api = document.getElementById("test_link");
// var local_currency = "EUR";
// var converted_amount= 1;
// function getLocation() {
//     if (navigator.geolocation) {
//       navigator.geolocation.getCurrentPosition(showPosition);
//     } else {
//       latitude = "Geolocation is not supported by this browser.";
//     }
//   }
  
// function showPosition(position) {

//     const xhttp = new XMLHttpRequest();
//     xhttp.open("GET", "_engine/_get_country_code.php?lat=" + position.coords.latitude + "&lon=" + position.coords.longitude);
//     xhttp.send();
//     xhttp.onreadystatechange = function() {
//       if (this.readyState == 4 && this.status == 200) {
//         const country = JSON.parse(this.responseText);
//         country_code = String(country.country);

//         const xhttp_currency = new XMLHttpRequest();
//         xhttp_currency.open("GET", "_engine/_get_currency.php?name=" + country_code);
//         xhttp_currency.send();
//         xhttp_currency.onreadystatechange = function() {
//           if (this.readyState == 4 && this.status == 200) { 
//             var currency = JSON.parse(this.responseText);
//             local_currency =  String(currency.currency)
            
//             const xhttp_converter = new XMLHttpRequest();
//             xhttp_converter.open("GET", "_engine/_get_convert_amount.php?from=lkr&to="+local_currency+"&amount=1");
//             xhttp_converter.send();
//             xhttp_converter.onreadystatechange = function() {
//               if (this.readyState == 4 && this.status == 200) { 
//                 var amount = JSON.parse(this.responseText);
//                 converted_amount =  String(amount.amount);
//                 console.log(converted_amount);
//               }
//             }


//           }
//         }
        
//       }
//     };

//     const current_time = new XMLHttpRequest();
//     current_time.open("GET","_engine/_get_current_time.php?lat=" + position.coords.latitude + "&lon=" + position.coords.longitude);
//     current_time.send();
//     current_time.onreadystatechange = function() {
//       if (this.readyState == 4 && this.status == 200) {
//         const time = JSON.parse(this.responseText);
//         country_code = String(time.current_time);
//         var hour = parseInt(country_code.slice(-13,-11));
//         if ((hour > 4) && (hour < 12)) {
//           welcome_message.innerText = "Good Morning!";
//         } else if ((hour > 11) && (hour < 17)) {
//           welcome_message.innerText = "Good Afternoon!";
//         } else {
//           welcome_message.innerText = "Good Evening!";
//         }
//       }
//     };
// }

// window.onload = function() {
//     getLocation();
// }

// function getInfo() { // Using IP address to get information
//   const ip_info = new XMLHttpRequest();
//     ip_info.open("GET","_engine/get_info.php");
//     ip_info.send();
//     ip_info.onreadystatechange = function() {
//       if (this.readyState == 4 && this.status == 200) {
//         const info = JSON.parse(this.responseText);
//         currency_code = String(info.currency);
//         current_time = String(info.current_time);
//         var hour = parseInt(current_time.slice(0,2));
//         if ((hour > 4) && (hour < 12)) {
//           welcome_message.innerText = "Good Morning!";
//         } else if ((hour > 11) && (hour < 17)) {
//           welcome_message.innerText = "Good Afternoon!";
//         } else {
//           welcome_message.innerText = "Good Evening!";
//         }
//         local_currency = currency_code;
//         converted_amount = String(info.amount);
//       }
//     }
  
// }

// // Checking geolocation permission 
// navigator.permissions.query({name:'geolocation'}).then(function(result) {
//   if (result.state == 'denied') {
//     getInfo();
    
//   } 
//   result.onchange =  function() {     
//     if (result.state == 'denied') {
//       console.log("No");
//     } 
//   } // Getting IP address if the permission is denied 

  


// // console.log(local_currency)

// var currency_update_counter = 0;
// function displayCurrency() {
//   if (currency_update_counter == 2) {
//     clearInterval(update_currency);
//   }
//   currency_update_counter++;

// }

// update_currency = setInterval(displayCurrency, 1000);