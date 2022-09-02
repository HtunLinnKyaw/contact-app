<?php require_once "base.php"; ?>
<?php require_once "functions.php"; ?>
<?php
if(isset($_POST['create'])){
    insertToDb();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            padding: 100px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-7 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="fw-light">Create Contact</h2>
                    <a href="index.php">
                        <button class="btn btn-outline-secondary required float-end"><i class="fa-solid fa-arrow-left"></i> Back</button>
                    </a>
                    <?php


                    if (isset($_POST['create'])) {
                        register();
                    }


                    ?>
                    <form action="" method="POST" class="mt-5" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label  class="form-label">Profile</label>
                            <input type="file" name="upload" class="form-control" value="<?php echo old("upload"); ?>">
                            <?php if(getError('upload')) { ?>
                                <small class="text-danger"><strong><?php echo getError('upload'); ?></strong></small>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Contact Name</label>
                            <input type="text" name="contact_name" class="form-control" value="<?php echo old("contact_name"); ?> ">
                            <?php if(getError('contact_name')) { ?>
                                <small class="text-danger"><strong><?php echo getError('contact_name'); ?></strong></small>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Phone Number</label>
                            <input type="tel" name="phone_number" class="form-control" value="<?php echo old("phone_number"); ?>">
                            <?php if(getError('phone_number')) { ?>
                                <small class="text-danger"><strong><?php echo getError('phone_number'); ?></strong></small>
                            <?php } ?>
                        </div>
                        <button type="submit" name="create"  class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php clearError(); ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>

</script>
</body>
</html>