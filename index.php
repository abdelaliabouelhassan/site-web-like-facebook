<?php 
include('includes/header.php');
include('includes/classes/User.php');
include('includes/classes/post.php');
if(isset($_POST['post'])){
    $post= new post($con,$userLoggedIn);
    $post->submitPost($_POST['post_text'],'none');
}

 ?>
 <div class="user_details column">
 <a href="<?php echo $userLoggedIn;?>"> <img src="<?php echo $user['profile_pic']; ?>"> </a>
 <div class="user_details_left_right">
   <a href="<?php echo $userLoggedIn;?>"><?php echo  $user['first_name']." ". $user['last_name'] ;?></a><br>
   <a href="#"><?php echo "POST : ".$user['num_posts'];?></a><br>
   <a href="#"><?php echo "Likes : ".$user['num_likes'];?></a><br>
   </div>




 </div>

      <!-- post form -->
      <div class="main_column column ">
               <form action="index.php" method="POST" class="post_form">
                   <textarea name="post_text" id="post_text" placeholder="Get something to say"></textarea>
                   <input type="submit" value="Post" name="post" id="post_button">
                   <hr>


               </form>

               <?php 
  $userr = new User($con,$userLoggedIn);
  echo $userr->jib_liya_firstname_and_latname();?> 
        </div>

   </div>
 </body>
 </html>