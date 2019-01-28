<?php include("views/include/header.php"); ?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cabinet</li>
            <li class="breadcrumb-item active" aria-current="page">Orders</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap
            align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Your orders</h1>

        </div>
        <?php if ($buyers) {?>
            <?php   for ($i = 0; $i < count($orders); $i++) {?>
        <h2>Show orders #<?php echo $orders[$i]->getId();?></h2>
        <br>
        <div class="table-responsive">
            <table class="table table-striped table-sm col-md-4">
                <thead>
                <tr>
                    <th colspan="2">Information about orders</th>

                </tr>
                </thead>
                <tbody>

                <tr>
                    <td>Id orders</td>
                    <td><?php echo $orders[$i]->getId();?></td>
                </tr>
                <tr>
                    <td>Total count</td>
                    <td><?php echo $orders[$i]->getTotalCount();?></td>
                </tr>
                <tr>
                    <td>Total price</td>
                    <td><?php echo  $orders[$i]->getTotalPrice();?></td>
                </tr>
                <tr>
                    <td>Orders status</td>
                    <td><?php echo $orders[$i]->getStatus();?></td>
                </tr>
                <tr>
                    <td>Date orders</td>
                    <td><?php echo $buyers[$i]->getCreatedAt();?></td>
                </tr>

                </tbody>
            </table>
        </div>


        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th colspan="4"> Information about products</th>
                </tr>
                <tr>
                    <th>Id products</th>
                    <th>Name products</th>
                    <th>Price</th>
                    <th>Count</th>

                </tr>
                </thead>
                <tbody>
                <?php for ($j=0; $j<count($productOrder); $j++) {?>
                    <tr>
                        <td><?php echo $productOrder[$i][$j]->getIdProduct();?></td>
                        <td><?php echo $productOrder[$i][$j]->getNameProduct();?></td>
                        <td><?php echo $productOrder[$i][$j]->getPrice();?></td>
                        <td><?php echo $productOrder[$i][$j]->getQuantity();?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
            <?php }?>
        <?php  } else {?>
            <p><span>You have not made an order</span></p>
        <?php }?>
        <br><br><br><br>
        <a class="btn  btn-primary" href="/cabinet">Back</a>
</div>

 <hr class="featurette-divider"><br>
<?php include("views/include/footer.php"); ?>