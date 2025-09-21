<div class="form1">
  <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" >
    <label for="dob">Date of Birth:</label>
    <input type="date" name="dob" placeholder="<?php echo $dob?>" style="width:30vw">
    <label for="gender">Gender:</label>
    <select name="gender" id="gender" style="width:30vw">
      <option value="" disabled selected><?php echo $gender?></option>
      <option value="female">Female</option>
      <option value="male">Male</option>
      <option value="nonbinary">Non-binary</option>
      <option value="transgender">Transgender</option>
      <option value="genderqueer">Genderqueer</option>
      <option value="agender">Agender</option>
      <option value="other">Other</option>
      <option value="prefer_not_to_say">Prefer not to say</option>
    </select>
    <label for="college">Course:</label>
    <select name="college" id="college" >
      <option value="" disabled selected ><?php echo $college?></option>
      <option value="1">College of Agriculture</option>
      <option value="3">College of Business Administration</option>
      <option value="2">College of Arts and Science</option>
      <option value="12">College of Architecture and Fine Arts</option>
      <option value="5">College of Education</option>
      <option value="8">College of Veterinary Medicine</option>
      <option value="6">College of Hospitality Management</option>
      <option value="4">College of Computer Studies</option>
      <option value="11">School of Industrial Engineering and Technology</option>
      <option value="13">College of Law and Jurispudence</option>
      <option value="7">College of Nursing</option>
      <option value="14">College of Criminology</option>
      <option value="10">Foundation Preparatory Academy</option>
      <option value="9">Graduate School</option>
    </select>
    <button type="submit" class="submit" name="change_data">Submit</button>
  </form>
  <?php 

      if ($successData === true) {
        echo "Changed data successfully!";
      }
    ?>
</div>