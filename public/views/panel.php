<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/panel.css">
    <link rel="stylesheet" type="text/css" href="public/css/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/bar.css">

    <script src="https://kit.fontawesome.com/6a29cc77d5.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/searchpanel.js" defer></script>
    <title>PK How - FAQ</title>
</head>

<body>
    <div class="base-container">
        <?php include('public/views/menu.php') ?>
         <main>
             <header><?php include('public/views/bar.php') ?></header>
             <h2 class="question">Wszystkie potrzebne linki w jednym miejscu</h2>
             <section class="panel">

                 <?php foreach($panels as $panel): ?>
                 <a class = block href =<?=$panel->getUrl()?>>
                     <div class = question><?=$panel->getTitle()?></div>
                 </a>
                 <?php endforeach; ?>
             </section>
         </main>
    </div>
</body>

<template id="panels-template">
    <a class = block href ="">
        <div class = question>title</div>
    </a>
</template>