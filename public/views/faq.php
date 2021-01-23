<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/faq.css">
    <script src="https://kit.fontawesome.com/6a29cc77d5.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/searchfaq.js" defer></script>
    <title>PK How - FAQ</title>
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
                 </div>
             </header>
             <section class="faq">
                 <?php foreach($allFaq as $faq): ?>
                 <div id=project-1>
                     <div class = projects>
                         <div class = question><?=$faq->getQuestion()?></div>
                         <div class = answer><?=$faq->getAnswer()?></div>
                     </div>
                 </div>
                 <?php endforeach; ?>
             </section>
         </main>
    </div>
</body>

<template id="faq-template">
    <div id=project-1>
        <div class = projects>
            <div class = question>question</div>
            <div class = answer>answer</div>
        </div>
    </div>
</template>