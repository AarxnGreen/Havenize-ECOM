<?php addUser(); ?>

<div id="page-wrapper">

<div class="container-fluid">



        <div class="col-lg-12">
          

            <h1 class="page-header">
                Add new User
             
            </h1>
              <p class="bg-success">
            </p>

            <!-- <a href="add_user.php" class="btn btn-primary">Add User</a> -->


            <div class="col-md-4">

                    <form action="" method="post">

                    <div class="form-group">
                        <label for="">Username</label>
                        <input class="form-control" type="text" name="username" id="">
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input class="form-control" type="password" name="password" id="">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input class="form-control" type="email" name="email" id="">
                    </div>

                    <div class="form-group">
                        <label for="">First Name</label>
                        <input class="form-control" type="text" name="firstName" id="">
                    </div>

                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input class="form-control" type="text" name="lastName" id="">
                    </div>

                    <div class="form-group">
                    <input type="submit" name="addUser" class="btn btn-primary pull-left" value="Add User" >
                    </div>

                </form>
            

            </div>
            
        </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->