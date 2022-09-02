<?php require_once "base.php"; ?>
<?php require_once "functions.php"; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" /><style>
        body{
            padding: 100px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">

            <h2 class="fw-light text-secondary">Contact List</h2>
            <hr>
            <a href="create.php" class="btn btn-primary float-end mb-3"><i class="fa-solid fa-plus"></i> New Contact</a>
            <table class="table table-bordered mt-5 table-hover align-middle text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach (users() as $u ) { ?>
                        <tr>
                            <td><?php echo $u['id'] ?></td>
                            <td>
                                <img src="<?php echo $u['image'] ?>" alt="avatar" class="rounded-circle" style="width:50px;height: 50px;">
                            </td>
                            <td><?php echo $u['name'] ?></td>
                            <td><?php echo $u['phone'] ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $u['id']; ?>" class="text-light">
                                    <button type="button" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></i></button>
                                </a>
                                <a href="delete.php?id=<?php echo $u['id']; ?>">
                                    <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </a>
                            </td>
                            <td>
                                <?php echo $u['created_at'] ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>

</script>
</body>
</html>