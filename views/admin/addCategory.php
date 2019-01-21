<?php include("views/include/header_admin.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <?php include("views/include/nav_admin.php"); ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
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

                <h2>Add category</h2>
                <br>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="name">Category name </label>
                            <br>
                            <input type="text" id="name" name="category">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="status">Status</label>
                            <br>
                            <select name="status">
                                <option value="1">Displayed</option>
                                <option value="0">Not displayed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <br>
                            <button class="btn btn-primary" name="submitSave" type="submit">Save</button>
                            <a class="btn  btn-primary" href="/admin/category">Back</a>
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
/**
 * Created by PhpStorm.
 * User: Виталия
 * Date: 19.01.2019
 * Time: 16:35
 */