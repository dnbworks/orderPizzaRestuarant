<?php
    $this->title = 'Sign Up';
?>

<div class="row justify-content-center">
    <div class="col-12 col-md-6 col-lg-5">
        <h3>FindMyDate - Sign Up</h3>
        <!-- <p>Please enter your username and desired password to sign up to Mismatch</p> -->
        <form method="POST" action="" id="form" novalidate class="needs-validation">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="firstname">First name</label>
                        <div>
                            <input type="text" class="form-control <?php echo $model->hasError("firstname") ? 'isInvalid' : ''; ?>" id="firstname" placeholder="First name" name="firstname" value="<?php echo $model->firstname; ?>" >
                        </div>
                        <p class="invalid"><?php echo $model->getFirstError("firstname"); ?></p>
                    </div>
                </div> 
                <div class="col">
                    <div class="form-group">
                        <label for="lastname">Last name</label>
                        <div>
                            <input type="text" class="form-control <?php echo $model->hasError("lastname") ? 'isInvalid' : ''; ?>" id="lastname" placeholder="Last name" name="lastname" value="<?php echo $model->lastname; ?>" >
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
            <div class="row">
                  <div class="form-group col">
                      <select class="form-control <?php echo $model->hasError("day") ? 'isInvalid' : ''; ?>" id="birthdayDay" name="day"  >
                          <option value="<?php echo $model->day; ?>" selected hidden>Day (<?php echo $model->day; ?>)</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select>
                  </div>
                  <div class="form-group col">
                      <label for="birthdayMonth" class="sr-only">Birthday month</label>
                      <select class="form-control <?php echo $model->hasError("month") ? 'isInvalid' : ''; ?>" id="birthdayMonth" name="month" >
                        <option value="<?php echo $model->month; ?>" selected hidden>Month (<?php echo $model->month; ?>)</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                      </select>
                    </div>
                    <div class="form-group col">
                      <label for="birthdayYear" class="sr-only">Birthday year</label>
                      <select class="form-control <?php echo $model->hasError("year") ? 'isInvalid' : ''; ?>" id="birthdayYear" name="year" >
                        <option value="<?php echo $model->year; ?>" selected hidden>Year (<?php echo $model->year; ?>)</option>
                        <option value="1980">1980</option>
                        <option value="1981">1981</option>
                        <option value="1982">1982</option>
                        <option value="1983">1983</option>
                        <option value="1984">1984</option>
                        <option value="1985">1985</option>
                        <option value="1986">1986</option>
                        <option value="1987">1987</option>
                        <option value="1988">1988</option>
                        <option value="1989">1989</option>
                        <option value="1990">1990</option>
                        <option value="1991">1991</option>
                        <option value="1992">1992</option>
                        <option value="1993">1993</option>
                        <option value="1994">1994</option>
                        <option value="1995">1995</option>
                        <option value="1996">1996</option>
                        <option value="1997">1997</option>
                        <option value="1998">1998</option>
                        <option value="1999">1999</option>
                        <option value="2000">2000</option>
                      </select>
                    </div>
                  
              </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="city">City</label>
                        <div>
                            <input type="text" class="form-control <?php echo $model->hasError("city") ? 'isInvalid' : ''; ?>" id="city" placeholder="City" name="city" value="<?php echo $model->city; ?>" >
                        </div>
                        <p class="invalid"><?php echo $model->getFirstError("city"); ?></p>
                    </div>
                </div> 
                <div class="col">
                    <div class="form-group">
                        <label for="state">State</label>
                        <div>
                            <input type="text" class="form-control <?php echo $model->hasError("state") ? 'isInvalid' : ''; ?>" id="state" placeholder="State" name="state" value="<?php echo $model->state; ?>" > 
                        </div>
                        <p class="invalid"><?php echo $model->getFirstError("state"); ?></p>
                    </div>
                </div> 
            </div>
            <!-- <div class="form-group">
                <div class="custom-file">
                    <input type="file" id="example-file-custom-button" class="custom-file-input" name="file" value="<?php echo $model->$profile_picture; ?>" >
                    <input type="hidden"  name="old_image" value="" >
                    <label class="custom-file-label" for="example-file-custom-button" data-browse="Select picture" >Profile picture</label>
                </div>
            </div> -->
            <div class="form-group">
                <label for="username">Email</label>
                <div>
                    <input type="text" class="form-control <?php echo $model->hasError("email") ? 'isInvalid' : ''; ?>" id="email" placeholder="Enter Email" name="email" value="<?php echo $model->email; ?>" required>
                    <p class="valid-feedback">correct</p>
                    <p class="invalid"><?php echo $model->getFirstError("email"); ?></p>
                </div>
                
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div>
                    <input type="password" class="form-control <?php echo $model->hasError("email") ? 'isInvalid' : ''; ?>" id="password" placeholder="Password" name="password" value="" required>
                    <!-- <small id="input-helpBlock" class="form-text">Password must be atleast 8 characters long.</small> -->
                    <p class="invalid"><?php echo $model->getFirstError("password"); ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <div>
                    <input type="password" class="form-control <?php echo $model->hasError("email") ? 'isInvalid' : ''; ?>" id="confirmPassword" placeholder="Password" name="confirmPassword" required>
                </div>
                <p class="invalid"><?php echo $model->getFirstError("confirmPassword"); ?></p>
            </div>

          
            
            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
                </div>
            </div>
        </form>
    </div>
</div>