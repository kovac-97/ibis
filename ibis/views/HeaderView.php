    <?php
    require_once('../models/Header.php');
    $self = new Header();
    include('../views/LoadingView.php');
    ?>

    <div class='header'>
        <p class='headerTitle'><a href='#'>Alpha</a> by HTML5 UP</a>
        <div class='headerNav'>
            <div class="navContainer">
                <a href='#'>Home</a>
                <a href='#'>Layouts</a>
                <?= $self->button; ?>
            </div>
        </div>
    </div>