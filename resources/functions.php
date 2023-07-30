<?php

/****************************************FRONT END FUNCTIONS**********************************************/
function listCategories() {
    global $connection;
    $catQuery = query("SELECT * FROM categories");
        while ($row = mysqli_fetch_assoc($catQuery)) {
            $catTitle = $row['cat_title'];
            $catId = $row['cat_id'];
            echo"<a href='category.php?category=$catId' class='list-group-item'>$catTitle</a>";
        }
}

function listCategoriesAdmin() {
    global $connection;
    $catQuery = query("SELECT * FROM categories");
        while ($row = mysqli_fetch_assoc($catQuery)) {
            $catTitle = $row['cat_title'];
            $catId = $row['cat_id'];
            $category = <<<DELIMITER
            <tr>
                <td>$catId</td>
                <td>$catTitle</td>
                <td><a class='btn btn-danger' href="../../resources/templates/back/delete_category.php?id=$catId"><span class='glyphicon glyphicon-remove'></span></a></td>
                <td><a class='btn btn-warning' href="index.php?source=categories&edit_id=$catId">Edit</a></td>  
  
            </tr>

        DELIMITER;

        echo $category;

        }
}

function listUsers() {
    $result = query("SELECT * FROM users");
    while ($row = fetchArray($result)) {

        $username = $row['username'];
        $email = $row['user_email'];
        $id = $row['user_id'];
    
        $users = <<<DELIMITER

        <tr>
            <td>$id</td>
            <td>$username</td>
            <td>$email</td>
            <td><a class='btn btn-danger' href="../../resources/templates/back/delete_user.php?id=$id"><span class='glyphicon glyphicon-remove'></span></a></td>

        </tr>

        DELIMITER;
        echo $users;
    }
}


function addUser() {

    
    if(isset($_POST['addUser']) && !empty($_POST['addUser'] )) {

        global $connection;

        $username = trim(escape_string($_POST['username']));
        $email = trim(escape_string($_POST['email']));
        $firstName = trim(escape_string($_POST['firstName']));
        $lastName = trim(escape_string($_POST['lastName']));
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 12));

        $result = query("SELECT * FROM users WHERE username='{$username}' OR user_email='{$email}'");
    
        if (fetchArray($result) !== null) {
            echo "<h2>Username or email already taken.</h2>";
        } else {
            $check = query("INSERT INTO users (username, password, user_email, user_firstname, user_lastname) VALUES ('{$username}', '{$password}', '{$email}',' {$firstName}', '{$lastName}')");
            if (!$check) {
                echo "Error. " . mysqli_error($connection);
            }
        }

    }

}



function deleteUser() {
    if(isset($_GET['id'])) {
        query("DELETE FROM users WHERE user_id=" . escape_string($_GET['id']));
        redirect("../../../public/admin/index.php?source=users");
    }
}

function editCategory() {
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $newTitle = $_POST['newTitle'];
        $id = $_GET['id'];
        query("UPDATE categories SET cat_title = '{$newTitle}' WHERE cat_id='{$id}'");
        redirect("../../../public/admin/index.php?source=categories");
    }
}


function addCategory() {
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $categoryName = $_POST['catTitle'];
        $query = query("INSERT INTO categories (cat_title) VALUES ('{$categoryName}') ");
        redirect("../../../public/admin/index.php?source=categories");
    }
}

function deleteCategory() {
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        query("DELETE FROM categories WHERE cat_id=$id");
        redirect("../../../public/admin/index.php?source=categories");
    }
}

// Get Category Products
function getCategoryProducts($id) {

    $query = query("SELECT * FROM products WHERE product_category_id=" . escape_string($id) . " ");
    while($row = fetchArray($query)){

    $product = <<<DELIMITER

    <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="../resources/templates/uploads/{$row['product_image']}" alt="">
                <div class="caption">
                    <h3>{$row['product_name']}</h3>
                    <p>{$row['product_short_description']}</p>
                    <p>
                    <a href="" class="btn btn-primary">Buy Now!</a> <a href="item.php?product_id={$row['product_id']}" class="btn btn-default">More Info</a>
                    </p>
                </div>
        </div>
    </div>
    
    DELIMITER;

echo $product;

    }
}

