<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid ize">
        <a class="navbar-brand " href='?p=home'>Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <?php if(!isset($_SESSION['user']) || $_SESSION['user']['auth'] === 2): ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href='?p=cars'>Eladó autók</a>
                    </li>
                <?php endif; ?>

                <?php if($_SESSION['user']['auth'] === 2):?>
                    <li class="nav-item">
                        <a class="nav-link " href='?p=my-orders'>Rendeléseim</a>
                    </li>
                <?php endif; ?>



                <?php if($_SESSION['user']['auth'] === 1 || $_SESSION['user']['auth'] === 0): ?>
                    <li class="nav-item">
                        <a class="nav-link" href='?p=orders'>Rendelések</a>
                    </li>
                <?php endif; ?>

                <?php if($_SESSION['user']['auth'] === 0): ?>
                    <li class="nav-item">
                        <a class="nav-link" href='?p=cars'>Autók módosítása</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href='?p=staffs'>Személyzet</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href='?p=stat/stat'>Statisztika</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if(!isset($_SESSION['user'])): ?>
                            Bejelentkezés/Regisztráció
                        <?php else: ?>
                            <?= $_SESSION['user']['username']; ?>

                        <?php endif; ?>
                    </a>


                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if(!isset($_SESSION['user'])): ?>
                            <li><a class="dropdown-item" href="?p=auth/login">Bejelentkezés</a></li>
                            <li><a class="dropdown-item" href='?p=auth/registration'>Regisztráció</a></li>
                        <?php elseif($_SESSION['user']['auth'] === 2): ?>
                            <li><a class="dropdown-item" href="?p=login-data">Bejelentkezési adatok</a></li>
                            <li><a class="dropdown-item" href="?p=user-data">Személyes adatok</a></li>
                            <li><a class="dropdown-item" href="?p=auth/logout">Kijelentkezés</a></li>
                            <li><a class="dropdown-item" href='?p=mods/remove-user'>Fiókom törlése</a></li>
                        <?php elseif($_SESSION['user']['auth'] === 1): ?>
                            <li><a class="dropdown-item" href="?p=login-data">Bejelentkezési adatok</a></li>
                            <li><a class="dropdown-item" href="?p=auth/logout">Kijelentkezés</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="?p=auth/logout">Kijelentkezés</a></li>
                        <?php endif; ?>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>