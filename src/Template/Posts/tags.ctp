<h4>
    <?php
    // echo  __('Posts tagged with');
       echo 'Posts encontrados com a tag:';
    ?>
    <?= $this->Text->toList($tags) ?>
</h4>

<section>
<?php foreach ($posts as $post): ?>
    <article>
        <h4><?= $this->Html->link($post->title, $post->slug) ?></h4>
        <small><?= h($post->slug) ?></small>
        <?= $this->Text->autoParagraph($post->content) ?>
    </article>
<?php endforeach; ?>
</section>