function getShopProducts() {

    $query = query("SELECT * FROM products");
    while($row = fetchArray($query)){

    $product = <<<DELIMITER

    <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="../resources/templates/uploads/{$row['product_image']}" alt="">
                <div class="caption">
                    <h4 class='pull-right'>£{$row['product_price']}</h4>
                    <h4>{$row['product_name']}</h4>
                    <p>{$row['product_short_description']}</p>
                    <p>
                    <a class='btn btn-primary' href='../resources/cart.php?add={$row['product_id']}'>Add to Cart</a> <a href="item.php?product_id={$row['product_id']}" class="btn btn-default">More Info</a>
                    </p>
                </div>
        </div>
    </div>
    
    DELIMITER;

echo $product;

    }
}


// Get Products
function getProducts($itemsPerPage) {

    $query = query("SELECT * FROM products WHERE NOT product_quantity=0");

    $numItems = mysqli_num_rows($query);

    if(isset($_GET['page'])){
        $page = (preg_replace('#[^0-9]#', '', $_GET['page']));
    } else {
        $page = 1;
    }


    $perPage = $itemsPerPage;

    $lastPage = ceil($numItems / $perPage);

    if ($page < 1) {
        $page = 1;
    } elseif ($page > $lastPage) {
        $page = $lastPage;
    }
    
    $middleNumbers = '';

    $decrease1 = $page - 1;
    $decrease2 = $page - 2;
    $increase1 = $page + 1;
    $increase2 = $page + 2;


    if ($page == $lastPage && $lastPage == 1) {

        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

    }

    elseif ($page == 1) {

        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' .$increase1. '">' .$increase1. '</a></li>';


    } elseif($page == $lastPage) {

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' .$decrease1. '">' .$decrease1. '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';


        "<ul class='pagination'>$middleNumbers<ul>";


    } elseif ($page > 2 && $page < ($lastPage - 1)) {

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' .$decrease2. '">' .$decrease2. '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' .$decrease1. '">' .$decrease1. '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' .$increase1. '">' .$increase1. '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' .$increase2. '">' .$increase2. '</a></li>';

        "<ul class='pagination'>$middleNumbers<ul>";

    }

    elseif ($page > 1 && $page < ($lastPage)) {

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' .$decrease1. '">' .$decrease1. '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' .$increase1. '">' .$increase1. '</a></li>';

         "<ul class='pagination'>$middleNumbers<ul>";

    }

    $limit = 'LIMIT ' . ($page-1) * $perPage . ', ' . $perPage;

    $query = query("SELECT * FROM products WHERE NOT product_quantity=0 " . $limit);

    $outputPagination = '';

    if ($page == 1) {

        $outputPagination .= $middleNumbers;
    }

    if ($page != 1) {
        $prev = $page - 1;

        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' .$prev. '">Back</a></li>';
        $outputPagination .= $middleNumbers;
    }
    
    if ($page != $lastPage) {

        $next = $page + 1;

        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' .$next. '">Next</a></li>';

    }
    
    while ($row = fetchArray($query)) {
        $productId = $row['product_id'];
        $productName = $row['product_name'];
        $productCatId = $row['product_category_id'];
        $productPrice = $row['product_price'];
        $productDescription = $row['product_description'];
        $productImage = $row['product_image'];
        $productShortDesc = $row['product_short_description'];



        $product = <<<DELIMITER

        <div class='col-sm-4 col-lg-4 col-md-4'>
            <div class=''>
                <a href='item.php?product_id=$productId'><img src='../resources/templates/uploads/$productImage' width='260.48' height='122.09' alt=''></a>
                <div class='caption'>
                    <h4 class='pull-right'>£$productPrice</h4>
                    <h4><a href='index.php?product_id=$productId'>$productName</a>
                    </h4>
                    <p>$productShortDesc</p>
                    <a class='btn btn-primary' href='../resources/cart.php?add=$productId'>Add to Cart</a>
                </div>
            </div>
        </div>

        DELIMITER;

        echo $product;
    }


    if (!empty($outputPagination)) {
        echo "<div class='text-center' style='clear: both'><ul class='pagination'>$outputPagination</ul></div>";
    } else {
        $outputPagination .= $middleNumbers;
        echo "<div class='text-center' style='clear: both'><ul class='pagination'>$outputPagination</ul></div>";
    }
}

