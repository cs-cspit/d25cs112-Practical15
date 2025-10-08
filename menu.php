<?php
    function component($productname, $productprice, $productimg, $productid)
    {
        $element = "
        <div class=\"col-md-3 my-3 my-md-0\" style=\"width:380px;height:422px;\">
            <form action=\"index.php#menu\" method=\"post\">
                <div class=\"card\">
                    <img src=\"$productimg\" class=\"imgeffect\" style=\"width:100%;height:250px;\">
                    <div class=\"card-body\">
                        <center>
                            <h1 style=\"font-size:20px;\">$productname</h1>
                        </center>
                        <center><h5>$productprice/-</h5></center><br>
                        <center>
                            <button type=\"submit\" class=\"btn bg-dark text-white rounded-3\" name=\"add\" id=\"btneffect\">Add to Cart</button>
                            <input type='hidden' name='product_id' value='$productid'>
                        </center>
                    </div>
                </div>
            </form>
        </div>";
        echo $element;
    }
    function component2($productname, $productprice, $productimg)
    {
        $element = "
        <div class=\"col-md-3 my-3 my-md-0\" style=\"width:380px;height:422px;\">
            <form action=\"index.php#menu\" method=\"post\">
                <div class=\"card\">
                    <img src=\"$productimg\" class=\"imgeffect\" style=\"width:100%;height:250px;\">
                    <div class=\"card-body\">
                        <center>
                            <h1 style=\"font-size:20px;\">$productname</h1>
                        </center>
                        <center><h5>$productprice/-</h5></center><br>
                    </div>
                </div>
            </form>
        </div>";
        echo $element;
    }


function cartElement($productimg, $productname, $productprice, $productid)
{
    $element = "
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
        <div class=\"border rounded\">
            <div class=\"row bg-white\">
                <div class=\"col-md-3 pl-0\">
                    <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                </div>
                <div class=\"col-md-6\">
                    <h5 class=\"pt-2\">$productname</h5>
                    <h5 class=\"pt-2\" id=\"price-$productid\">$productprice/-</h5>
                    <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                </div>
                <div class=\"col-md-3 py-5\">
                    <div>
                        <input type=\"number\" name='quantity' class=\"form-control d-inline\" value=\"1\" min=\"1\" id=\"cart-quantity-$productid\" oninput=\"updateCartTotalPrice($productid, $productprice)\">
                        <h5>Total Price: <span id=\"cart-total-$productid\">$productprice/-</span></h5>
                    </div>
                </div>
            </div>
        </div>
    </form>
    ";
    echo $element;
}


?>
