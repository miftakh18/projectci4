<?php foreach ($this->Header() as $key => $header) : ?>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Heading -->
    <div class="sidebar-heading">
        <?= $header['nama_head']; ?>
    </div>

    <?php foreach ($this->Menu($header['hid']) as $key2 => $menu) : ?>
        <!-- Nav Item - Dashboard -->

        <?php if ($menu['href'] == '#') : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= $menu['href']; ?>" data-toggle="collapse" data-target="#collapse<?= $key2 . $key; ?>" aria-expanded="true" aria-controls="collapse<?= $key2 . $key; ?>">
                    <i class="<?= $menu['icon']; ?>"></i>
                    <span><?= $menu['nama_menu']; ?></span>
                </a>
                <div id="collapse<?= $key2 . $key; ?>" class="collapse" aria-labelledby="heading<?= $key2; ?>" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <?php foreach ($this->SubM($header['hid'], $menu['mid']) as $key3 => $submenu) :    ?>
                            <a class="collapse-item" href="<?php echo $submenu['href']; ?>"><?php echo $submenu['nama_submenu'];    ?></a>
                        <?php endforeach ?>
                    </div>
                </div>
            </li>
        <?php else : ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?= $menu['href']; ?>">
                    <i class="<?= $menu['icon']; ?>"></i>
                    <span><?= $menu['nama_menu']; ?></span>
                </a>
            </li>
        <?php endif ?>

    <?php endforeach ?>
<?php endforeach ?>