<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Assignment 01</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
<?php
    //get id from URL
    $index = $_GET['index'];
 
    //get json data
    $data = file_get_contents('articles.json');
    $data_array = json_decode($data);
 
    //assign the data to selected index
    $row = $data_array[$index];
    if (!str_contains($_POST['url'], 'http')) {
        $_POST['url']='http://'.$_POST['url'];
    }

    if(isset($_POST['save'])){
        $input = array(
            'id' => $_POST['id'],
            'title' => $_POST['title'],
            'url' => $_POST['url'],
        );
 
        //update the selected index
        $data_array[$index] = $input;
 
        //encode back to json
        $data = json_encode($data_array, JSON_PRETTY_PRINT);
        file_put_contents('articles.json', $data);
 
        header('location: index.php');
    }
?>
<div class="container">
    <h1 class="page-header text-center">Edit Articles</h1>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-8"><a href="index.php" class="btn btn-warning" style="margin-bottom:20px;">Back</a>
        <form method="POST">
            <div class="mb-3 row">
                <b><label class="col-sm-2 col-form-label">ID</label></b>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id" name="id" value="<?php echo $row->id; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <b><label class="col-sm-2 col-form-label">Title</label></b>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $row->title;?>" required>
                </div>
            </div>
            <div class="mb-3 row">
                <b><label class="col-sm-2 col-form-label">URL</label></b>
                <div class="col-sm-10">
                    <input type="url" class="form-control" id="url" name="url" value="<?php echo $row->url; ?>"required>
                </div>
            </div>
         
            <input type="submit" name="save" value="Save" class="btn btn-primary" style=" margin-top:20px;">
        </form>
        </div>
        <div class="col-5"></div>
    </div>
</div>    
</body>
</html>