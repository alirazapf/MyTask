<!doctype html>
<html lang="en">
  <head>
   
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

   
  </head>
  <body>
    <h1>STUDENT FORM</h1>
    
  <!-- Getting Data -->
    <div class="container my-5">
      <form action="Student_form.php" method="post">
        <div class="form-group">
          <label>Student Name</label>
          <input type="name " name="name" class="form-control" >
        </div>
        <div class="form-group">
          <label >Degree</label>
          <input type="degree" name="degree" >
          <div class="form-group">
            <label >University</label>
            <input type="university" name="university" >
          </div>
          <button  type="submit" class="btn btn-primary"name="submit">Submit</button>
        </div>
        <a href="index.php" class="btn btn-primary float-end">Return</a>
      </form>
    </div>
    <body>

    </div>
  </body>


</html>