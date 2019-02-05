<?php

   class User{

    private $user;
    private $con;

  public  function __construct($con,$user){
     
        $this->con=$con;
        $this->user=$user;

        $query_all=mysqli_query($con,"SELECT * FROM users WHERE username='$user'");
        $this->user=mysqli_fetch_array($query_all);

        }
         
        function getUesrName(){
          return $this->user['username'];
        }

        public function getNumPosts(){
          $username = $this->user['username'];
          $query=mysqli_query($this->con,"SELECT num_posts FROM users WHERE username='$username'");
          $row=mysqli_fetch_array($query);
          return $row['num_posts'];
        }


    public function jib_liya_firstname_and_latname(){
         $username=$this->user['username'];
         $query=mysqli_query($this->con,"SELECT first_name, last_name FROM users WHERE username='$username'");
         $row=mysqli_fetch_array($query);
         return  $row['first_name'] . " " . $row['last_name']; 
     }


   }










?>