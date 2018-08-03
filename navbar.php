<?php
include_once "includes.php";
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBar" aria-controls="navBar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#"><?= TITLE ?></a>

  <div class="collapse navbar-collapse" id="navBar">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="/">Startseite</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/upload">Hochladen</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/user.php">Benutzerinfos</a>
      </li>
    </ul>
  </div>
</nav>