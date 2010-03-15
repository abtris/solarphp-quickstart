<?php
    $title = $this->getTextRaw('TITLE_INDEX');
    $this->head()->setTitle($title);
?>

<h2><?php echo $this->getText('HEADING_INDEX'); ?></h2>

<?php if (! $this->list): ?>

    <p><?php echo $this->getText('ERR_NO_RECORDS'); ?></p>

<?php else: ?>

    <ul>
    
    <?php foreach ($this->list as $item): ?>
        <li><?php
            echo $this->escape($item->title);
            echo "&nbsp;&nbsp;";
            echo $this->action(
                "{$this->controller}/read/{$item->id}",
                'ACTION_READ'
            );
        ?></li>
    
    <?php endforeach; ?>
    
    </ul>
<?php endif; ?>