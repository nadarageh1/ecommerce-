<div class="container login-page">
	<h1 class="text-center">
    <?php echo sha1('yami');?>
    		<span class=" selected" data-class="login">Login</span>|
    		 <span  data-class="signup">Sign Up</span>
    	</h1>
      <!-- Start Login Page-->
       <form class="login" method="post" action="login.php">
         <div class="form-group row">
          <div class="col-sm-10">
          
            <input 
                 type="text" 
                 class="form-control" 
                 name="username"  
                 placeholder=" Enter Username" 
                 autocomplete="off" 
                 data-text="nada">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10">
            <input 
                  type="password" 
                  class="form-control" 
                  name="password" 
                  placeholder="Enter Password" 
                  autocomplete="new-password">
          </div>
        </div>
        <div class="form-group row">
          <div class=" col-sm-10">
            <button 
                  type="submit" 
                  name="login"
                  class="btn btn-primary btn-block">Login</button>
          </div>
        </div>
      	</form>
              <!-- End Login Page-->
                <!-- Start Sign Up Page-->
      	 <form class="signup"  method="post" action="signup.php">
         <div class="form-group row">
          <div class="col-sm-10">
             <!--pattern is validate in html5 if input 
             contain<4 characters echo Message Error--> 
            <input 
                 pattern='.{4,8}'
                 title="Username Must Between  4 and 8 Characters"
                 type="text" 
                 class="form-control" 
                 name="name"  
                 placeholder=" Enter Username" 
                 autocomplete="off" 
                 data-text="nada"
                 required>
          </div>
        </div>
           <div class="form-group row">
          <div class="col-sm-10">
            <input 
                 
                 class="form-control" 
                 name="email"  
                 placeholder=" Enter Email" 
                 autocomplete="off" 
                 data-text="nada"
                 required>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <input 
                  pattern='.{4,8}'
                  title="Password Must Between  4 and 8 Characters"
                  type="password" 
                  class="form-control" 
                  name="pass" 
                  placeholder="Enter Password" 
                  autocomplete="new-password" 
                  required>
          </div>
        </div>
          <div class="form-group row">
          <div class="col-sm-10">
            <input 
                  type="password" 
                  class="form-control" 
                  name="pass2" 
                  placeholder="Confirm  Password" 
                  autocomplete="new-password"
                  required>
          </div>
        </div>
        <div class="form-group row">
          <div class=" col-sm-10">
            <button 
                  type="submit" 
                  name="signup"
                  class="btn btn-success btn-block">Sign Up</button>
          </div>
        </div>

      	</form>
          <!-- End Sign Up Page-->
   </div>
      
          <?php   
            if(!empty($formErrors)){
            foreach ($formErrors as $error) {  
               echo '<div style="color:red" class="text-center">'.$error .'</div><br>';
            } 
          }
          if(isset($suceesMSG)){
                echo '<div style="color:green" class="text-center">'.$suceesMSG .'</div><br>';
            }?>
     


   