function set_message($msg) {

    if(!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }

}

function display_message() {

    if(isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }

}

function send_message() {

    if (isset($_POST['submit'])) {

        $to = "havenize@support.co";
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $content = $_POST['message'];

        $headers = "From: {$name} {$email}";

        $result = mail($to, $subject, $content, $headers);

        if (!$result) {
            echo "Error.";
        } else {
            echo"success";
        }


    }

}


function login_user() {
    
    if(isset($_POST['submit'])) {
        $username = trim(escape_string($_POST['username']));
        $password = trim(escape_string($_POST['password']));

        $query = query("SELECT * FROM users WHERE username='{$username}' AND password='{$password}'");
        $result = fetchArray($query);
        
        if (mysqli_num_rows($query) > 0) {
            if ($result['user_role'] === "Admin") {

                $_SESSION['user_role'] = "Admin";
                $_SESSION['username'] = $result['username'];
                redirect("admin");

            } else {
                $_SESSION['user_role'] = "User";
                $_SESSION['username'] = $result['username'];
                redirect("index.php");
            }
 

        } else {
            set_message("Username or Password incorrect.");
            redirect("login.php");
        }

    }

}


function listCart() {

    $total = 0;
    $sub = 0;
    $item_quantity = 0;
    $item_name = 1;
    $item_number = 1;
    $amount = 1;
    $quantity = 1;

    foreach($_SESSION as $name => $value) {
        
        if ($value > 0) {

        if(substr($name, 0, 8) == "product_") {

            $length = strlen($name) - 8;
            $id = substr($name, 8, $length);

            $query = query("SELECT * FROM products WHERE product_id =" . escape_string($id));
            while ($row = mysqli_fetch_assoc($query)) {
                $numitems = $_SESSION['product_' . $id];
                $productName = $row['product_name'];
                $productPrice = $row['product_price'];
                $productId = $row['product_id'];
                $productImage = $row['product_image'];
                $sub = $productPrice * $numitems;
                $item_quantity += $value;
        
                $product = <<<DELIMITER
                    <tr>
                        <td>$productName<br>
                        <img src="../resources/templates/uploads/$productImage" width='260.48' height='122.09'
                        </td>
                        <td>£$productPrice</td>
                        <td>$numitems</td>
                        <td>£$sub</td>
                        <td>
                        <a class='btn btn-warning' href="../resources/cart.php?remove=$productId"><span class='glyphicon glyphicon-minus'></span></a>  
                        <a class='btn btn-success' href="../resources/cart.php?add=$productId"><span class='glyphicon glyphicon-plus'></span></a>
                        <a class='btn btn-danger' href="../resources/cart.php?delete=$productId"><span class='glyphicon glyphicon-remove'></span></a>
                        </td>
                    </tr>
                    <input type="hidden" name="item_name_$item_name" value="$productName"> 
                    <input type="hidden" name="item_number_$item_number" value="$productId"> 
                    <input type="hidden" name="amount_$amount" value="$productPrice">
                    <input type="hidden" name="quantity_$quantity" value="$numitems">
        
                DELIMITER;
        
                echo $product;

                $item_name++;
                $item_number++;
                $amount++;
                $quantity++;

                
        
                }

                $_SESSION['cart_total'] = ($total += $sub);
                $_SESSION['item_quant'] = $item_quantity;
                
            
        }


    }

    }
   
}

function last_id() {
    global $connection;
    return mysqli_insert_id($connection);
}

