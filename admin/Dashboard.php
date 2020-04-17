<?php
session_start();

if(isset($_SESSION['username']))
{
    $title_page = "Dashboard";
    include "init.php";
?>
    <div class="position-fixed my-alert"></div>
    <h1 class="text-center mt-3 DS-header">DashBoard</h1>
    <div class="DS-Details">
        <div class="total-member main-details">
            <span>Total Member</span>
            <a href='member.php?do=manger&id=<?php echo $_SESSION['id'] ?>' ><h3 class="totals">232</h3></a>
        </div>

        <div class="total-pendding main-details">
            <span>Total pendding</span>
            <a href='member.php?do=manger&id=<?php echo $_SESSION['id'] ?>' ><h3 class="totals">232</h3></a>
        </div>

        <div class="total-items main-details">
            <span>Total items</span>
            <h3 class="totals">232</h3>
        </div>

        <div class="total-comments main-details">
            <span>Total comments</span>
            <h3 class="totals">232</h3>
        </div>
    </div>

    <div class="DS-Details mt-3">
        <div class="lastest lastest-member">
            <h5><i class="fas fa-stream"></i> Lastest 5 Member</h5>
            <ul class="list-group lastest-member-group">
            </ul>
        </div>
        <div class="lastest lastest-items">
            <h5><i class="fas fa-stream"></i> Lastest 5 Item</h5>
            <ul class="list-group lastest-items-group">
            </ul>
        </div>
    </div>

<?php
    include $tem . "footer.php";
}else
{
    header("Location: index.php" );
}

?>