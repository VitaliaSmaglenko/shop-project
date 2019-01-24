<?php include("views/include/header_admin.php"); ?>

<div class="container-fluid">
    <div class="row">
        <?php include("views/include/nav_admin.php"); ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap
            align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>

            </div>


            <h2>Show orders #</h2>
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
                            <td>Id buyers</td>
                            <td><?php echo $buyers->getId();?></td>
                        </tr>
                        <tr>
                            <td>Id orders</td>
                            <td><?php echo $orders->getId();?></td>
                        </tr>
                        <tr>
                            <td>First name buyers</td>
                            <td><?php echo $buyers->getFirstName();?></td>
                        </tr>

                        <tr>
                            <td>Last name buyers</td>
                            <td><?php echo $buyers->getLastName();?></td>
                        </tr>

                        <tr>
                            <td>Phone buyers</td>
                            <td><?php echo $buyers->getPhone();?></td>
                        </tr>
                        <tr>
                            <td>Comment buyers</td>
                            <td><?php echo $buyers->getComment();?></td>
                        </tr>
                        <tr>
                            <td>User id</td>
                            <td><?php echo $buyers->getUserId();?></td>
                        </tr>
                        <tr>
                            <td>Total count</td>
                            <td><?php echo $orders->getTotalCount();?></td>
                        </tr>
                        <tr>
                            <td>Total price</td>
                            <td><?php echo  $orders->getTotalPrice();?></td>
                        </tr>
                        <tr>
                            <td>Orders status</td>
                            <td><?php echo $status;?></td>
                        </tr>
                        <tr>
                            <td>Date orders</td>
                            <td><?php echo $buyers->getCreatedAt();?></td>
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
                    <?php for ($i=0; $i<count($productOrder); $i++) {?>
                    <tr>
                        <td><?php echo $productOrder[$i]->getIdProduct();?></td>
                        <td><?php echo $productOrder[$i]->getNameProduct();?></td>
                        <td><?php echo $productOrder[$i]->getPrice();?></td>
                        <td><?php echo $productOrder[$i]->getQuantity();?></td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
            <br><br><br><br>
            <a class="btn  btn-primary" href="/admin/orders">Back</a>
        </main>
    </div>
</div>
<br><br>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">

</script>
<script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js">' +
        '<\/script>')</script><script src="/docs/4.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="dashboard.js"></script></body>
</html>