function report() {

    global $connection;
    if(isset($_GET['tx'])) {

        $amount = $_GET['amt'];
        $currency = $_GET['cc'];
        $transaction = $_GET['tx'];
        $status = $_GET['st'];
    


    $total = 0;
    $item_quantity = 0;

    foreach($_SESSION as $name => $value) {
        
        if ($value > 0) {

        if(substr($name, 0, 8) == "product_") {

            $length = strlen($name) - 8;
            $id = substr($name, 8, $length);
            $sendorder = query("INSERT INTO orders (order_amount, order_transaction, order_currency, order_status) VALUES ('{$amount}', '{$transaction}', '{$currency}', '{$status}')");
            $last_id = last_id();

            $query = query("SELECT * FROM products WHERE product_id =" . escape_string($id));

            while ($row = mysqli_fetch_assoc($query)) {
                $numitems = $_SESSION['product_' . $id];
                $productName = $row['product_name'];
                $productPrice = $row['product_price'];
                $productId = $row['product_id'];
                $sub = $productPrice * $numitems;
                $item_quantity += $value;

                $insert_report = query("INSERT INTO reports (order_id, product_id, product_name, product_price, product_quantity) VALUES ('{$last_id}', '{$productId}', '{$productName}', '{$sub}', '{$value}')");
                }

            $total += $sub;
            $item_quantity;
                
            
        }


    }

    }
}
}

// <th>Order ID</th>
// <th>Amount Paid</th>
// <th>Currency</th>
// <th>Transaction Number</th>
// <th>Status</th>

function listOrders() {
    global $connection;


    $query = query("SELECT * FROM orders");
    while ($row = fetchArray($query)) {

        $orderId = $row['order_id'];
        $orderAmount = $row['order_amount'];
        $orderCurrency = $row['order_currency'];
        $orderStatus = $row['order_status'];
        $orderTransactionId = $row['order_transaction'];

        $order = <<<DELIMITER

            <tr>
                <td>$orderId</td>
                <td>$orderAmount</td>
                <td>$orderCurrency</td>
                <td>$orderTransactionId</td>
                <td>$orderStatus</td>
                <td><a class='btn btn-danger' href="../../resources/templates/back/delete_order.php?id=$orderId"><span class='glyphicon glyphicon-remove'></span></a></td>

            </tr>

            DELIMITER;

            echo $order;

        
    }

    

    
}

function deleteOrder() {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = query("DELETE FROM orders WHERE order_id =" . escape_string($id));
        redirect("../../../public/admin/index.php?source=orders");
        
    }
}










function show_paypal() {

    $paypal_button = <<<DELIMITER

    <input type="image" name="upload" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">

    DELIMITER;

    return $paypal_button;

}




/****************************************BACK END FUNCTIONS**********************************************/


function adminDisplayProducts() {

    
    $result = query("SELECT products.product_id, products.product_name, products.product_category_id, products.product_price, products.product_quantity, products.product_image, categories.cat_id, categories.cat_title FROM products INNER JOIN categories ON products.product_category_id = categories.cat_id");
    if (!$result) {
        echo "Error";
    }
    while ($row = fetchArray($result)) {

        $id = $row['product_id'];
        $title = $row['product_name'];
        $catTitle = $row['cat_title'];
        $price = $row['product_price'];
        $quantity = $row['product_quantity'];
        $image = $row['product_image'];

        $product = <<<DELIMITER

        <tr>
            <td>$id</td>
            <td>$title<br>
            <img src="../../resources/templates/uploads/$image" height="100" width="100" alt="">
            </td>
            <td>$catTitle</td>
            <td>$price</td>
            <td>$quantity</td>
            <td><a href="index.php?source=edit_product&id=$id"><button class="btn btn-primary btn-warning">Edit</button</a></td>
            <td><a href="../../resources/templates/back/delete_product.php?id=$id"><button class="btn btn-primary btn-danger">Remove</button</a></td>
        </tr>

        DELIMITER;

        echo $product;

    }

}

function adminListCategories() {

    $result = query("SELECT * FROM categories");
    while ($row = fetchArray($result)) {
        $catId = $row['cat_id'];
        $catTitle = $row['cat_title'];

        $category = <<<DELIMITER

        <option value="$catId">$catTitle</option>

        DELIMITER;

        echo $category;
    }
}

