// var password = $("#password_user_registration").val();
// var password_verification = $("#password_verification_user_registration").val();

// Navbar
nav_links = document.getElementsByClassName("main-nav");

Array.prototype.forEach.call(nav_links, function(nav_link) {
    $(nav_link).click(function(){
        Array.prototype.forEach.call(nav_links, function(nav_link) {
            // $(nav_link).removeClass("fw-bold");
            $(nav_link)[0].removeClass("bg-light");
            console.log($(nav_link).text());
        });
        // $(this).addClass("fw-bold");
        $(this).addClass("bg-light");
        console.log($(this).text());
    });
});




// Username verification by contacting the backend or database during user registration
$("#user_name_register").focusout(function(){
    $("#user_name_check").load("_engine/username_verification.php",{user_name:$("#user_name_register").val()});
});

// Email verification by contacting the backend or database during user registration
$("#user_email_register").focusout(function(){
    $("#email_check").load("_engine/user_email_verification.php",{user_email:$("#user_email_register").val()});
});


// Clearing the password verification message after re-entering a new password in the password box
$("#password_user_registration").focusout(function(){
    $("#password_check_user_registration").text('');
});

// Password verification by matching both passwords entered during user registration
$('#password_verification_user_registration').focusout(function(){
    if ($("#password_user_registration").val() != $("#password_verification_user_registration").val()) {
        $("#password_check_user_registration").html('<p class="verification_error">Your passwords don\'t match</p>')
        $("#password_user_registration").val('');
        $("#password_verification_user_registration").val('');
    }
});


// Clearing the login verification message after re-entering a new username in the username box
$("#user_name_login").focusout(function(){
    $("#login_verification").text('');
});

// Clearing the login verification message after re-entering a new password in the password box
$("#password_login").focusout(function(){
    $("#login_verification").text('');
});

// Username and password verification by comparing them with the user database during user login.
$("#login_form").submit(function(event){
    event.preventDefault();
    $("#login_verification").load("_engine/login_verfication.php",{
        user_name: $("#user_name_login").val(),
        password: $("#password_login").val()
    });
});


// Products Page
var catagories = document.getElementsByClassName("link-info"); // This would store the links from category_panel
var search_input = $("#products_page_search_input");
var search_button = $("#products_page_search_button");
var search = "%"; //Setting up a search variable to all
var category = "%"; //Setting up a category variable to all
// var location = "%" //Setting up a location variable to all
var i = window.location.href;
if ((i.search("category") != -1)) {
    i = i.replace(/%20/g," ");
    category = i.slice(83);

}

// This function will load products 
function load_products(display,search, category, local_currency, amount, content) {
    $(display).load(content ,{
        search: search,
        category: category, 
        currency: local_currency,
        conversion_rate: amount       
    });
}

// var counter = 0;
// function displayProduct() {
//   if (counter == 2) {
//     load_products("#products_page_display",search, category, "lkr", "1", "_engine/_get_product.php" );
//     load_products("#inventory_page_display",search, category, "lkr", "1", "_engine/get_inventory.php");
//     $(catagories[0]).css("font-weight", "bold");

//     // Search filer
//     search_button.click(function() {
//         search = search_input.val();
//         load_products("#products_page_display", search, category, "lkr", "1", "_engine/_get_product.php");
//         load_products("#inventory_page_display",search, category, "lkr", "1", "_engine/get_inventory.php"); 
//     });

//     // Category filter
//     Array.prototype.forEach.call(catagories, function(cat) {
//         $(cat).click(function(){
//             if (($(this).text()) == 'All') {
//                 category = '%';
//             } else {
//                 category = $(this).text();
//             }
//             load_products("#products_page_display", search, category, "lkr", "1", "_engine/_get_product.php");
//             load_products("#inventory_page_display",search, category, "lkr", "1", "_engine/get_inventory.php");
//             Array.prototype.forEach.call(catagories, function(cat) {
//                 $(cat).css("font-weight", "normal")
//             });
//             $(this).css("font-weight", "bold")
//         });
//     });

//     // load_products("#inventory_page_display",search, category, local_currency, converted_amount, "_engine/get_inventory.php");
 

//     // Homepage
//     var product_categories = document.getElementsByClassName("home_page_category");

//     Array.prototype.forEach.call(product_categories, function(product_category) {
//         $(product_category).click(function(){
//             console.log($(this).text());
//         });
//     });

    
//     clearInterval(update);
//   }
//   counter++;
//   console.log(counter);

// }

// update = setInterval(displayProduct, 1000);

// load_products("#products_page_display",search, category, local_currency, converted_amount, "_engine/_get_product.php" );
// $(catagories[0]).css("font-weight", "bold");

// Search filter
// search_button.click(function() {
//     search = search_input.val();
//     load_products("#products_page_display", search, category, local_currency, converted_amount, "_engine/_get_product.php");
//     load_products("#inventory_page_display",search, category, local_currency, converted_amount, "_engine/get_inventory.php"); 
// });

// search_input.focusout(function() {
//     search = search_input.val();
//     load_products("#products_page_display", search, category, local_currency, converted_amount, "_engine/_get_product.php");
//     load_products("#inventory_page_display",search, category, local_currency, converted_amount, "_engine/get_inventory.php");
// });

// Category filter
// Array.prototype.forEach.call(catagories, function(cat) {
//     $(cat).click(function(){
//         if (($(this).text()) == 'All') {
//             category = '%';
//         } else {
//             category = $(this).text();
//         }
//         load_products("#products_page_display", search, category, local_currency, converted_amount, "_engine/_get_product.php");
//         load_products("#inventory_page_display",search, category, local_currency, converted_amount, "_engine/get_inventory.php");
//         Array.prototype.forEach.call(catagories, function(cat) {
//             $(cat).css("font-weight", "normal")
//         });
//         $(this).css("font-weight", "bold")
//     });
// });


// Inventory page
// $("#inventory_page_display").load("_engine/get_inventory.php")

// API Page
$("#api_info_display").load("resources/pages/api_pages/api_page.php");
$("#a").click(function(){
    // action goes here!!
    $("#api_info_display").load("resources/pages/api_pages/api_page.php");
    
    $("#a").addClass("reverse_color");
    $("#laa").removeClass("reverse_color");
    $("#pa").removeClass("reverse_color");
    $("#la").removeClass("reverse_color");
});

$("#laa").click(function(){
    // action goes here!!
    $("#api_info_display").load("resources/pages/api_pages/local_amount_api_page.php");
    $("#laa").addClass("reverse_color");
    $("#a").removeClass("reverse_color");
    $("#pa").removeClass("reverse_color");
    $("#la").removeClass("reverse_color");
});

$("#pa").click(function(){
    // action goes here!!
    $("#api_info_display").load("resources/pages/api_pages/product_api_page.php");
    
    $("#pa").addClass("reverse_color");
    $("#a").removeClass("reverse_color");
    $("#laa").removeClass("reverse_color");
    $("#la").removeClass("reverse_color");
});

$("#la").click(function(){
    // action goes here!!
    $("#api_info_display").load("resources/pages/api_pages/login_api_page.php");    
    $("#la").addClass("reverse_color");
    $("#a").removeClass("reverse_color");
    $("#pa").removeClass("reverse_color");
    $("#laa").removeClass("reverse_color");
});

// $("#api_generate_button").click(function(){
//     const xhttp = new XMLHttpRequest();
//     xhttp.open("GET", "_engine/_create_api_key.php?app_id=" + $("#app_id").val());
//     xhttp.send();
// });

// Product page
$("#comments").load("_engine/_get_comments.php", {
    product: product_id
});






