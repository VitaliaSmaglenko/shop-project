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


    <?php if ($cart) {?>
    <h2 class="text-center">Cart</h2>
    <table class="tab-cart" align="center" valign="center">
        <tr>
            <td class="font-weight-bold text-info">Name of product</td>
            <td class="font-weight-bold text-info">Price</td>
            <td class="font-weight-bold text-info">Iamge</td>
            <td class="font-weight-bold text-info">Amount</td>
            <td class="font-weight-bold text-info">Delete</td>
        </tr>

        <?php  for ($i=0; $i<count($products); $i++) { ?>
            <tr>
                <td><?php echo  $products[$i]->getName();?> </td>
                <td><?php echo  $products[$i]->getPrice();?> грн </td>
               <td><img src="components/<?php echo  $products[$i]->getImage();?>" class="im-cart"/></td>
                <td>  <a href="/minus/<?php echo  $products[$i]->getId();?>"
                         class="btn btn-info my-2 my-sm-0" name="view-btn">-</a>

                    <input disabled type="text"   class="count-product arrow"
                     value="<?php echo  $cart[$products[$i]->getId()];?>">
                    <?php if ($products[$i]->getAvailability() != 0) {?>
                    <a href="/plus/<?php echo  $products[$i]->getId();?>"
                       class="btn btn-info my-2 my-sm-0" name="view-btn">+</a>
                    <?php }?>
                <td> <a href="/delete/<?php echo  $products[$i]->getId();?>"
                        class="btn btn-info my-2 my-sm-0" name="view-btn">Delete</a>
                        </button></td>
            </tr>
        <?php } ?>
            <tr>
                <td class="td-sub font-weight-bold text-info" colspan="5">Total price: <?php echo $price;?> грн</td>
            </tr>
        <tr><td  class="td-sub" colspan="5">
                <a href="/checkout" class="btn btn-info my-2 my-sm-0" name="view-btn">Checkout</a>
            </td></tr>
    <?php } else {?>
        <h2 class="text-center">Your cart is empty</h2>
        <?php } ?>
    </table>

    <hr class="featurette-divider"><br>

</div>

<?php
include("views/include/footer.php");
?>