function adminListEditCategories($id) {

    $result = query("SELECT * FROM categories");
    while ($row = fetchArray($result)) {
        $catId = $row['cat_id'];
        $catTitle = $row['cat_title'];

        if($catId === $id) {

            $category = <<<DELIMITER

        <option selected="selected" value="$catId">$catTitle</option>

        DELIMITER;

        echo $category;


        } else {

        $category = <<<DELIMITER

        <option value="$catId">$catTitle</option>

        DELIMITER;

        echo $category;
        
        }
    }
}

function adminAddProduct() {

    if (isset($_POST['addproduct'])) {

        $productCategory = escape_string($_POST['product_category']);
        $productPrice = escape_string($_POST['product_price']);
        $productTitle = escape_string($_POST['product_title']);
        $productDescription = escape_string($_POST['product_description']);
        $productShortDescription = escape_string($_POST['short_desc']);
        $productQuantity = escape_string($_POST['product_quantity']);
        $productImage = $_FILES['file']['name'];
        $imageTempLocation = $_FILES['file']['tmp_name'];

        move_uploaded_file($imageTempLocation, UPLOAD_DIRECTORY . DS . $productImage);

        $result = query("INSERT INTO products (product_name, product_category_id, product_price, product_quantity, product_description, product_image, product_short_description) VALUES ('{$productTitle}', '{$productCategory}', '{$productPrice}', '{$productQuantity}', '{$productDescription}', '{$productImage}', '{$productShortDescription}')");
        if (!$result) {
          echo "Error: " . mysqli_error($result);
        }
        redirect("index.php?source=products");





    }




}

function adminEditProduct($id) {

    global $connection;

    if (isset($_POST['editproduct'])) {

        $productId = $id;
        $productCategory = escape_string($_POST['product_category']);
        $productPrice = escape_string($_POST['product_price']);
        $productTitle = escape_string($_POST['product_title']);
        $productDescription = escape_string($_POST['product_description']);
        $productShortDescription = escape_string($_POST['short_desc']);
        $productQuantity = escape_string($_POST['product_quantity']);

        $productImage = $_FILES['file']['name'];
        $imageTempLocation = $_FILES['file']['tmp_name'];

        if (empty($productImage)) {
            $imageQuery = query("SELECT * FROM products WHERE product_id =" . escape_string($productId));
            $row = fetchArray($imageQuery);
            $productImage = $row['product_image'];

        }

        move_uploaded_file($imageTempLocation, UPLOAD_DIRECTORY . DS . $productImage);

        $result = query("UPDATE products SET product_name = '{$productTitle}', product_category_id = $productCategory, product_price = $productPrice, product_quantity = $productQuantity, product_description = '{$productDescription}', product_image = '{$productImage}', product_short_description = '{$productShortDescription}' WHERE product_id =" . escape_string($productId));
        if (!$result) {
          die("Error: " . mysqli_error($connection));
        }
        redirect("index.php?source=products");



    }
    }
    


    function adminDisplayReports() {

    
        $result = query("SELECT * FROM reports");
        if (!$result) {
            echo "Error";
        }
        while ($row = fetchArray($result)) {
    
            $id = $row['report_id'];
            $orderid = $row['order_id'];
            $productid = $row['product_id'];
            $productname = $row['product_name'];
            $price = $row['product_price'];
            $quantity = $row['product_quantity'];

    
            $report = <<<DELIMITER
    
            <tr>
                <td>$id</td>
                <td>$orderid</td>
                <td>$productid</td>
                <td>$price</td>
                <td>$productname</td>
                <td>$quantity</td>
                <td><a href="../../resources/templates/back/delete_report.php?id=$id"><button class="btn btn-primary btn-danger">Remove</button</a></td>

            </tr>
    
            DELIMITER;
    
            echo $report;
    
        }
    
    }











// Helper Functions
function redirect($location) {
    header("Location: $location");
}

function query($sql) {
    global $connection;
    return mysqli_query($connection, $sql);
}

function escape_string($string) {
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

function fetchArray($result) {
    return mysqli_fetch_assoc($result);
}

function image($image) {
    return "../public/images/$image";
}