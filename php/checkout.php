
<?php
if (!isset($_SESSION))
{
    session_start();
}

$itemsCount = 0;
$totalPrice = 0;

if (isset($_SESSION["shoppingCart"]))
{
    foreach ($_SESSION['shoppingCart']  as $value) 
    {
        $itemsCount += $value['count'];
        $totalPrice += $value['price'] * $value['count'];
    }
}

function requireField($input) {
    $errorMessage = "Please complete all fields of the form.";
    $successMessage = "Thank you for your order";
    $message = "";

    if (empty($input)) {
        echo "<script>alert('$errorMessage');</script>";
    } else {
        echo "<script>alert('$successMessage');</script>";
        unset($_SESSION['shoppingCart']);
        $totalPrice = 0;
    }
 }



function validateEmail($email) {
    $errorMessage = "Please enter a valid email address.";
    $successMessage = "Thank you for your order";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('$errorMessage');</script>";
    }
}

function isNumber($zip) {

    if (is_numeric($zip && is_int($zip))) {
        return true;
    } else {
        return false;
    }

}


if (isset($_GET["submit"])) {

    $firstName = isset($_GET["firstName"]) ? $_GET["firstName"] : "";
    $lastName = isset($_GET["lastName"]) ? $_GET["lastName"] : "";
    $email = isset($_GET["email"]) ? $_GET["email"] : "";
    $address = isset($_GET["address"])? $_GET["address"] : "";
    $city = isset($_GET["city"]) ? $_GET["city"] : "";
    $zip = isset($_GET["zip"]) ? $_GET["zip"] : "";
    $country = isset($_GET["country"]) ? $_GET["country"] : "";
    $message = isset($_GET["message"]) ? $_GET["message"] : "";
    $cardName = isset($_GET["nameCard"]) ? $_GET["nameCard"] : "";
    $cardNumber = isset($_GET["cardNumber"]) ? $_GET["cardNumber"] : "";
    $secureCode = isset($_GET["secureCode"]) ? $_GET["secureCode"] : "";


    requireField($firstName AND $lastName AND $email AND $address AND $city AND $zip AND $country AND $message AND $cardName AND $cardNumber AND $secureCode);
    validateEmail($email);
    isNumber($zip);
    isNumber($cardNumber);
    isNumber($secureCode);

    if (isNumber($zip) == false) {
        $zipErrorMessage = "Please enter a valid zip code";
        echo "<script>alert('$zipErrorMessage');</script>";
    }
    if (isNumber($cardNumber) == false) {
        $NumberCardErrorMessage ="Please enter a valid card number";
        echo "<script>alert('$NumberCardErrorMessage');</script>";
    }
    if (isNumber($secureCode) == false) {
        $secureCodeErrorMessage = "Please enter a valid security code";
        echo "<script>alert('$secureCodeErrorMessage');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />
    <link rel="stylesheet" href="../dist/style.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AZ-Store</title>
    <script defer src="../script/main.js"></script>
</head>
<body class="bg-gradient-to-b from-gray-900 text-white to-black">
        
<?php
require 'partials/nav.php';
?>
<section class="bg-gradient-to-b from-gray-900  text-white to-black py-20 lg:py-[120px] overflow-hidden relative z-10">
   <div class="container flex flex-row">
      <div class="flex flex-col">
         <div class="w-full px-4">
            <div class="w-[600px] mb-12 lg:mb-0">
               <h2
                  class="
                  text-white
                  mb-6
                  uppercase
                  font-bold
                  text-[32px]
                  sm:text-[40px]
                  lg:text-[36px]
                  xl:text-[40px]
                  "
                  
                  >
                  YOUR ORDER
            <div class="flex flex-col items-center gap-0.5"> 
               </h2>
                        <?php
                    if (isset($_SESSION['shoppingCart']))
                    {
                        foreach ($_SESSION['shoppingCart'] as $value) 
                        {
                            ?>
                            <div class="px-3 mb-3">
                            <div class="flex justify-around w-full rounded-lg items-center bg-white text-black py-3 px-3">
                                <img src="<?php echo $value['img']; ?>" alt="" class="w-20">
                                <h4><?php echo $value['name']; ?></h4>
                                <div class="flex items-center">
                                    <div><?php echo $value['count']; ?></div>
                                </div>
                                <div><?php echo $value['price']."€"; ?></div>
                            </div>
                            </div>

                
                            <?php
                        }   
                    }

                    ?>
                </div>
                <div class="flex justify-around w-full rounded-lg items-center bg-white text-black py-3 px-3 mb-3">
                    <p>Total</p>
                    <div><?php
                     echo $totalPrice."€"; 
                     ?>
                     </div>
                </div>
               <section>
                <div class="px-3 w-full">
                    <div class="w-full mx-auto rounded-lg bg-white border border-gray-200 text-gray-800 font-light mb-6">
                        <div class="w-full p-3 border-b border-gray-200">
                            <div class="mb-5">
                                <label for="type1" class="flex items-center cursor-pointer">
                                    <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="type" id="type1" checked>
                                    <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" class="h-6 ml-3">
                                </label>
                            </div>
                            <div>
                                <div class="mb-3">
                                    <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Name on card</label>
                                    <div>
                                        <input name="nameCard" class="w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="John Smith" type="text"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Card number</label>
                                    <div>
                                        <input name="cardNumber" class="w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="0000 0000 0000 0000" type="text"/>
                                    </div>
                                </div>
                                <div class="mb-3 -mx-2 flex items-end">
                                    <div class="px-2 w-1/4">
                                        <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Expiration date</label>
                                        <div>
                                            <select class="form-select w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                                                <option value="01">01 - January</option>
                                                <option value="02">02 - February</option>
                                                <option value="03">03 - March</option>
                                                <option value="04">04 - April</option>
                                                <option value="05">05 - May</option>
                                                <option value="06">06 - June</option>
                                                <option value="07">07 - July</option>
                                                <option value="08">08 - August</option>
                                                <option value="09">09 - September</option>
                                                <option value="10">10 - October</option>
                                                <option value="11">11 - November</option>
                                                <option value="12">12 - December</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="px-2 w-1/4">
                                        <select class="form-select w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                        </select>
                                    </div>
                                    <div class="px-2 w-1/4">
                                        <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Security code</label>
                                        <div>
                                            <input name="secureCode" class="w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="000" type="text"/>
                                        </div>
                                    </div>
               </section>
            </div>
         </div>
         <div class="lg:mr-8 mb-4 lg:mb-0 md:w-full lg:w-full xl:w-5/12 px-4 ml-4 ">
            <div class="bg-white relative rounded-lg p-8 sm:p-12 shadow-lg">
               <form method="get" action="">
                  <div class="mb-6">
                     <input
                        type="text"
                        placeholder="Your Name"
                        class="
                        w-full
                        rounded
                        py-3
                        px-[14px]
                        text-body-color text-base
                        border border-[f0f0f0]
                        outline-none
                        focus-visible:shadow-none
                        focus:border-primary
                        "
                        name="firstName"
                        />
                  </div>
                  <div class="mb-6">
                     <input
                        type="text"
                        placeholder="Your Lastname"
                        class="
                        w-full
                        rounded
                        py-3
                        px-[14px]
                        text-body-color text-base
                        border border-[f0f0f0]
                        outline-none
                        focus-visible:shadow-none
                        focus:border-primary
                        "
                        name="lastName"
                        />
                  </div>
                  <div class="mb-6">
                     <input
                        type="email"
                        placeholder="Your Email"
                        class="
                        w-full
                        rounded
                        py-3
                        px-[14px]
                        text-body-color text-base
                        border border-[f0f0f0]
                        outline-none
                        focus-visible:shadow-none
                        focus:border-primary
                        "
                        name="email"
                        />
                  </div>
                  <div class="mb-6">
                     <input
                        type="text"
                        placeholder="Your Address"
                        class="
                        w-full
                        rounded
                        py-3
                        px-[14px]
                        text-body-color text-base
                        border border-[f0f0f0]
                        outline-none
                        focus-visible:shadow-none
                        focus:border-primary
                        "
                        name="address"
                        />
                  </div>
                  <div class="mb-6">
                     <input
                        type="text"
                        placeholder="Your City"
                        class="
                        w-full
                        rounded
                        py-3
                        px-[14px]
                        text-body-color text-base
                        border border-[f0f0f0]
                        outline-none
                        focus-visible:shadow-none
                        focus:border-primary
                        "
                        name="city"
                        />
                  </div>
                  <div class="mb-6">
                     <input
                        type="text"
                        placeholder="Your ZIP Code"
                        class="
                        w-full
                        rounded
                        py-3
                        px-[14px]
                        text-body-color text-base
                        border border-[f0f0f0]
                        outline-none
                        focus-visible:shadow-none
                        focus:border-primary
                        "
                        name="zip"
                        />
                  </div>
                  <div class="mb-6">
                     <input
                        type="text"
                        placeholder="Your Country"
                        class="
                        w-full
                        rounded
                        py-3
                        px-[14px]
                        text-body-color text-base
                        border border-[f0f0f0]
                        outline-none
                        focus-visible:shadow-none
                        focus:border-primary
                        "
                        name="country"
                        />
                  </div>
                  <div class="mb-6">
                     <textarea
                        rows="6"
                        placeholder="Your Message for delivery"
                        class="
                        w-full
                        rounded
                        py-3
                        px-[14px]
                        text-body-color text-base
                        border border-[f0f0f0]
                        resize-none
                        outline-none
                        focus-visible:shadow-none
                        focus:border-primary
                        "
                        name="message"
                        ></textarea>
                  </div>
                  <div>
                     <button
                        type="submit"
                        class="
                        w-full
                        text-black
                        bg-primary
                        rounded
                        border border-primary
                        p-3
                        transition
                        hover:bg-opacity-90
                        "
                        name="submit"
                        >
                        ORDER
                     </button>
                  </div>
               </form>
            </div>
        </div>
         </div>
      </div>
   </div>
</section>

<?php

require 'partials/footer.php'; 
?>



