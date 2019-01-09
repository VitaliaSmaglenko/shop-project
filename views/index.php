<?php
include("views/include/header.php");
?>

<div class="container">
    <div class="jumbotron p-3 p-md-5 text-white rounded p-3 mb-2 bg-info">

        <table class="tab-main" >
            <tr>

                <td width="50%">

                    <h1 class="font-italic">Some information about discounts and offers</h1>
                    <p class="lead my-3">little explanatory text.</p>

                </td>
                <td width="50%"  align="center" valign="center">
                    <img src="components/img/shopcard.png" width="200" height="200">
                </td>
            </tr>

        </table>
    </div>
</div>



<main role="main" class="container">
    <div class="row">
        <aside class="col-md-2 blog-sidebar">


            <div class="p-3">
                <h4 class="font-italic ">Categories</h4><br />
                <ol class="list-unstyled mb-0">
                    <?php   foreach ($categories as $category):
                        ?>
                        <li><a href="category/<?php echo $category['id'];?>" class="cat-link">
                        <?php ///echo $category['category'];
                        ///
                        $categoryObj->setCategory($category['category']);
                        echo $categoryObj->getCategory();
                        ?></a></li>
                        <?php
                    endforeach;?>
                </ol>
            </div>

            <div class="p-3">
                <h4 class="font-italic">Sorting</h4> <br />
                <ol class="list-unstyled">
                    <li><a class="cat-link" href="#">By price</a></li>
                    <li><a class="cat-link" href="#">By date</a></li>
                    <li><a class="cat-link" href="#">By popularity</a></li>
                </ol>
            </div>
        </aside>

        <div class="col-md-10 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom text-center font-weight-bold text-warning ">
                <hr class="featurette-divider">Hot sales</h3>


            <div class="container">
                <div class="row mb-4 col-xs-4">
                      <?php for ($i=0; $i<count($productList); $i++) {?>
                        <div class="card-deck mb-4 col-xs-4 text-center" style="width: 26%; margin: 15px; ">
                            <div class="card text-center mb-4 col-sm" style="width: 15rem;">
                                <img class="card-img-top" style="width: 150px; height: 150px; padding-top: 10px;" src="components/<?php echo  $productList[$i]->getImage();?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo   $productList[$i]->getName();?></h5>
                                    <p class="card-text"> Id: <?php echo  $productList[$i]->getId();?></p>
                                    <h6 class="card-title"><?php echo $productList[$i]->getPrice();?> грн</h6>
                                    <a href="product/<?php echo $productList[$i]->getId();?>" class="btn btn-primary" name="view-btn">View</a> <br>
                                    <a href="#" class="link-add-to-cart">Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }

                    ?>

                </div>
            </div>

        </div>


    </div>

</main>
<br>


<hr class="featurette-divider"><br>


<?php
include("views/include/footer.php");
?>