<?php
function dbconnect(){
    static $connect =null;
    if($connect === null){
        $connect = mysqli_connect('localhost','root','','employees');
        if(!$connect){
            die('Erreur de connexion a la base de donnees :' .mysqli_connect_error());

        }
        mysqli_set_charset($connect,'utf8mb4');
    }
    return $connect;

}
function getDepartements(){
    $db=dbconnect();
    $sql="SELECT 
    d.dept_no, 
    d.dept_name, 
    dm.emp_no,
    e.first_name,
    e.last_name,
    count(demp.dept_no) as nb_emp
    FROM departments d
    JOIN dept_manager dm ON d.dept_no = dm.dept_no
    JOIN employees e ON e.emp_no = dm.emp_no
    JOIN dept_emp as demp ON d.dept_no = demp.dept_no 
    WHERE dm.to_date = '9999-01-01'
    GROUP BY d.dept_no asc;";
    $req=mysqli_query($db,$sql);
    $result = array();
    while ($res = mysqli_fetch_assoc($req)) {
        $result[] = $res;
    }

    mysqli_free_result($req);
    return $result;
} 
function getInfoDepartements($id,$nombre){
    $db=dbconnect();
    $sql="SELECT employees.emp_no,employees.first_name,dept_emp.from_date,dept_emp.to_date
        FROM departments 
        JOIN dept_emp ON departments.dept_no = dept_emp.dept_no
        JOIN employees ON dept_emp.emp_no = employees.emp_no WHERE departments.dept_no = '%s' limit %d,20";
    $sql=sprintf($sql,$id,$nombre);
    $req=mysqli_query($db,$sql);
    $result = array();
    while ($res = mysqli_fetch_assoc($req)) {
        $result[] = $res;
    }

    mysqli_free_result($req);
    return $result;
} 
function getInfoEmployee($num){
    $db=dbconnect();
    $sql="SELECT * FROM employees where emp_no='$num'";
    $req=mysqli_query($db,$sql);
    $result = array();
    while ($res = mysqli_fetch_assoc($req)) {
        $result[] = $res;
    }

    mysqli_free_result($req);
    return $result;

}
function getHistoriqueSalaire($id){
    $db=dbconnect();
    $sql="SELECT salaries.emp_no,salaries.salary,salaries.from_date,salaries.to_date,titles.title FROM salaries 
            JOIN titles ON salaries.emp_no = titles.emp_no
            WHERE salaries.emp_no = '$id'
            AND salaries.from_date >= titles.from_date
            AND salaries.from_date < titles.to_date;";
    $req=mysqli_query($db,$sql);
    $result = array();
    while ($res = mysqli_fetch_assoc($req)) {
        $result[] = $res;
    }

    mysqli_free_result($req);
    return $result;

}
function getRecherche($depart,$nom,$min,$max,$limit){
    $db=dbconnect();
    $sql="SELECT 
    employees.emp_no,
    departments.dept_name,
    employees.first_name,
    employees.last_name,
    employees.birth_date,
    TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE()) AS age
    FROM departments
    JOIN dept_emp ON departments.dept_no = dept_emp.dept_no 
    JOIN employees ON dept_emp.emp_no = employees.emp_no 
    WHERE departments.dept_name LIKE '%%%s%%' 
    AND employees.first_name LIKE '%%%s%%'
    AND TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE()) >= $min AND TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE()) < $max LIMIT $limit,20";
    $sql=sprintf($sql,$depart,$nom);
    $req=mysqli_query($db,$sql);
    $result = array();
    while ($res = mysqli_fetch_assoc($req)) {
        $result[] = $res;
    }

    mysqli_free_result($req);
    return $result;

}
function getEmployelepluslong($id){
    $db=dbconnect();
    $sql="SELECT * ,YEAR(to_date)-YEAR(from_date) as duree FROM titles WHERE emp_no='$id' ORDER BY duree DESC LIMIT 1";
    $req=mysqli_query($db,$sql);
    $result = array();
    while ($res = mysqli_fetch_assoc($req)) {
        $result[] = $res;
    }

    mysqli_free_result($req);
    return $result;

}


?>