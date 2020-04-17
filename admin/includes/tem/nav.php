<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="./index.php">Dashboard <i class="fas fa-chart-line"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-left" href="./index.php"><?php echo lang("HOME") ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang("LOGS") ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./Catogores.php?do=addCat&id=<?php echo $_SESSION['id']; ?>"><?php echo lang("ITEMS") ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./member.php?do=manger&id=<?php echo $_SESSION['id']; ?>"><?php echo lang("MEMBERS") ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang("STATISTICS") ?></a>
      </li>
      
    </ul>
    <ul class="navbar-nav navbar-nav-user">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="far fa-user"></i> <?php echo $_SESSION['username'] ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="./member.php?do=edit&id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-edit"></i> <?php echo lang("EDIT_PROFILE") ?></a>
            <a class="dropdown-item" href="#"><i class="fas fa-cog"></i> <?php echo lang("SETTING") ?></a>
            <a class="dropdown-item logout" href="?action=logout"><i class="fas fa-sign-out-alt"></i> <?php echo lang("LOGOUT") ?></a>
        </div>
      </li>
    </ul>
  </div>
</nav>