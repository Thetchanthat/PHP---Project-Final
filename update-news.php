<?php 
    include('sidebar.php');

    $id = $_GET['id'];
    $sql = "SELECT * FROM `tbl_news` WHERE `id`='$id'";
    $rs = Connection()->query($sql);
    $row = mysqli_fetch_assoc($rs);

    // var_dump($row);

?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update News</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" value="<?php echo $row['title'] ?>" name="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>News Type</label>
                                        <select class="form-select" name="newType" >
                                            <option <?php if($row['newType']=="National") echo "Selected" ?> value="National">National</option>
                                            <option <?php if($row['newType']=="International") echo "Selected" ?> value="International">International</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-select" name="category" >
                                            <option <?php if($row['category']=="Sport") echo "Selected" ?> value="Sport">Sport</option>
                                            <option <?php if($row['category']=="Social") echo "Selected" ?> value="Social">Social</option>
                                            <option <?php if($row['category']=="Entertainment") echo "Selected" ?> value="Entertainment">Entertainment</option>
                                        </select>
                                        <!-- <input type="checkbox" class="form-check-input"> -->
                                    </div>
                                    <div class="form-group" >
                                        <label>Thumbnail <span class="text-danger">(Recommend size 350 x 200)</span></label>
                                        <input type="file" id="thumbnail" name="thumbnail" class="form-control">
                                        <img id="old-thumbnail" src="./assets/image/<?php echo $row['thumbnail'] ?>" alt="" width="200px" height="120px">
                                        <input type="hidden" name="old_thumbnail" id="" value="<?php echo $row['thumbnail'] ?>">
                                    </div>
                                    <div class="form-group" >
                                        <label>Banner <span class="text-danger">(Recommend size 730 x 415)</span></label>
                                        <input type="file" id="banner" name="banner"  class="form-control">
                                        <img id="old-banner"  src="./assets/image/<?php echo $row['banner'] ?>" alt="" width="200px" height="120px">
                                        <input type="hidden" name="old_banner" id="" value="<?php echo $row['banner'] ?>">    
                                    </div>
                                    <div class="form-group" >
                                        <label>Description</label>
                                        <textarea name="description"  class="form-control">
                                            <?php echo $row['description'] ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn-update-news" class="btn btn-primary">Submit</button>
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
            $('#old-thumbnail').hide();
        });
        $('#banner').change(function(){
            $('#old-banner').hide();
        });
    });
</script>
</html>