<?php

require 'init.php';
$tittle = 'profile';
if(!is_logged_in())
{
	redirect('login');
	die();
}
$id = user('id');
$query = "select * from users where id = '$id' limit 1";
$row = query($query);
if(!empty($row))
{
	$row = $row[0];

	//this for songs table
	$user_id = $row['id'];
	$query = "select * from songs where user_id = '$user_id' order by id desc limit 10";
	$songs = query($query);
	//$songs = $songs[0]; 
	//get number of songs 
	$query = "select count(*) as total from songs where user_id = '$user_id' limit 10";
	$totalsongs = query($query);
	$totalsongs = $totalsongs[0]['total'];
}


?>
	<?php require 'header.php';?>
	
	

		<div class="class_35" >
			<h1 class="class_14"  >
				Artist Profile
				<br>
			</h1>
		<?php if(is_logged_in()):?>
			<div class="class_36" >
				<div class="class_37" >
					<img src="<?= get_image($row['image']);?>" class="class_38" >
					<h1 class="class_18" style="margin-bottom: 0px;" >
						<?=$row['first_name']?> <?=$row['last_name']?>
					</h1>
					<div class="class_18" style="margin-bottom: 10px;" >
						<?=$row['username']?>
						<br>
					</div>
					<div class="class_39" >
						<div class="class_40" >
							<i class="bi bi-vinyl-fill class_41">
							</i>
							<h3 class="class_42"  >
								<?= $totalsongs?> Songs
							</h3>
						</div>
						<div class="class_40" >
							<i class="bi bi-bar-chart-line-fill class_41">
							</i>
							<h3 class="class_42"  >
								400 Plays
							</h3>
						</div>
					</div>
					<?php if(user('id') == $row['id']):?>
						<a href="setting.php">
							<button class="class_32"  >
								Edit Profile
							</button>
					 </a>
			<?php endif;?>
				</div>
				<div class="class_43" >
					<?php if(!empty($songs)):?>
						<?php foreach($songs as $song):?>
					<div class="class_44" >
						<div class="class_45" >
							<img src="<?=get_image($song['image']);?>" class="class_46" >
						</div>
						<div class="class_47" >
							<h3 class="class_18"  >
								<?=esc($song['title']);?>
								<br>
							</h3>
							<div class="class_29" >
								<audio controls="" class="class_30" >
									<source src="<?=$song['file'];?>" type="audio/mpeg" >
									</audio>
								</div>
							</div>
							<div class="class_48" >
								<button class="class_49"  >
									Edit
								</button>
								<button class="class_50"  >
									Delete
								</button>
							</div>
						
						</div>
					<?php endforeach;?>

					<?php else:?>
                         <div style="color:black;padding: 10px;text-align: center;">no songs <br><a href="upload.php">please upload some</a>  </div>
					<?php endif;?>	
					</div>

				</div>
			<?php endif;?>
		</div>
	<?php require 'footer.php';?>
						
