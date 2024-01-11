


<?php 
    include('sidebar.php');

    $id = $_GET['id'];

    $sql = "SELECT * FROM `tbl_logo` WHERE `id` = '$id'";
    $rs = Connection()->query($sql);
    $row = mysqli_fetch_assoc($rs);
    
?>

                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update Logo</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">

                                        <label>Thumbnail</label>
                                        
                                        <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                        <img id="show-img" src="./assets/Profile/<?php echo $row['thumbnail'] ?>"  alt="" width="100px">

                                        <input type="hidden" name="old_thumbnail" id="" value="<?php echo $row['thumbnail'] ?>">
                                    </div>
                                    <div class="form-group" >
                                        <label>Status</label>
                                        <select class="form-select" name="status">
                                            <option value="Header" <?php if($row['status']=="Header") echo 'selected' ?>>Header</option>
                                            <option value="Footer" <?php if($row['status']=="Footer") echo 'selected' ?>>Footer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn-update-logo" class="btn btn-success">Update logo</button>
                                    </div>
                                </form>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script>
    $(document).ready(function(){
        $('#thumbnail').change(function(){
            $('#show-img').hide();
        });
    });
</script>
</html>