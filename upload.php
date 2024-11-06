<?php

require 'init.php';
$tittle = 'upload';
$errors = [];
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    
    $title = addslashes($_POST['title']);
  
    if(empty($title))
    {
      $errors['title'] = "the title is empty";
    }
  	else if(!preg_match("/^[a-zA-Z0-9 ]+$/",trim($title)))
    {
      $errors['title'] = "invalid name";
    }

    $folder = "uploads/";
    if(!file_exists($folder))
    {
    	mkdir($folder,0777,true);
    }
    if(!empty($_FILES['image']['name']))
    {
    	$allowed = ['image/jpg','image/jpeg','image/webp','image/png'];
    	if(in_array($_FILES['image']['type'], $allowed))
    	{
    		$image = $folder . $_FILES['image']['name'];
    	}
    	else
    	{
    		$errors['image'] = "image must be jpg or png ";
    	}
    
    }
    else
    {
    	$errors['image'] = 'image not found';
    }
    //for audio file

    if(!empty($_FILES['file']['name']))
    {
    	$allowed = ['audio/mpeg'];
    	if(in_array($_FILES['file']['type'], $allowed))
    	{
    		$file = $folder . $_FILES['file']['name'];
    	}
    	else
    	{
    		$errors['file'] = "audio file must be mp3 ";
    	}
    
    }
    else
    {
    	$errors['file'] = 'file not found';
    }
  
    if(empty($errors))
    {
        $user_id = user('id');

        if(!empty($image))
        	move_uploaded_file($_FILES['image']['tmp_name'], $image);
        if(!empty($file))
        	move_uploaded_file($_FILES['file']['tmp_name'], $file);
        $date =date("Y-m-d H:i:s");
        $query ="insert into songs(user_id,views,downloads,popularity,file,image,title,date) values('$user_id','$views','$downloads','$popularity','$file','$image','$title','$date')";
        query($query);
        redirect('profile');
        die();
    }
  }

?>
	
	<?php require 'header.php';?>
	
	<div class="class_22" >
		<form method="post" enctype="multipart/form-data" class="class_23" action ="" >
			<h1 class="class_18"  >
				Upload Song
				<br>
			</h1>
			<div class="class_24" >
				<label class="class_25"  >
					Title
				</label>
				<input placeholder="" type="text" name="title" class="class_12" >
			</div>
			<div class="class_26" >
				<img src="assets/images/pexels-photo-3756774.jpeg" class="js-image class_27" >
				<input onchange="display_image(this.files[0])" type="file" name="image"  class="class_28">
			</div>
			<div class="class_26" >
				<div class="class_29" >
					<audio controls="" class="js-file class_30" >
						<source src="" type="audio/mpeg" >
						</audio>
					</div>
					<input onchange="load_file(this.files[0])" type="file" name="file" >
				</div>
				<div class="class_31" >
					<button class="class_32"  >
						Save
					</button>
					<button class="class_33"  >
						Cancel
					</button>
					<div class="class_34" >
					</div>
				</div>
			</form>
		</div>
		
		<?php require 'footer.php';?>

		<script type="text/javascript">
			function display_image(file)
			{
				document.querySelector(".js-image").src = URL.createObjectURL(file);
			}
			function load_file(file)
			{
				document.querySelector(".js-file").src = URL.createObjectURL(file);
			}
		</script>