<?php include("views/include/header.php"); ?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product</li>
        </ol>
    </nav>

    <hr class="featurette-divider">

    <table class="tb-product" align="center" valign="center">
        <tr>
            <td width="50%" rowspan="1">
                <div class="col-md-5 order-md-1">

                    <img class="featurette-image img-fluid mx-auto" src="../components/<?php echo $product->getImage();?>" alt="Generic placeholder image">
                </div> </td> <td width="50%">

                <div class="row featurette">
                    <div class="col-md-7 order-md-2">
                        <h3 class="featurette-heading"> <?php echo  $product->getName();?></h3>
                        <h4><span class="text-muted"><?php echo $product->getPrice();?></span></h4>
                        <p class="lead">Product character:</p>
                        <ul class="list-group list-group-flush">
                            <?php for($i=0; $i < count($product->getSpecifications()); $i++){?>
                                <li class="list-group-item"><?php echo $product ->getSpecifications()[$i];?></li>
                            <?php }
                            ?>
                        </ul>
                    </div>
            </td>
        </tr>

        <tr>
            <td colspan="2"> <p class="lead"><?php echo $product->getDescription();?></p></td>
        </tr>
        <?php if(!$cart){?>
        <tr>
            <td colspan="2" class="td-sub">
                <a href="../add/<?php echo $product->getId();?>" class="btn btn-info my-2 my-sm-0" name="view-btn">Add to cart</a>
            </td>
        </tr>

        <?php } else{?>
            <tr>
                <td colspan="2" class="td-sub"><p class="lead font-weight-bold">Item in cart</p> </td>
                </tr>
            <tr>
                <td colspan="2" class="td-sub">
                    <a href="../add/<?php echo $product->getId();?>" class="btn btn-info my-2 my-sm-0" name="view-btn">Add one more</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</div>


</div>

<hr class="featurette-divider"><br>
<?php include("views/include/footer.php"); ?>
