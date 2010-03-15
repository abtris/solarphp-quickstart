<?php $this->head()->setTitle($this->item->title); ?>

<h2><?php echo $this->escape($this->item->title); ?></h2>

<?php echo $this->nl2p($this->item->body); ?>