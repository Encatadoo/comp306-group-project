<html>
<head>
<link rel="stylesheet" href="modif.css">
</head>
<body>

    <!--Insert operation -->

    <h1 style = "font-size: 60px; text-decoration: underline">HR</h1>
    <h2 style = "font-size: 30px; position: relative; top: -30px">Employee</h2>

<div id = "hr_first_form">
    <form action='result.php' method='post'>
        <label>ID:         </label><input type='number' name='emp_id' /><br/>
        <input class= "modif", name="fire", value='Fire' type='submit'/>
        <input class= "modif", name="salary", value='Salary' type='submit'/>
        <input class= "modif", name="metrics", value='Employee Metrics' type='submit'/></p>
    </form>
    <hr>
</div>

    <!--Remove operation -->
    <h2 style = "font-size: 30px; position: relative; top: -30px">Department</h2>
    <form id = "hr_second_form", action='result.php' method='post'>
        <label>Dept_ID:  </label><input type='number' name='dept_id' />
        <input name="d_metrics", value='Department metrics' type='submit'/></p>
    </form>
    <hr>
    <h2 style = "font-size: 30px; position: relative;">Some queries</h2>
    <!-- Manipulation operation -->
    <form action='result.php' method='post'>
    <input id= "engage", name="engage_scores", value='Get first ten employees who have the largest engagement points' type='submit'/>
    <input id= "salaries", name="top_salaries", value='Get first ten employees who have the highest salaries' type='submit'/>
    <input id= "update_salary_1", name="update_salaries_1", value='Decrease Salary' type='submit'/>
    <input id= "update_salary_2", name="update_salaries_2", value='Increase Salary' type='submit'/></p>
    </form>
    <hr>



</body>
</html>