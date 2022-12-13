<?php
    include "connection.php"; 
?>
<!doctype html>
<html lang="en">
  <head>
  

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student DATA</title>
</head>
<body>
  
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student FOAM
                            <a href="get_data.php" class="btn btn-primary float-end">Add Students</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>DEGREE</th>
                                    <th>UNIVERSITY</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                    $query = "SELECT * FROM AddStudent";
                                    $query_run = mysqli_query($conn, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $student['Student']; ?></td>
                                                <td><?= $student['Degree']; ?></td>
                                                <td><?= $student['University']; ?></td>
                                            <td>
                                                <a href="delete.php?sid=<?php echo $student['Id']; ?>" class="btn btn-danger btn-sm">delete</a>
                                                <a href="update1.php?id=<?= $student['Id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                
                                            </td>
                                               
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                            

                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
