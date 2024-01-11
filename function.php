<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php

    session_start();

    function Connection(){
        $connection = new mysqli('127.0.0.1','root','','db_final_project_2_5');

        return $connection;
    }
    function Register(){
        if(isset($_POST['btn_register'])){
            // echo 123;
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $profile = $_FILES['profile']['name'];

            // echo $username.$email.$password.$profile;
            if(!empty($username) && !empty($email) &&!empty($password) &&!empty($profile)){
                $profile = rand(1,9999).'-'.$profile;
                $path = './assets/Profile/'.$profile;
                move_uploaded_file($_FILES['profile']['tmp_name'],$path);

                $password = md5($password);

                $sql = "INSERT INTO `tbl_user`(`username`,`email`,`password`,`profile`)
                VALUE('$username','$email','$password','$profile')";

                $rs = Connection()->query($sql);
                if($rs){
                    header('location:login.php');
                }
            }
            else{
                echo '
                
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Good job!",
                                text: "You clicked the button!",
                                icon: "success",
                                button: "Aww yiss!",
                              });
                        });
                    </script>
                ';
            }
        }
        
    }
    Register();
    function Login(){
        if(isset($_POST['btn_login'])){
            $nameEmail = $_POST['name_email'];
            $password = $_POST['password'];

            // echo $nameEmail.$password;

            if(!empty($nameEmail) && !empty($password)){

                $password = md5($password);

                $sql = "SELECT * FROM `tbl_user` WHERE (`username` = '$nameEmail' OR `email` = '$nameEmail') AND `password` = '$password'";

                $rs = Connection()->query($sql);
                $row = mysqli_fetch_assoc($rs);
                if(!empty($row)){
                    $_SESSION['user'] = $row['id'];
                    header('location:index.php');
                }else{
                    echo '
                
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error!",
                                text: "Wrong Username or Email or Password!",
                                icon: "error",
                                button: "Done",
                              });
                        });
                    </script>
                ';
                }
            }else{
                echo '
                
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Error!",
                            text: "You missed some field!",
                            icon: "error",
                            button: "Done!",
                          });
                    });
                </script>
            ';
            }
        }
    }
    Login();
    function Logout(){
        if(isset($_POST['btn-logout'])){
            // echo 123;
            unset($_SESSION['user']);
        }
    }
    Logout();
    function AddLogo(){
        if(isset($_POST['btn-add-logo'])){
            // echo 123;
            $status = $_POST['status'];
            $thumbnail = $_FILES['thumbnail']['name'];
            // echo $status.$thumbnail;
            if(!empty($status) && !empty($thumbnail)){

                $thumbnail = date('dmyhis').'-'.$thumbnail;
                $path = './assets/Profile/'.$thumbnail;
                move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);

                $sql = "INSERT INTO `tbl_logo`(`status`,`thumbnail`) VALUES('$status','$thumbnail')";
                $rs = Connection()->query($sql);
                if($rs){
                    echo '
                       
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success!",
                                    text: "Logo Insert Success",
                                    icon: "success",
                                    button: "Done!",
                                });
                            });
                        </script>
                    ';
                }
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error!",
                                text: "You missed some field!",
                                icon: "error",
                                button: "Done!",
                            });
                        });
                    </script>
                ';
            }
        }
    }
    AddLogo();
    function ViewLogo(){
        $sql = "SELECT * FROM `tbl_logo`";
        $rs = Connection()->query($sql);
        while($row = mysqli_fetch_assoc($rs)){
            echo '
                <tr>
                    <td><img src="./assets/Profile/'.$row['thumbnail'].'" width="100px"/></td>
                    <td>'.$row['status'].'</td>
                    <td>'.$row['post_date'].'</td>
                    <td width="150px">
                        <a href="update-logo.php?id='.$row['id'].'" name="btn-update-logo" class="btn btn-primary">Update</a>
                        <button type="button" remove-id="'.$row['id'].'" name="btn-delete-logo" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Remove
                        </button>
                    </td>
                </tr>
            ';
        }
    }
    function UpdateLogo(){
        if(isset($_POST['btn-update-logo'])){
            // echo 'success';
            $id = $_GET['id'];
            $status = $_POST['status'];
            $thumbnail = $_FILES['thumbnail']['name'];

            if(empty($thumbnail)){
                $thumbnail = $_POST['old_thumbnail'];
            }else{
                $thumbnail = date('dmyhis').'-'.$thumbnail;
                $path = './assets/Profile/'.$thumbnail;
                move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);
            }
            if(!empty($status)){
                $sql = "UPDATE `tbl_logo` SET `status` = '$status', `thumbnail`='$thumbnail' WHERE `id` = '$id'";
                $rs = Connection()->query($sql);
                if($rs){
                    echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success!",
                                    text: "Logo Update Success",
                                    icon: "success",
                                    button: "Done!",
                                });
                            });
                        </script>
                    ';
                }
            }
        }
    }
    UpdateLogo();
    function DeleteLogo(){
        if(isset($_POST['btn-delete-logo'])){
            // echo 123;
            $id = $_POST['remove_id'];

            $sql = "DELETE FROM `tbl_logo` WHERE `id` = '$id'";
            $rs  = Connection()->query($sql);
            if($rs){
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Success",
                            text: "Logo Delete Success",
                            icon: "success",
                            button: "Done",
                          });
                    });
                </script>
            '; 
            }
        }
    }
    DeleteLogo();
    function AddNews(){
        if(isset($_POST['btn-add-news'])){
            // echo 123;
            // echo $_SESSION['user'];

            $title          = $_POST['title'];
            $newType        = $_POST['newType'];
            $category       = $_POST['category'];
            $thumbnail      = $_FILES['thumbnail']['name'];
            $banner         = $_FILES['banner']['name'];
            $description    = $_POST['description'];
            $author         = $_SESSION['user'];

            // echo $title.$description.$newType.$category.$thumbnail.$banner.$author;

            if(!empty($title) && !empty($description) && !empty($newType) && !empty($category) && !empty($thumbnail) && !empty($banner) && !empty($author)){
                $thumbnail = date('dmyhis').'-'.$thumbnail;
                $path = './assets/image/'.$thumbnail;
                move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);

                $banner = date('dmyhis').'-'.$banner;
                $pathbanner = './assets/image/'.$banner;
                move_uploaded_file($_FILES['banner']['tmp_name'],$pathbanner);

                $sql = "INSERT INTO `tbl_news`(`title`, `description`, `newType`, `category`, `thumbnail`, `banner`, `author`) 
                VALUES ('$title','$description','$newType','$category','$thumbnail','$banner','$author')";

                $rs = Connection()->query($sql);
                if($rs){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Insert News Success",
                                icon: "success",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
                }
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "You missed some field",
                                icon: "error",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
            }

        }
    }
    AddNews();
    function ViewNews(){
        // $sql = "SELECT * FROM `tbl_news` ORDER BY `id` DESC";
        $sql = "SELECT tbl_news.*,tbl_user.username FROM tbl_news INNER JOIN tbl_user on tbl_news.author = tbl_user.id ORDER BY id DESC";
        $rs = Connection()->query($sql);
        while($row=mysqli_fetch_assoc($rs)){
            echo '
            <tr>
                <td 
                    style="
                        overflow: hidden;
                        display: -webkit-box;
                        -webkit-line-clamp: 2; /* number of lines to show */
                                line-clamp: 2; 
                        -webkit-box-orient: vertical;
                    "
                >'.$row['title'].'</td>
               
                <td>'.$row['newType'].'</td>
                <td>'.$row['category'].'</td>
                <td><img src="./assets/image/'.$row['thumbnail'].'" alt="" width="130px"></td>
                <td><img src="./assets/image/'.$row['banner'].'" alt="" width="130px"></td>
                <td>'.$row['username'].'</td>
                <td>'.$row['viewer'].'</td>
                
                <td
                style="
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 200px;
                "
                >'.$row['description'].'</td>
               
                <td>'.$row['post_date'].'</td>
                <td width="150px">
                    
                    <a href="update-news.php?id='.$row['id'].'"  class="btn btn-primary">Update</a>
                    <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Remove
                    </button>
              
                </td>
            </tr>
            ';
        }
    }
    function DeleteNews(){
        if(isset($_POST['btn-delete-news'])){
            // echo 123;
            $remove_id = $_POST['remove_id'];

            $sql = "DELETE FROM `tbl_news` WHERE `id` =$remove_id";
            $rs = Connection()->query($sql);
            if($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "News Delete Success",
                                icon: "success",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
                        
            }
        }
    }
    DeleteNews();
    function UpdateNews(){
        if(isset($_POST['btn-update-news'])){

            $id             = $_GET['id'];
            $title          = $_POST['title'];
            $newType        = $_POST['newType'];
            $category       = $_POST['category'];
            $thumbnail      = $_FILES['thumbnail']['name'];
            $banner         = $_FILES['banner']['name'];
            $description    = $_POST['description'];
            $author         = $_SESSION['user'];

            if(empty($thumbnail)){
                $thumbnail = $_POST['old_thumbnail'];
            }else{
                $thumbnail = date('dmyhis').'-'.$thumbnail;
                $path = './assets/image/'.$thumbnail;
                move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);
            }
            if(empty($banner)){
                $banner = $_POST['old_banner'];
            }else{
                $banner = date('dmyhis').'-'.$banner;
                $path = './assets/image/'.$$banner;
                move_uploaded_file($_FILES['banner']['tmp_name'],$path);
            }
            if(!empty($title) && !empty($description) && !empty($newType) && !empty($category) && !empty($thumbnail) && !empty($banner) && !empty($author)){
                $sql = "UPDATE `tbl_news` SET`title`='$title',`description`='$description',`newType`='$newType',`category`='$category',`thumbnail`='$thumbnail',`banner`='$banner'WHERE `id`='$id'";
                $rs  = Connection()->query($sql);
                
                if($rs){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "News Update Success",
                                icon: "success",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
                }
            }else{
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Error",
                            text: "You missed some field",
                            icon: "error",
                            button: "Done",
                        });
                    });
                </script>
            '; 
            }
        }

    }
    UpdateNews();
    function View_FeedbackNews(){
      $sql = "SELECT * FROM `tbl_feedback`";
      $rs = Connection()->query($sql);
      while($row = mysqli_fetch_assoc($rs)){
        echo '
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['username'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['telephone'].'</td>
                <td>'.$row['address'].'</td>
                <td style="width:200px">'.$row['message'].'</td>
                <td>'.$row['feedback_date'].'</td>
               
            </tr>
        ';
      }
    }
    function AddFollow(){
        if(isset($_POST['btn-follow'])){
            // echo 123;

            $label     = $_POST['label'];
            $url       = $_POST['url'];
            $thumbnail = $_FILES['thumbnail']['name'];
            $status    = $_POST['status'];
            
            // echo $label.$url.$thumbnail.$status;

            if(!empty($label) && !empty($url) && !empty($thumbnail) && !empty($status)){
                $thumbnail = date('dmyhis').'-'.$thumbnail;
                $path = './assets/image/'.$thumbnail;
                move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);
                
                $sql = "INSERT INTO `tbl_follow_us`(`label`, `url`, `thumbnail`, `status`)
                VALUES ('$label','$url','$thumbnail','$status')";

                $rs = Connection()->query($sql);
                if($rs){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Insert Follow Success",
                                icon: "success",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
                }
            } else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "You missed some field",
                                icon: "error",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
            }
        }
    }
    AddFollow();
    function View_Follow(){
        $sql = "SELECT * FROM `tbl_follow_us`";
        $rs = Connection()->query($sql);
        while($row = mysqli_fetch_assoc($rs)){
          echo '
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['label'].'</td>
                <td width="400px">'.$row['url'].'</td>
                <td><img src="./assets/image/'.$row['thumbnail'].'" alt="" width="40px"></td>
                <td>'.$row['status'].'</td>
                <td>'.$row['post_date'].'</td>
                <th>
                    <a href="update-follow-us.php?id='.$row['id'].'" class="btn btn-primary">Update</a>
                    <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Remove
                    </button>
                </th>
            </tr>
          ';
        }
    }
  
    function UpdateFollow(){
        if(isset($_POST['btn-follow'])){
            // echo 123;
            $id        = $_GET['id'];
            $label     = $_POST['label'];
            $url       = $_POST['url'];
            $thumbnail = $_FILES['thumbnail']['name'];
            $status    = $_POST['status'];
            
            // echo $label.$url.$thumbnail.$status;

            if(empty($thumbnail)){
                $thumbnail = $_POST['old_thumbnail'];
            }else{
                $thumbnail = date('dmyhis').'-'.$thumbnail;
                $path = './assets/image/'.$thumbnail;
                move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);
            }

            if(!empty($label) && !empty($url) && !empty($thumbnail) && !empty($status)){
                $thumbnail = date('dmyhis').'-'.$thumbnail;
                $path = './assets/image/'.$thumbnail;
                move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);
                
                $sql = "UPDATE `tbl_follow_us` SET `label`='$label',`url`='$url',`thumbnail`='$thumbnail',`status`='$status' WHERE `id`='$id'";
               
                $rs = Connection()->query($sql);
                if($rs){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Update Follow Success",
                                icon: "success",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
                }
            } else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "You missed some field",
                                icon: "error",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
            }
        }
        
    }
    UpdateFollow();

    function DeleteFollow(){
        if(isset($_POST['btn-delete-follow'])){
            // echo 123;
            $remove_id = $_POST['remove_id'];

            $sql = "DELETE FROM `tbl_follow_us` WHERE `id` =$remove_id";
            $rs = Connection()->query($sql);
            if($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Follow Delete Success",
                                icon: "success",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
                        
            }
        }
    }
    DeleteFollow();


    function AddAbout_us(){
        if(isset($_POST['btn-about-us'])){
            $description     = $_POST['description'];
            
            // echo $label.$url.$thumbnail.$status;

            if(!empty($description)){
               
                $sql = "INSERT INTO `tbl_about_us`(`description`) VALUES ('$description')";

                $rs = Connection()->query($sql);
                if($rs){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Insert About Us Success",
                                icon: "success",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
                }
            } else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "You missed some field",
                                icon: "error",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
            }
        }
    }
    AddAbout_us();
    function ViewAbout_us(){
        $sql = "SELECT * FROM `tbl_about_us` ORDER BY id DESC";
        $rs = Connection()->query($sql);
        while($row = mysqli_fetch_assoc($rs)){
          echo '
            <tr>
                <td>'.$row['id'].'</td>
                <td width="700px">'.$row['description'].'</td>
                <td>'.$row['post_date'].'</td>
                <th>
                    <a href="update-about-us.php?id='.$row['id'].'" class="btn btn-primary">Update</a>
                    <button type="button" remove-id="'.$row['id'].'"class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Remove
                    </button>
                </th>
            </tr>
          ';
        }
    }
    function UpdateAboutUs(){
        if(isset($_POST['btn-update-about-us'])){
            // echo 123;
            $id        = $_GET['id'];
            $description     = $_POST['description'];
            
            // echo $label.$url.$thumbnail.$status;

            if(!empty($description)){
                $sql = "UPDATE `tbl_about_us` SET`description`='$description' WHERE `id`='$id'";
                $rs = Connection()->query($sql);
                if($rs){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Update About Us Success",
                                icon: "success",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
                }
            } else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "You missed some field",
                                icon: "error",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
            }
        }
    }
    UpdateAboutUs();

    function DeleteAboutUS(){
        if(isset($_POST['btn-delete-about-us'])){
            // echo 123;
            $remove_id = $_POST['remove_id'];

            $sql = "DELETE FROM `tbl_about_us` WHERE `id` =$remove_id";
            $rs = Connection()->query($sql);
            if($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "About Delete Success",
                                icon: "success",
                                button: "Done",
                            });
                        });
                    </script>
                '; 
                        
            }
        }
    }
    DeleteAboutUS();
?>