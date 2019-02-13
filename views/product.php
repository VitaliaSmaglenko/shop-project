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

                        <img class="featurette-image img-fluid mx-auto"
                             src="../components/<?php echo $product->getImage();?>" alt="Generic placeholder image">
                    </div> </td> <td width="50%">

                    <div class="row featurette">
                        <div class="col-md-7 order-md-2">
                            <h3 class="featurette-heading"> <?php echo  $product->getName();?></h3>
                            <h4><span class="text-muted "><?php echo $product->getPrice();?></span></h4>
                            <?php if ($userId != false) {
                                if ($favorites == 0) { ?>
                                    <a class="font-weight-normal link-edit" href="/favorites/<?php echo $product->getId();?>">
                                        <span class="">Add to favorites</span></a>
                                <?php } else {?>
                                    <span class="">Product in favorites</span></a>
                                <?php }
                            }?>
                            <h4><span class="text-muted">In stock: <?php echo $product->getAvailability();?></span></h4>
                            <p class="lead">Product character:</p>
                            <ul class="list-group list-group-flush">
                                <?php for ($i=0; $i < count(explode(';', $product->getSpecifications())); $i++) {?>
                                    <li class="list-group-item">
                                        <?php echo explode(';', $product ->getSpecifications())[$i];?></li>
                                <?php } ?>
                            </ul>
                        </div>
                </td>
            </tr>

            <tr>
                <td colspan="2"> <p class="lead"><?php echo $product->getDescription();?></p></td>
            </tr>
            <?php if (!$cart && $product->getAvailability() != 0) {?>
                <tr>
                    <td colspan="2" class="td-sub">
                        <a href="../add/<?php echo $product->getId();?>"
                           class="btn btn-info my-2 my-sm-0" name="view-btn">Add to cart</a>
                    </td>
                </tr>

            <?php } else {?>
                <tr>
                    <td colspan="2" class="td-sub"><p class="lead font-weight-bold">Item in cart</p> </td>
                </tr>
                <tr>
                <?php  if ($product->getAvailability() != 0) {?>
                    <td colspan="2" class="td-sub">
                        <a href="../add/<?php echo $product->getId();?>"
                           class="btn btn-info my-2 my-sm-0" name="view-btn">Add one more</a>
                    </td>
                <?php } else {    ?>
                    <td colspan="2" class="td-sub">
                        <p class="lead font-weight-bold">Product ended</p>
                    </td>
                    </tr>
                <?php }
            }?>
        </table>
        <div class="comments">

            <h3 class="title-comments">Комментарии (<?php echo $countComment?>)</h3>

            <br>
            <?php if ($userId != false) { ?>
                <form method="post">
                    <textarea rows="4" cols="100" name="text"></textarea>
                    <br>  <br>
                    <button class="btn btn-primary" name="submitAdd" type="submit">Add comment</button>
                    <br>
                </form>
                <br>
            <?php } else {?>
                <p class="lead">Log in to leave a comment.</p>
            <?php } ?>
            <?php if ($comment) {?>
                <?php for ($i = 0; $i < count($comment); $i++) {?>
                    <ul class="media-list">
                        <!-- Комментарий (уровень 1) -->
                        <li class="media">

                            <div class="media-body">
                                <div class="media-heading">
                                    <div class="author"><?php echo $comment[$i]->getUsername();?></div>
                                    <div class="metadata">
                                        <span class="date"><?php echo $comment[$i]->getCreatedAt();?></span>
                                    </div>
                                </div> <br>
                                <div class="media-text text-justify"><?php echo $comment[$i]->getText();?></div>
                                <?php if ($userId != false) { ?>
                                    <?php  if (isset($show[$comment[$i]->getId()]) && $show[$comment[$i]->getId()] == true) {?>
                                        <br>
                                        <form method="post">
                                            <textarea rows="2" cols="90" name="textReplay"></textarea>
                                            <br>  <br>
                                            <input type="text" value="<?php echo $comment[$i]->getId()?>" name="id" hidden>
                                            <button class=" btn-dark " name="submitAddReplay.<?php echo $comment[$i]->getId()?>"
                                                    type="submit">Add replay</button>
                                            <br>
                                        </form>
                                        <br>
                                    <?php } else {?>
                                        <form method="post">
                                            <div class="footer-comment">
                                                <input type="text" value="<?php echo $comment[$i]->getId()?>" name="id" hidden>
                                                <span class="comment-reply">
                                    <button name="subReplay.<?php echo $comment[$i]->getId()?>"
                                            class="btn-link border-0"> ответить

                                    </button>  </span>
                                                <?php if ($userId == $comment[$i]->getUserId()) {?>
                                                    <span class="comment-reply">
                      <a href="/comment/delete/<?php echo $comment[$i]->getId()?>/<?php echo $product->getId();?>"
                         class="btn-link border-0"> Удалить </a>  </span>
                                                <?php } ?>
                                            </div>

                                        </form>
                                    <?php } ?>
                                <?php }?>
                                <br>
                                <?php  for ($j = 0; $j < count($nesComment[$i]); $j++) {?>
                                    <div class="media two-level" >
                                        <div class="media-body">
                                            <div class="media-heading">
                                                <div class="author"> <?php echo $nesComment[$i][$j]->getUserName();?> </div>
                                                <div class="metadata">
                                                    <span class="date"><?php echo $nesComment[$i][$j]->getCreatedAt();?></span>
                                                </div>
                                            </div>
                                            <div class="media-text text-justify">
                                                <?php echo $nesComment[$i][$j]->getText();?>
                                            </div>
                                            <?php if ($userId == $nesComment[$i][$j]->getUserId()) {?>
                                                <span class="comment-reply">
                    <a href="/replay/delete/<?php echo $nesComment[$i][$j]->getId()?>/<?php echo $product->getId();?>"
                       class="btn-link border-0"> Удалить </a>  </span>
                                            <?php } ?>
                                        </div></div>
                                    <br>
                                <?php }?>

                        </li>
                    </ul>
                <?php }?>
            <?php }?>

        </div>
    </div>

    </div>




    <hr class="featurette-divider"><br>
<?php include("views/include/footer.php"); ?>