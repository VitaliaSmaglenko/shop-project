<?php
include("views/include/header.php");
?>


<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
    </nav>

    <br> <hr class="featurette-divider">

    <h2 class="text-center">Your cart is empty</h2>
    <table class="tab-cart" align="center" valign="center">
        <tr>
            <td class="font-weight-bold text-info">Name of product</td>
            <td class="font-weight-bold text-info">Id</td>
            <td class="font-weight-bold text-info">Iamge</td>
            <td class="font-weight-bold text-info">Amount</td>
            <td class="font-weight-bold text-info">Delete</td>
        </tr>
        <?php  for($i=0; $i<3; $i++){ ?>
            <tr>
                <td>Name of product:</td>
                <td>Id: 1111 </td>
                <td><img src="" class="im-cart"/></td>
                <td> <button class="btn btn-info btn-del"> - </button>
                    <input type="number" class="count-product">  <button class="btn btn-info btn-del">+</button></td>
                <td><button class="btn btn-info btn-del">Delete</button></td>
            </tr>
        <?php } ?>
        <tr><td  class="td-sub" colspan="5"><button class="btn btn-info btn-del">Checkout</button></td></tr>
    </table>

    <hr class="featurette-divider"><br>

</div>

<?php
include("views/include/footer.php");
?>


