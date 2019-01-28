<?php include("views/include/header.php"); ?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="//">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cabinet</li>
        </ol>
    </nav>
    <hr class="featurette-divider">

    <form class="form-signin">
        <div class="text-center mb-4">

            <br> <h1 class="h1 mb-3 font-weight-normal">Cabinet</h1>

        </div>
        <br> <p class="h4 mb-3 font-weight-normal">Hello, <?php echo $user->getFirstName()?>
            <?php echo $user->getLastName()?>.</p>

        <br>
        <p class="h4  font-weight-normal ">May be you want to
        <a class=" h4  font-weight-normal link-edit" href="/edit">Edit data</a>
        ?</p>

        <br>
        <a class=" h4  font-weight-normal link-edit" href="/cabinet/orders">Your orders</a>
        <br>
        <br>
        <a class=" h4  font-weight-normal link-edit" href="/cabinet/favorites">Favorites product</a>

        <?php if ($role == true) {?>
            <br>
            <br>
            <a class=" h4  font-weight-normal link-edit" href="/admin">Admin panel</a>
        <?php }?>
    </form>

</div>

<br>
<hr class="featurette-divider"><br>
<?php include("views/include/footer.php"); ?>
