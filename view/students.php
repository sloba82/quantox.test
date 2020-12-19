<?php require_once  'header.php';?>
<div class="container">
    
<div class="jumbotron text-center">
  <h3>Students</h3>
</div>
<div class="container">  
    <div class="row">
        <table class="table">
          <thead>
            <tr>
            <th scope="col">Full Name</th>
            <th scope="col">School Board</th>
            <th scope="col">Created At</th>
            <th scope="col">Button</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($data as $student) { ?>
                    <tr>
                      <td><?= $student['full_name'] ?></td>   
                      <td><?= $student['sb_name'] ?></td>
                      <td><?= $student['created_at'] ?></td>
                      <td><button type="button" class="btn btn-primary">Student</button></td>
                    </tr>
          <?php  } ?>
          </tbody>
        </table>
    </div>  
</div> 
</div>

<?php require_once  'footer.php';?>
