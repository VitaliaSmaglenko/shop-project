<?php include("views/include/header_admin.php"); ?>

<div class="container-fluid">
    <div class="row">
        <?php include("views/include/nav_admin.php"); ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap
            flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>

            </div>


            <h2>Category</h2>
            <br>
            <a href="/admin/category/add"> + Add category </a>
            <br> <br>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category name</th>
                        <th>Status</th>

                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i=0; $i<count($categories); $i++) {?>
                        <tr>
                            <td><?php echo $categories[$i]->getId();?></td>
                            <td><?php echo  $categories[$i]->getCategory();?></td>
                            <td><?php echo $categories[$i]->getStatus();?></td>
                            <td><a href="/admin/category/edit/<?php echo $categories[$i]->getId();?>">Edit</a></td>
                            <td><a href="/admin/category/delete/<?php echo $categories[$i]->getId();?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js">' +
        '<\/script>')</script><script src="/docs/4.2/dist/js/bootstrap.bundle.min.js"
       integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous">

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="dashboard.js"></script></body>
