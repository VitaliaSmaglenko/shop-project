<?php include("views/include/header_admin.php"); ?>

    <div class="container-fluid " >
        <div class="row ">
            <?php include("views/include/nav_admin.php"); ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 ">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>

                </div>

                <?php  if(isset($errors) && !empty($errors)) {
                    echo '<ul>';
                    for($i=0; $i<count($errors); $i++) {
                        echo '<li>';
                        echo $errors[$i];
                        echo '</li>';
                    }
                    echo '</ul>';
                }
                ?>

                <h2>Edit orders</h2>
                <br>
                <form method="post" enctype="multipart/form-data" >
                    <div class="form-row ">
                        <div class="col-md-4 mb-1">
                            <label >Buyers Last Name: </label>
                            <br>
                            <input type="text" name="last_name"
                                       value=" <?php echo $buyers->getLastName();?>">

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label >Buyers First Name </label>
                            <br>
                            <input type="text"  value= "<?php echo $buyers->getFirstName();?>" name="first_name">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label > Phone </label>
                            <br>
                            <input type="text"  name="phone" value= "<?php echo $buyers->getPhone()?>" >
                        </div>
                    </div>





                    <div class="form-row">
                        <div class="col-md-4 mb-1">
                            <label for="status">Status</label>
                            <br>
                            <select name="status">
                                <option value="1" <?php if($buyers->getStatusOrder() == 1){ echo 'selected="selected"';};?>>New order</option>
                                <option value="2" <?php if($buyers->getStatusOrder() == 2){ echo 'selected="selected"';};?>>In processing</option>
                                <option value="3" <?php if($buyers->getStatusOrder() == 3){ echo 'selected="selected"';};?>>Is delivered</option>
                                <option value="4" <?php if($buyers->getStatusOrder() == 4){ echo 'selected="selected"';};?>>Is closed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <br>
                            <button class="btn btn-primary" name="submitEdit" type="submit">Edit</button>
                            <a class="btn  btn-primary" href="/admin/orders">Back</a>
                        </div>
                    </div>


                </form>
            </main>
        </div>
    </div>
    <br>
    <br>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="dashboard.js"></script></body>
    </html><?php
