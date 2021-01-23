<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/videos.css">
    <script src="https://kit.fontawesome.com/6a29cc77d5.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>

    <title>PK How - Videos</title>
</head>

<body>
    <div class="base-container">
         <?php include('public/views/menu.php') ?>
        <main>
            <header>
                <div class="search-bar">
                    <input placeholder="Wyszukaj">
                </div>
                <div class = profile>
                    Zaloguj się
                    <img src="public\img\not-logged-in.png">
                </div>
            </header>
             <section class="projects">
                 <?php foreach ($videos as $video): ?>
                     <div id=project-1>
                         <div class="photo">
                             <a href=<?=$video->getUrl()?>>
                                 <img border="0" alt="PK" src=public\uploads\<?=$video->getImage()?>></a>
                         </div>
                         <div>
                             <h2><?=$video->getTitle()?></h2>
                             <p><?=$video->getDescription()?></p>
                         </div>
                     </div>
                 <?php endforeach; ?>
     </div>

             </section>
         </main>
    </div>
</body>

<template id="project-template">
    <div id="projects">
        <div class ="photo">
            <a href="">
                <img alt="PK" src=""></a>
        </div>
        <div>
            <h2>title</h2>
            <p>description</p>
        </div>
    </div>
</template>