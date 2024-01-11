<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add Sport News</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-select" name="newType" >
                                            <option value="National">National</option>
                                            <option value="International">International</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-select" name="category" >
                                            <option value="Sport">Sport</option>
                                            <option value="Social">Social</option>
                                            <option value="Entertainment">Entertainment</option>

                                        </select>
                                        <!-- <input type="checkbox" class="form-check-input"> -->
                                    </div>
                                    <div class="form-group" >
                                        <label>Thumbnail <span class="text-danger">(Recommend size 350 x 200)</span></label>
                                        <input type="file" name="thumbnail" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Banner <span class="text-danger">(Recommend size 730 x 415)</span></label>
                                        <input type="file" name="banner"  class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Description</label>
                                        <textarea name="description"  class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn-add-news" class="btn btn-primary">Submit</button>
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
</html>