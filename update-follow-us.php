<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update Follow Us</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <h2>All Social</h2>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="label" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>URL</label>
                                        <input type="text" name="url" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Thumbnail</label>
                                        <input type="file" name="thumbnail" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Status</label>
                                        <select class="form-select" name="status">
                                            <option value="Header">Header</option>
                                            <option value="Footer">Footer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn-follow" class="btn btn-success">Submit</button>
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