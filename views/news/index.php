<?php ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="../template/img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="../template/css/mdb.min.css" type="text/css"/>
  </head>
  <body>
    <!-- Start your project here-->
    <div class="container">
      <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="text-center">
          <img
            class="mb-4"
            src="https://mdbootstrap.com/img/logo/mdb-transparent-250px.png"
            style="width: 250px; height: 90px;"
          />
          <h5 class="mb-3">Thank you for using our product. We're glad you're with us.</h5>
          <p class="mb-3">MDB Team</p>
          <a
            class="btn btn-primary btn-lg"
            href="#"
            target="_blank"
            role="button"
            >Start MDB tutorial</a
          
        </div>
      </div>
    </div>
    <!-- End your project here-->
    <section>
      <div class="row">
        <h2>Новости</h2>
        <?php foreach ($newsList as $newsItem) {
          $id = $newsItem['id'];
          $title = $newsItem['title'];
          $date = $newsItem['date'];
          $short_content = $newsItem['short_content'];
          //$content = $newsItem['content'];
          //$author_name = $newsItem['author_name'];
          //$preview = $newsItem['preview'];


        ?>
        
        <div class="col-lg-6 col-md-12 mb-4">
          <h3><?=$title?></h3>
          <p><?=$short_content?>
          </p>
          <p><?=$date?></p>
          <a href="/news/<?=$id?>">Читать далее</a>
        </div>

        <?php } ?>
      </div>
    </section>

    <!-- MDB -->
    <script type="text/javascript" src="../template/js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
