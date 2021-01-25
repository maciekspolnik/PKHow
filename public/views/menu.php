<!DOCTYPE html>

<nav>
    <img src="public/img/logo.svg">
    <ul>
        <li>
            <a href="<?= "http://$_SERVER[HTTP_HOST]/panel" ?>" class="button">Panel Studenta</a>
        </li>
        <li>
            <a href="<?= "http://$_SERVER[HTTP_HOST]/videos" ?>" class="button">Wideo</a>
        </li>
        <li>
            <a href="<?= "http://$_SERVER[HTTP_HOST]/faq" ?>" class="button">FAQ</a>
        </li>
        <li class = last>
            <a href="<?= "http://$_SERVER[HTTP_HOST]/logout" ?>" class="button">Wyloguj Się</a>
        </li>
    </ul>
</nav>