<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/videos.css">
    <script src="https://kit.fontawesome.com/6a29cc77d5.js" crossorigin="anonymous"></script>
    <title>PK How - Dodaj pliki</title>
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
             <section class="upload-form">
                 <h1>DODAJ PLIKI</h1>
                 <?php if(isset($messages)) {
                     foreach ($messages as $message)
                     {
                         echo $message;
                     }
                 }
                 ?>
                <form action="addfile" method="POST" ENCTYPE="multipart/form-data">
                    <input name="title" type="text" placeholder="title">
                    <textarea name="description" rows="5" placeholder="description"></textarea>
                    <input type="file" name="file">
                    <button type="submit">send</button>
                </form>
             </section>
         </main>
    </div>
</body>