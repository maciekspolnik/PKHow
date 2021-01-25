<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/videos.css">
    <link rel="stylesheet" type="text/css" href="public/css/bar.css">
    <link rel="stylesheet" type="text/css" href="public/css/menu.css">
    <script src="https://kit.fontawesome.com/6a29cc77d5.js" crossorigin="anonymous"></script>
    <title>PK How - Dodaj Film</title>
</head>

<body>
    <div class="base-container">
        <?php include('public/views/menu.php') ?>
         <main>
             <header><?php include('public/views/bar.php') ?></header>

             <section class="upload-form">
                 <h1>DODAJ WIDEO</h1>
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
                    <input name="url" type="text" placeholder="url">
                    <input type="file" name="file">
                    <button type="submit">send</button>
                </form>
             </section>
         </main>
    </div>
</body>