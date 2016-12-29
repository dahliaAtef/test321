<h3 class="internal-title youtube">Youtube</h3>
<div class="internal-content">
	<ul>
		<div class="row">
	    <li class="col-lg-5 col-md-6"><span class="small-title">Subscribers : </span><?= ($overview['subscribers'] ? $overview['subscribers'] : 0) ?></li>
	    <li class="col-lg-5 col-md-6"><span class="small-title">Views : </span><?= ($overview['views'] ? $overview['views'] : 0) ?></li>
	    <li class="col-lg-5 col-md-6"><span class="small-title">Likes : </span><?= ($overview['likes'] ? $overview['likes'] : 0) ?></li>
	    <li class="col-lg-5 col-md-6"><span class="small-title">Comments : </span><?= ($overview['comments'] ? $overview['comments'] : 0) ?></li>
	    <li class="col-lg-5 col-md-6"><span class="small-title">Shares : </span><?= ($overview['shares'] ? $overview['shares'] : 0) ?></li>
	    <li class="col-lg-5 col-md-6"><span class="small-title">Dislikes : </span><?= ($overview['dislikes'] ? $overview['dislikes'] : 0) ?></li>
	    <li class="col-lg-5 col-md-6"><span class="small-title">Subscribers Gained : </span><?= ($overview['subscribers_gained'] ? $overview['subscribers_gained'] : 0) ?></li>
	    <li class="col-lg-5 col-md-6"><span class="small-title">Subscribers Lost : </span><?= ($overview['subscribers_lost'] ? $overview['subscribers_lost'] : 0) ?></li>
	    </div>
	</ul>
</div>