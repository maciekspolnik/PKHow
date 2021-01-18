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

                 <div id=project-1>
                    <img src="public\img\uploads\Office.png">
                    <div>
                        <h2>Eduroam PK</h2>
                        <p>W tym filmie wyjaśniamy proces uzyskiwania certyfikatu i konfiguracji sieci Eduroam</p>
                    </div>
                 </div>
                 
                 <div id=project-2>
                    <img src="public\img\uploads\Office.png">
                    <div>
                        <h2>Platforma ELF</h2>
                        <p>Krótki film wprowadzający do pracy na platformie edukacyjnej ELF</p>
                    </div>
                 </div>
                 
                 <div id=project-3>
                    <img src="public\img\uploads\Office.png">
                    <div>
                        <h2>Office 365</h2>
                        <p>W tym filmie dowiesz się, jak założyć konto Microsoft 365 dla studentów Politechniki Krakowskiej</p>
                    </div>
                 </div>
                 
                 <div id=project-4>
                    <img src="public\img\uploads\Office.png">
                    <div>
                        <h2>Poczta Outlook</h2>
                        <p>Film instruujący jak w łatwy sposób podpiąć swój mail studencki pod prywatną poczte elektroniczną lub odwrotnie</p>
                    </div>
                 </div>
                 
                 <div id=project-5>
                    <img src="public\img\uploads\Office.png">
                    <div>
                        <h2>Microsoft Teams</h2>
                        <p>Krótki przewodnik wideo po obsłudze programu MS Teams</p>
                    </div>
                 </div>

                 <div id=project-6>
                     <img src="public/uploads/<?= $video->getImage()?>">
                     <div>
                         <h2><?= $video->getTitle()?></h2>
                         <p><?= $video->getDescription()?></p>
                     </div>
                 </div>

             </section>
         </main>
    </div>
</body>