<?php include("views/include/header.php"); ?>


    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Favorites product</li>
            </ol>
        </nav>
        <br> <h1 class="h3 mb-3 font-weight-normal">Favorites product</h1>
        <hr class="featurette-divider">
        <?php if ($products) {?>
        <table class="tab-cart" align="center" valign="center">
            <tr>
                <td class="font-weight-bold text-info">Name of product</td>
                <td class="font-weight-bold text-info">Price</td>
                <td class="font-weight-bold text-info">Image</td>
                <td class="font-weight-bold text-info">Brand</td>
                <td class="font-weight-bold text-info">Description</td>
                <td class="font-weight-bold text-info">Delete</td>
            </tr>

            <?php  for ($i=0; $i<count($products); $i++) { ?>
                <tr>
                    <td><?php echo  $products[$i]->getProductName();?> </td>
                    <td><?php echo  $products[$i]->getPrice();?> грн </td>
                    <td><img src="../components/<?php echo  $products[$i]->getImage();?>" class="im-cart"/></td>
                    <td><?php echo  $products[$i]->getBrand();?> </td>
                    <td><?php echo  $products[$i]->getDescription();?> </td>
                    <td> <a href="/delete/favorites/<?php echo  $products[$i]->getIdProduct();?>"
                            class="btn btn-info my-2 my-sm-0" name="view-btn">Delete</a>
                        </button></td>
                </tr>
            <?php } ?>


        </table>
        <?php } else {?>
            <p><span>The list is empty</span></p>
        <?php }?>
<br>
        <br><br><br><br>
        <a class="btn  btn-primary" href="/cabinet">Back</a>
<hr class="featurette-divider"><br>
</div>

<?php include("views/include/footer.php"); ?>