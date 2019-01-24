<?php include("views/include/header_admin.php"); ?>

<div class="container-fluid">
    <div class="row">
        <?php include("views/include/nav_admin.php"); ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap
            flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>

            </div>


            <h2>Orders</h2>
            <br>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Buyer name</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Create</th>
                        <th>Show</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i=0; $i<count($buyers); $i++) {  ?>
                        <tr>
                            <td><?php echo $buyers[$i]->getId();?></td>
                            <td><?php echo  $buyers[$i]->getLastName();?></td>
                            <td><?php echo $buyers[$i]->getPhone();?></td>
                            <td><?php echo $buyers[$i]->getStatusOrder();?></td>

                            <td><?php echo $buyers[$i]->getCreatedAt();?></td>
                            <td><a href="/admin/orders/view/<?php echo $buyers[$i]->getId();?>">Show</a></td>
                            <td><a href="/admin/orders/edit/<?php echo $buyers[$i]->getId();?>">Edit</a></td>
                            <td><a href="/admin/orders/delete/<?php echo $buyers[$i]->getId();?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')
</script><script src="/docs/4.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="dashboard.js"></script></body>
</html>