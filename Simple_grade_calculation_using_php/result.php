<!-- result.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Result</title>
  <style>
  .form__title {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
  }

  .form__table {
    border: 1px solid black;
    border-collapse: collapse;
    width: 50%;
    height: 500px;
    border-collapse: separate;
    border-spacing: 0;
    overflow: hidden;
    border-radius: 25px;
    margin: 0 auto;
    background-color: #fef;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  }

  .form__table td {
    border: 1px solid black;
    padding: 10px;
    text-align: center;
    font-size: 18px;
    color: #333;
    vertical-align: middle;
  }

  .form__table tr {
    border: 1px solid black;
    padding: 10px;
    text-align: center;
    font-size: 18px;
    color: #333;
    vertical-align: middle;
    border-radius: 25px;
  }

  .form__table tr:nth-of-type(odd) {
    background-color: #f2f2f2;
  }
  </style>
</head>

<body>
  <h1 class="form__title">Form Submission Result</h1>

  <?php

  function gradeCalculation($mark){
    if($mark>=80){
      return "A+";
    }
    elseif ($mark>=75) {
      return "A";
    }
    elseif ($mark>=70) {
      return "A-";
    }
    elseif ($mark>=65) {
      return "B+";
    }
    elseif ($mark>=60) {
      return "B";
    }
    elseif ($mark>=55) {
      return "B-";
    }
    elseif ($mark>=50) {
      return "C+";
    }
    elseif ($mark>=45) {
      return "C";
    }
    elseif ($mark>=40) {
      return "D";
    }
    else{
      return "F";
    }

  }

  function GPACalculation(){
    $grade_mark= [
      "A+"=>4.00,
      "A"=>3.75,
      "A-"=>3.50,
      "B+"=> 3.25,
      "B"=>3.00,
      "B-"=>2.75,
      "C+"=>2.50,
      "C"=>2.25,
      "C-"=>2.00,
      "D"=>1.75,
      "F"=> 0,
    ];
    // grade calculation
    $course_num = 0;
    $total_point =0;
    foreach ($_POST as $key => $value) {
      if(is_numeric($value)){
        $course_num++;
        $total_point +=$grade_mark[gradeCalculation($value)] ;
      }

    }
    return ($total_point/$course_num);

  }
    // Check if form data is available
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = htmlspecialchars($_POST['name']);
        $roll = htmlspecialchars($_POST['roll']);
        $sub1 = htmlspecialchars($_POST['sub1']);
        $sub2 = htmlspecialchars($_POST['sub2']);
        $sub3 = htmlspecialchars($_POST['sub3']);

         echo "<table border='1' class='form__table'>";
         echo "<tr><td>Name</td><td>$name</td></tr>";
         echo "<tr><td>Roll</td><td>$roll</td></tr>";
         echo "<tr><td>Subject 1</td> <td>".$sub1."(". gradeCalculation($sub1).")"."</td></tr>";
         echo "<tr><td>Subject 2</td><td>".$sub2."(". gradeCalculation($sub2).")"."</td></tr>";
         echo "<tr><td>Subject 3</td><td>".$sub3."(". gradeCalculation($sub3).")"."</td></tr>";
         echo "<tr><td>GPA</td><td>".GPACalculation()."</td></tr>";

        echo "</table>";

    } else {
        echo "<p>No data submitted.</p>";
    }
    ?>
</body>

</html>