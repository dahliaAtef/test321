<?php

if(count($public_activities['items']) > 0){
    echo '<h3>Recent Activities :</h3>';
    foreach($public_activities['items'] as $activity){
		?>
		<ul>
			<li>Title : <?= $activity['title'] ?></li>
			<li>Published by : <a href="<?= $activity['actor']['url'] ?>" ><?= $activity['actor']['displayName'] ?></a></li>
			<li>Published at <?= date('M d, Y', strtotime($activity['published'])); ?>
			<?php
			if($activity['object']['content']){ ?>
				<li>Content : <?= $activity['object']['content'] ?></li>
			<?php }
			if(count($activity['object']['attachments']) >0){
				foreach($activity['object']['attachments'] as $attachment){ ?>
					<li>Attachment Type : <?= $attachment['objectType'] ?></li>
					<li>Title : <a href="<?= $attachment['url'] ?>"><?= $attachment['displayName'] ?></a></li>
					<li><img src="<?= $attachment['image']['url'] ?>"/>';
				}
			}
			<li>Replies : <?= $activity['object']['replies']['totalItems'] ?></li>
			<li>Plusoners : <?= $activity['object']['plusoners']['totalItems'] ?></li>
			<li>Resharers : <?= $activity['object']['resharers']['totalItems'] ?></li>        
        </ul>
    }
}