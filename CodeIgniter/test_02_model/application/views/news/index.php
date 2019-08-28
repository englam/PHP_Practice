<h2><?php echo $title ?></h2>

<?php foreach ($news as $news_item): ?>

        <h3><?php echo $news_item['title'] ?></h3>

        <div class="main">
                <?php echo $news_item['text'] ?>
        </div>

        <p><a href="view/<?php echo $news_item['slug'] ?>">View article (Normal)</a></p>
        <p><a href="news/<?php echo $news_item['slug'] ?>">View article (Change URI) </a></p>

<?php endforeach ?>