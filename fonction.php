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
function getInfoSalaire(){
    $db=dbconnect();
    $sql=" SELECT
    sum(employees.gender = 'M') as hommes, sum(employees.gender = 'F') as femmes,title,avg(salaries.salary) as salaire 
    FROM titles 
    JOIN employees ON employees.emp_no = titles.emp_no 
    JOIN salaries ON employees.emp_no = salaries.emp_no AND salaries.to_date = '9999-01-01'
    GROUP BY titles.title ORDER BY titles.title";
    $req=mysqli_query($db,$sql);
    $result = array();
    while ($res = mysqli_fetch_assoc($req)) {
        $result[] = $res;
    }

    mysqli_free_result($req);
    return $result;
}
function getNomDepart(){
    $db=dbconnect();
    $sql=" SELECT
    *FROM departments";
    $req=mysqli_query($db,$sql);
    $result = array();
    while ($res = mysqli_fetch_assoc($req)) {
        $result[] = $res;
    }

    mysqli_free_result($req);
    return $result;

}
function getDepartementActuel($id) {
    $db = dbconnect();
    $sql = "SELECT d.dept_no, d.dept_name, de.from_date 
            FROM dept_emp de
            JOIN departments d ON de.dept_no = d.dept_no
            WHERE de.emp_no = '$id'
            AND de.to_date = '9999-01-01' 
            LIMIT 1";
            
    $req = mysqli_query($db, $sql);
    $result = mysqli_fetch_assoc($req);
    
    mysqli_free_result($req);
    return $result;
}

function modifierDepartementEmployee($id, $new_dept, $date) {
    $db = dbconnect();
    $sql_update = "UPDATE dept_emp 
                   SET to_date = '$date' 
                   WHERE emp_no = '$id' 
                   AND to_date = '9999-01-01'";
    
    $req_update = mysqli_query($db, $sql_update);

    $sql_insert = "INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date) 
                   VALUES ('$id', '$new_dept', '$date', '9999-01-01')";
                   
    $req_insert = mysqli_query($db, $sql_insert);
    if($req_update && $req_insert) {
        return true;
    } else {
        return false;
    }
}

?>