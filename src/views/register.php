<?php
    $this->title = 'register';
?>

<div class="container">
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-8">
        <h3>Register new customer</h3>
        <p>Please confirm that all the information is correct. The company will not be liable if delivery information does not match</p>
        <hr>
        <form method="POST" action="" id="form" novalidate class="needs-validation" >
            <span class="sub-title">Personal Details</span>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="firstname">First name</label>
                        <div>
                            <input type="text" class="form-control <?php echo $model->hasError("firstname") ? 'isInvalid' : ''; ?>" id="firstname" placeholder="Type First name" name="firstname" value="<?php echo $model->firstname; ?>" autocomplete="false">
                        </div>
                        <p class="invalid"><?php echo $model->getFirstError("firstname"); ?></p>
                    </div>
                </div> 
                <div class="col">
                    <div class="form-group">
                        <label for="lastname">Last name</label>
                        <div>
                            <input type="text" class="form-control <?php echo $model->hasError("lastname") ? 'isInvalid' : ''; ?>" id="lastname" placeholder="Type Last name" name="lastname" value="<?php echo $model->lastname; ?>" >
                        </div>
                        <p class="invalid"><?php echo $model->getFirstError("lastname"); ?></p>
                    </div>
                </div> 
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" checked >
                <label class="form-check-label" for="female">Female</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="male" value="Male"  >
                <label class="form-check-label" for="male">Male</label>
            </div>
            <span class="sub-title">Billing Address</span>
            <div class="billing-address">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="province">Province</label>
                            <div>
                                <input type="text" class="form-control <?php echo $model->hasError("province") ? 'isInvalid' : ''; ?>" id="province" placeholder="Type province" name="province" value="<?php echo $model->state; ?>" > 
                            </div>
                            <p class="invalid"><?php echo $model->getFirstError("state"); ?></p>
                        </div>
                    </div> 
                    <div class="col">
                        <div class="form-group">
                            <label for="city">City</label>
                            <div>
                                <input type="text" class="form-control <?php echo $model->hasError("city") ? 'isInvalid' : ''; ?>" id="city" placeholder="Type City" name="city" value="<?php echo $model->city; ?>" >
                            </div>
                            <p class="invalid"><?php echo $model->getFirstError("city"); ?></p>
                        </div>
                    </div> 
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="postal_code">Postal Code</label>
                            <div>
                                <input type="text" class="form-control <?php echo $model->hasError("postal_code") ? 'isInvalid' : ''; ?>" id="postal_code" placeholder="Type postal code" name="postal_code" value="<?php echo $model->state; ?>" > 
                            </div>
                            <p class="invalid"><?php echo $model->getFirstError("state"); ?></p>
                        </div>
                    </div> 
                    <div class="col">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <div>
                                <input type="text" class="form-control <?php echo $model->hasError("city") ? 'isInvalid' : ''; ?>" id="address" placeholder="A subdivision/Barangay/block" name="address" value="<?php echo $model->city; ?>" >
                            </div>
                            <p class="invalid"><?php echo $model->getFirstError("city"); ?></p>
                        </div>
                    </div> 
                </div>
                <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>
                    <div>
                        <input type="text" class="form-control <?php echo $model->hasError("city") ? 'isInvalid' : ''; ?>" id="mobile_number" placeholder="Type Mobile Number" name="mobile_number" value="<?php echo $model->city; ?>" >
                    </div>
                    <p class="invalid"><?php echo $model->getFirstError("city"); ?></p>
                </div>
            </div>
            
       

            <span class="sub-title">Login Details</span>
            <div class="login-details">
                <div class="form-group">
                    <label for="email">Email</label>
                    <div>
                        <input type="text" class="form-control <?php echo $model->hasError("email") ? 'isInvalid' : ''; ?>" id="email" placeholder="Enter Email" name="email" value="<?php echo $model->email; ?>" required>
                        <p class="invalid"><?php echo $model->getFirstError("email"); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div>
                                <input type="password" class="form-control <?php echo $model->hasError("email") ? 'isInvalid' : ''; ?>" id="password" placeholder="Password" name="password" value="" required>
                                <!-- <small id="input-helpBlock" class="form-text">Password must be atleast 8 characters long.</small> -->
                                <p class="invalid"><?php echo $model->getFirstError("password"); ?></p>
                            </div>
                        </div>
                    </div> 
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <div>
                                <input type="password" class="form-control <?php echo $model->hasError("email") ? 'isInvalid' : ''; ?>" id="confirmPassword" placeholder="Confirm Password" name="confirmPassword" required>
                            </div>
                            <p class="invalid"><?php echo $model->getFirstError("confirmPassword"); ?></p>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="type_captcha">
                <label for="password">Type Captcha</label>
                <div class="row">
                    <div class="col col-md-4 col-lg-4">

                    </div>
                    <div class="col col-md-4 col-lg-4">
                        <div class="form-group">
                            
                            <div>
                                <input type="password" class="form-control <?php echo $model->hasError("email") ? 'isInvalid' : ''; ?>" id="password" placeholder="Type Captcha" name="password" value="" required>
                                <!-- <small id="input-helpBlock" class="form-text">Password must be atleast 8 characters long.</small> -->
                                <p class="invalid"><?php echo $model->getFirstError("password"); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            

            <div class="term_&_conditions">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="horizontalCheckbox">
                    <label class="form-check-label" for="horizontalCheckbox">I agree with the terms and condition and Privacy policy of Pizza.com</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="horizontalCheckbox">
                    <label class="form-check-label" for="horizontalCheckbox">I want to receive access to special offers, news and updates from Pizza.co.</label>
                </div>
                <p>Would you like to receive access to special offers, news and updates from Pizza.co. Please check to apply</p>
            </div>
            
            
            
           

          
            
            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary" name="submit">Register</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>