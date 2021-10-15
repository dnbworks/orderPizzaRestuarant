<?php

use app\core\Application;
    $this->title = 'Edit profile';
 
    $birthdate = explode("/", $user->birthdate);

    function strToMonth($NumericMonth){
        switch ($NumericMonth) {
            case 1:
                $month = 'January';
                break;
            case 2;
                $month = 'February';
                break;
            case 3:
                $month = 'March';
                break;
            case 4:
                $month = 'April';
                break;
            case 5:
                $month = 'May';
                break;
            case 6:
                $month = 'June';
                break;
            case 7:
                $month = 'July';
                break;
            case 8:
                $month = 'August';
                break;
            case 9:
                $month = 'September';
                break;
            case 10:
                $month = 'October';
                break;
            case 11:
                $month = 'November';
                break;
            case 12:
                $month = 'December';
                break;
        }

        return $month;
    }
   
    
?>


          <h4>Edit profile</h4>
          <?php if(Application::$app->session->getFlash('success')): ?>
            <div class="alert alert-success">
                <?php echo Application::$app->session->getFlash('success'); ?>
            </div>
        <?php endif; ?>
          <form method="POST" action="/edit-profile" enctype="multipart/form-data">
              <div class="row">
                  <div class="col">
                      <div class="form-group">
                          <label for="firstname">First name</label>
                          <div>
                              <input type="text" class="form-control <?php echo $user->hasError("firstname") ? 'isInvalid' : ''; ?>" id="firstname" placeholder="First name" name="firstname" value="<?php echo $user->firstname;?>" >
                              <p class="invalid"><?php echo $user->getFirstError("firstname"); ?></p>
                          </div>
                      </div>
                  </div> 
                  <div class="col">
                      <div class="form-group">
                          <label for="lastname">Last name</label>
                          <div>
                              <input type="text" class="form-control <?php echo $user->hasError("lastname") ? 'isInvalid' : ''; ?>" id="lastname" placeholder="Last name" name="lastname" value="<?php echo $user->lastname;?>" >
                              <p class="invalid"><?php echo $user->getFirstError("lastname"); ?></p>
                          </div>
                      </div>
                  </div> 
              </div>
                <?php  if($user->gender == 'M') :?>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="female" value="Female"  >
                  <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <?php  else :?>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="female" value="Female" checked>
                  <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" >
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <?php  endif; ?>
              

              <div class="row">
                  <div class="form-group col-4">
                      <label for="birthdayDay">Day</label>
                      <select class="form-control" id="birthdayDay" name="day"  >
                          <option value="<?php echo $birthdate[1]?>" selected hidden><?php $day = isset($user->birthdate) ? $birthdate[1] : 'day';?><?php echo $day;?></option>
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
                  <div class="form-group col-4">
                      <label for="birthdayMonth" >Month</label>
                      <select class="form-control" id="birthdayMonth" name="month" >
                        <option value="<?php echo $birthdate[0]?>" selected hidden><?php $month = isset($user->birthdate) ? $birthdate[0] : 'Month';?><?php echo strToMonth($month);?></option>
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
                    <div class="form-group col-4">
                      <label for="birthdayYear" >Year</label>
                      <select class="form-control" id="birthdayYear" name="year" >
                        <option value="<?php echo $birthdate[2]?>" selected hidden><?php $year = isset($user->birthdate) ? $birthdate[2] : 'Year';?><?php echo $year;?></option>
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
                                <input type="text" class="form-control <?php echo $user->hasError("city") ? 'isInvalid' : ''; ?>" id="city" placeholder="City" name="city" value="<?php echo $user->city;?>" >
                                <p class="invalid"><?php echo $user->getFirstError("city"); ?></p>
                            </div>
                        </div>
                  </div> 
                  <div class="col">
                        <div class="form-group">
                            <label for="state">State</label>
                            <div>
                                <input type="text" class="form-control <?php echo $user->hasError("state") ? 'isInvalid' : ''; ?>" id="state" placeholder="State" name="state" value="<?php echo $user->state;?>" > 
                                <p class="invalid"><?php echo $user->getFirstError("state"); ?></p>
                            </div>
                        </div>
                  </div> 
                </div>
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" id="example-file-custom-button" class="custom-file-input" name="picture" value="<?php echo $user->picture;?>" >
                    <label class="custom-file-label" for="example-file-custom-button" data-browse="Select file" >Custom file browser</label> 
                  </div>
                  <input type="hidden"  name="old_image" value="<?php echo $user->picture;?>" >
                </div>
                <?php if($user->picture): ?>
                    <img src="/uploads/<?php echo $user->picture ;?>" alt="" srcset="" width="100px">
                <?php else: ?>
                    <img src="/assets/img/nopic.jpg" alt="" srcset="" width="100px">
                <?php endif; ?>


              <div class="form-group">
                  <div>
                      <button type="submit" class="btn btn-primary" name="submit" >Save Profile</button>
                  </div>
              </div>
          </form>
