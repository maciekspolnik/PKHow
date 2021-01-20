<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/videos.css">
    <script src="https://kit.fontawesome.com/6a29cc77d5.js" crossorigin="anonymous"></script>
    <title>PK How - Videos</title>
</head>

<body>
    <div class="base-container">
         <nav>
            <img src="public/img/logo.svg">
            <ul>
                <li>
                    <a href="#" class="button">Strona Główna</a>
                </li>
                <li>
                    <a href="#" class="button">Aktualności</a>
                </li>
                <li>
                    <a href="#" class="button">Wideo</a>
                </li>
                <li>
                    <a href="#" class="button">FAQ</a>
                </li>
                <li>
                    <a href="#" class="button">Ustawienia</a>
                </li>
            </ul>
         </nav>
         <main>
             <header>
                <div class="search-bar">
                    <form>
                        <input placeholder="Wyszukaj">
                    </form>
                </div>
                <div class="filters">
                Filtr
                </div>
                <div class = profile>
                    Zaloguj się
                    <img src="public\img\not-logged-in.png">
                </div>
             </header>
             <section class="projects">
                 <?php foreach ($videos as $video): ?>
                 <div id=project-1>
                     <p>
                         <a href=<?=$video->getUrl()?>>
                        <img border="0" alt="PK" src=public\uploads\<?=$video->getImage()?>></a>
                     </p>
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