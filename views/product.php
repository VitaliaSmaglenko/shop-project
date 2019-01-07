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

                    <img class="featurette-image img-fluid mx-auto" src="../components/<?php echo $productObg->getImage();?>" alt="Generic placeholder image">
                </div> </td> <td width="50%">

                <div class="row featurette">
                    <div class="col-md-7 order-md-2">
                        <h3 class="featurette-heading"> <?php echo  $productObg->getName();?></h3>
                        <h4><span class="text-muted"><?php echo $productObg->getPrice();?></span></h4>
                        <p class="lead">Product character:</p>
                        <ul class="list-group list-group-flush">
                            <?php for($i=0; $i < count($productObg->getSpecifications()); $i++){?>
                                <li class="list-group-item"><?php echo $productObg->getSpecifications()[$i];?></li>
                            <?php }
                            ?>
                        </ul>
                    </div>
            </td>
        </tr>

        <tr>
            <td colspan="2"> <p class="lead"><?php echo $productObg->getDescription();?></p></td>
        </tr>

        <tr>
            <td colspan="2" class="td-sub"> <button class="btn btn-info my-2 my-sm-0" type="submit">Add to cart</button></td>
        </tr>
    </table>

</div>


</div>

<hr class="featurette-divider"><br>
<?php include("views/include/footer.php"); ?>
