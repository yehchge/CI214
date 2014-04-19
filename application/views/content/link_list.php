<?php foreach($links as $link): ?>
	<p><?=anchor($link['link_url'],$link['link_title']) ?><?=anchor('edit/'.$link['id'],'Eidt') ?></p>
<?php endforeach; ?>