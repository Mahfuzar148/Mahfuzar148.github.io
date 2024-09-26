<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <style>
  div {
    position: relative;
  }

  table {
    border-collapse: separate;
    border-spacing: 0;
    border: 1px solid black;
    border-radius: 20px;
    overflow: hidden;
  }

  td {
    border: 1px solid black;
    padding: 10px;
  }

  input {
    border-radius: 10px;
    margin: 10px;
    padding: 10px;
    border: 1px solid teal;
  }

  h2 {
    position: absolute;
    top: 0%;
    left: 25%;

  }
  </style>
</head>

<body>
  <div class="form__area">
    <h2>Grade Calculation</h2>

    <form action="result.php" method="post" target="_blank">
      <table border="1" style="border-collapse: collapse;">

        <tr>
          <td><label for="name">Name:</label></td>
          <td><input type="text" id="name" name="name" required></td>
        </tr>

        <tr>
          <td><label for="roll">Roll:</label></td>
          <td><input type="text" id="roll" name="roll" required></td>
        </tr>
        <tr>
          <td><label for="sub1">Subject1 : </label></td>
          <td><input type="text" name="sub1" id="sub1"></td>
        <tr>
        <tr>
          <td><label for="sub2">Subject2 : </label></td>
          <td><input type="text" name="sub2" id="sub2">
        </tr>
        </td>

        <tr>
          <td><label for="sub3">Subject3 : </label></td>
          <td> <input type="text" name="sub3" id="sub3"></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;">
            <input class="submit" type="submit" value="Submit">
          </td>
        </tr>
      </table>
    </form>


  </div>
  <script src="" async defer></script>
</body>

</html>