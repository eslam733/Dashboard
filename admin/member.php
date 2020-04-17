<?php
session_start();
if(isset($_SESSION['username']))
{
    $title_page = "members";
    include "init.php";
    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
        if($_GET['do'] == "manger")
        {?>
            <div class="position-fixed my-alert"></div>
                <div class="font-weight-bolder  col-md-10 mx-auto">
                    <h1 class="text-center text-secondary mt-3"> <?php echo lang("MEMBERS") ?> </h1>
                    <div class="text-center table-responsive table-bordered active-table">
                        <table id='active-table' class="table member-table">
                            <tr>
                                <td><?php echo lang("USERID") ?></td>
                                <td><?php echo lang("USERNAME") ?></td>
                                <td><?php echo lang("EMAIL") ?></td>
                                <td><?php echo lang("DATE") ?></td>
                                <td><?php echo lang("CONTROL") ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="text-center table-responsive table-bordered pendding-table">
                        <table id='pendding-table' class="table member-table">
                            <tr>
                                <td><?php echo lang("USERID") ?></td>
                                <td><?php echo lang("USERNAME") ?></td>
                                <td><?php echo lang("EMAIL") ?></td>
                                <td><?php echo lang("DATE") ?></td>
                                <td><?php echo lang("CONTROL") ?></td>
                            </tr>
                        </table>
                    </div>
                    <a href="./member.php?do=add&id=<?php echo $_GET['id'] ?>" type="button" class="mt-4 btn btn-dark"><i class="fas fa-plus"></i> <?php echo lang("NEW_MEMBER") ?></a>
                    <button type="button" class="mt-4 btn btn-dark float-right active-member-B"><i class="fas fa-lock-open"></i> <?php echo lang("ACTIVE_MEMBER") ?></button>
                    <button type="button" class="mt-4 btn btn-warning float-right mr-2 pendding-member-B"><i class="fas fa-lock"></i> <?php echo lang("PENDDING_MEMBER") ?></button>

                </div>
<?php   }
        else if($_GET['do'] == "add")
        {
            ?>
                <div class="position-fixed my-alert"></div>
                <div class="text-center">
                    <h1 class="text-secondary mt-3"> <?php echo lang("ADD_NEW_MEMBER") ?> </h1>
                    <form id="<?php echo $_GET["id"]; ?>">
                        <div class="form-group">
                        <label for="exampleInputEmail1" class="font-weight-bold"><?php echo lang("USERNAME") ?></label>
                        <input type="text" name="username" class="username form-control col-md-3 col-sm-10 mx-auto" id="" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1" class="font-weight-bold"><?php echo lang("PASSWORD") ?></label>
                        <input type="password" name="password" class="password form-control col-md-3 col-sm-10 mx-auto" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1" class="font-weight-bold"><?php echo lang("EMAIL") ?></label>
                        <input type="email" name="email" class="email form-control col-md-3 col-sm-10 mx-auto" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1" class="font-weight-bold"><?php echo lang("FULLNAME") ?></label>
                        <input type="text" name="full" class="full form-control col-md-3 col-sm-10 mx-auto" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="addmember btn btn-dark"><?php echo lang("ADD_NEW_MEMBER") ?></button>
                    </form>
                </div>
            <?php
        }
        else if($_GET['do'] == "edit")
        {
            ?>
                <div class="position-fixed my-alert"></div>
                <div class="text-center">
                    <h1 class="text-secondary mt-3"> <?php echo lang("EDITPROFILE") ?> </h1>
                    <form class="formUpdate" id="<?php echo $_GET["id"]; ?>">
                        <div class="form-group">
                        <label for="exampleInputEmail1" class="font-weight-bold"><?php echo lang("USERNAME") ?></label>
                        <input type="text" name="username" class="username form-control col-md-3 col-sm-10 mx-auto" id="" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1" class="font-weight-bold"><?php echo lang("PASSWORD") ?></label>
                        <input type="password" name="password" class="password form-control col-md-3 col-sm-10 mx-auto" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1" class="font-weight-bold"><?php echo lang("EMAIL") ?></label>
                        <input type="email" name="email" class="email form-control col-md-3 col-sm-10 mx-auto" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1" class="font-weight-bold"><?php echo lang("FULLNAME") ?></label>
                        <input type="text" name="full" class="full form-control col-md-3 col-sm-10 mx-auto" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="updatedata btn btn-dark">Update</button>
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