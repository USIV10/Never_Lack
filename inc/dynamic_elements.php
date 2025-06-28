<?php

function prodElement($product_details){
    $img_path = isset($product_details['img_path']) ? htmlspecialchars($product_details['img_path']) : '';
    $name = isset($product_details['name']) ? htmlspecialchars($product_details['name']) : 'Unknown Product';
    $description = isset($product_details['description']) ? htmlspecialchars($product_details['description']) : 'No description available.';
    $prev_price = isset($product_details['prev_price']) ? $product_details['prev_price'] : 0;
    $current_price = isset($product_details['current_price']) ? $product_details['current_price'] : 0;
    $id = isset($product_details['id']) ? htmlspecialchars($product_details['id']) : '';

    $element = "
        <div class=\"col-lg-3 col-md-6 col-sm-12 col-sm-6 my-3 rounded-0\">
            <form action=\"shop.php\" method=\"post\" onsubmit=\"showSuccessMessage();\">
                <div class=\"card shadow rounded-0\">
                    <div class='position-relative rounded-0'>
                        <img src=\"$img_path\" alt=\"Image1\" class=\"img-fluid product-img card-img-top rounded-0\">
                    </div>
                    <div class=\"card-body rounded-0\">
                        <h5 class=\"card-title\">$name</h5>
                        <p class=\"card-text\">$description</p>
                        <h5>
                            ".($prev_price > 0 ? "<small><s class=\"text-secondary\">$ ".number_format($prev_price, 2)."</s></small>" : "")."
                            <span class=\"price\">$ ".number_format($current_price, 2)."</span>
                        </h5>
                        <button type=\"submit\" class=\"btn btn-primary my-3 rounded-0\" name=\"add\">
                            <i class=\"fa fa-cart-plus\"> Add to Cart</i>
                        </button>
                        <input type='hidden' name='product_id' value='$id'>
                    </div>
                </div>
            </form>
        </div>
    ";
    echo $element;
}

function cartItems($product_details){
    $img_path = isset($product_details['img_path']) ? htmlspecialchars($product_details['img_path']) : '';
    $name = isset($product_details['name']) ? htmlspecialchars($product_details['name']) : 'Unknown Product';
    $description = isset($product_details['description']) ? htmlspecialchars($product_details['description']) : 'No description available.';
    $current_price = isset($product_details['current_price']) ? $product_details['current_price'] : 0;
    $id = isset($product_details['id']) ? htmlspecialchars($product_details['id']) : '';
    $quantity = isset($_SESSION['cart'][$product_details['id']]) ? $_SESSION['cart'][$product_details['id']] : 1;

    $element = "
        <form action=\"\" method=\"post\" class=\"cart-items\">
            <div class=\"border rounded\">
                <div class=\"row bg-white\">
                    <div class=\"col-md-3 pl-0\">
                        <div class=\"position-relative\">
                            <img src=\"$img_path\" alt=\"Image1\" class=\"img-fluid prod-img-cart\">
                        </div>
                    </div>
                    <div class=\"col-md-6 py-3\">
                        <h5 class=\"pt-2\">$name</h5>
                        <small class=\"text-secondary\">Description: $description</small>
                        <h5 class=\"pt-2\">$ ".number_format($current_price, 2)."</h5>
                        <button onclick=\"if(confirm('Are you sure to remove this item from list?') === true)location.replace('cart.php?action=removeItem&id=$id');\" type=\"button\" class=\"btn btn-outline-danger btn-sm rounded-0 mx-2\" name=\"remove\"><i class=\"fa fa-trash\"></i> Remove Item</button>
                    </div>
                    <div class=\"col-md-3 py-5\">
                        <div class=\"input-group\">
                            <button onclick=\"location.replace('cart.php?action=update_qty&pid=$id&operation=minus')\" type=\"button\" class=\"btn bg-light border rounded-0\"><i class=\"fa fa-minus\"></i></button>
                            <input type=\"text\" value=\"$quantity\" class=\"form-control w-25 d-inline text-center\" readonly>
                            <button onclick=\"location.replace('cart.php?action=update_qty&pid=$id&operation=add')\" type=\"button\" class=\"btn bg-light border rounded-0\"><i class=\"fa fa-plus\"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    ";
    echo $element;
}

?>
