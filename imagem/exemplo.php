<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link >
    <title>Document</title>
    <!--Css de Bootstrap-->
<link rel="stylesheet" href="bootstrap/_css/bootstrap.css" >
    
    <!--Css de Fileinput-->
    <link rel="stylesheet" href="fileinput/css/fileinput.css">

</head>
<!-- some CSS styling changes and overrides -->

<body>

<!-- markup -->
<!-- note: your server code `avatar_upload.php` will receive `$_FILES['avatar']` on form submission -->
<!-- the avatar markup -->
<form class="form form-vertical" action="/avatar_upload.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-4 text-center">
            <div class="kv-avatar">
                <div class="file-loading">
                    <input id="avatar-1" name="avatar-1" type="file" required>
                </div>
            </div>
            <div class="kv-avatar-hint"><small>Select file < 1500 KB</small></div>
        </div>
        <div class="col-sm-8">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="email">Email Address<span class="kv-reqd">*</span></label>
                <input type="email" class="form-control" name="email" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="pwd">Password<span class="kv-reqd">*</span></label>
                <input type="password" class="form-control" name="pwd" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" name="fname" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" name="lname" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <hr>
            <div class="text-right"> 
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
    </div>
</form>
<div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
 
<!-- the fileinput plugin initialization -->
<script>
var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
    'onclick="alert(\'Call your custom code here.\')">' +
    '<i class="glyphicon glyphicon-tag"></i>' +
    '</button>'; 
$("#avatar-1").fileinput({
    overwriteInitial: true,
    maxFileSize: 1500,
    showClose: false,
    showCaption: false,
    browseLabel: '',
    removeLabel: '',
    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
    removeTitle: 'Cancel or reset changes',
    elErrorContainer: '#kv-avatar-errors-1',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="uploads/default-avatar.jpg" alt="Your Avatar">',
    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png", "gif"]
});

<script src="jquery/jquery.js"></script>
<script src="bootstrap/_js/bootstrap.js"></script>
<script src="fileinput/js/plugins/piexif.min.js"><script>
<script src="fileinput/js/plugins/purify.min.js"><script>
<script src="fileinput/js/plugins/sortable.min.js"><script>

</script>
</body>
</html>