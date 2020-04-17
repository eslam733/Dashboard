<?php
session_start();
if(isset($_SESSION['username']))
{
    $title_page = "members";
    include "init.php";
    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
        if($_GET['do'] == "addCat")
        {
            ?>
                <div class="position-fixed my-alert"></div>
                <div class="text-center">
                    <h1 class="text-secondary mt-3"> <?php echo lang("ADD_NEW_ITEM") ?> </h1>
                    <form id="<?php echo $_GET["id"]; ?>">
                        <div class="form-group">
                        <label for="exampleInputEmail1" class="font-weight-bold"><?php echo lang("NAME") ?></label>
                        <input type="text" name="name" class="username form-control col-md-3 col-sm-10 mx-auto" id="" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1" class="font-weight-bold"><?php echo lang("DES") ?></label>
                        <textarea  type="text" name="des" class="password form-control col-md-3 col-sm-10 mx-auto" id="exampleInputPassword1" maxlength="200"></textarea>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1" class="font-weight-bold"><?php echo lang("ORDERING") ?></label>
                        <input type="email" name="email" class="email form-control col-md-3 col-sm-10 mx-auto" id="exampleInputPassword1">
                        <div class="mt-3 d-flex justify-content-center">
                            <div class="mr-3">
                                <label for="exampleInputPassword1" class="font-weight-bold"><?php echo lang("VISIBILTY") ?></label> <br>
                                <input id="vis-yes" type="radio" name="visibilty" value="1" checked />
                                <label for="vis-yes">Yes</label>
                                <input id="vis-no" type="radio" name="visibilty" value="0" />
                                <label for="vis-no">No</label>
                            </div>
                            
                            <div class="mr-3">
                                <label for="exampleInputPassword1" class="font-weight-bold"><?php echo lang("A_COMMENT") ?></label> <br>
                                <input id="com-yes" type="radio" name="comment" value="1" checked />
                                <label for="com-yes">Yes</label>
                                <input id="com-no" type="radio" name="comment" value="0" />
                                <label for="com-no">No</label>
                            </div>

                            <div>
                                <label for="exampleInputPassword1" class="font-weight-bold"><?php echo lang("A_ADS") ?></label> <br>
                                <input id="ads-yes" type="radio" name="ads" value="1" checked />
                                <label for="ads-yes">Yes</label>
                                <input id="ads-no" type="radio" name="ads" value="0" />
                                <label for="ads-no">No</label>
                            </div>
                        </div>

                        <button type="submit" class="addmember btn btn-dark mt-3"><?php echo lang("ADD_NEW_ITEM") ?></button>
                    </form>
                </div>
            <?php
        }
    }else{
        header("Location: index.php" );
    }
    include $tem . "footer.php";
}else
{
    header("Location: index.php" );
}
?>