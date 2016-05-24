<?php  
    require_once "random_int/random_compat.phar";  
    function createStudentLoginId($form_id)
    {
        $query = "SELECT `branch`,`section`,`sem` FROM feedback_forms WHERE form_id=$form_id";
        $result = mysql_query($query) OR die(mysql_error());
        if(mysql_num_rows($result)==1)
        {
            $row = mysql_fetch_assoc($result);
            $branch = strtoupper($row["branch"]);
            $section = strtoupper($row["section"]);
            $sem = $row["sem"];
        }
        
        $uid = $branch.$section."S".$sem;
        $alluids = array();
        $allpass = array();
        
        for($i = 0 ; $i < 80 ; $i++)
        {
            $alluids[$i] = $uid.sprintf('%03d',($i+1));
            $allpass[$i] = random_str(6);       
        }
        
        $insert_query = "INSERT INTO students_login (enrollno,password,name,branch,section,sem) VALUES('";
        
        for($y = 0; $y<80 ; $y++)
		{
			$insert_query = $insert_query.$alluids[$y]."','".$allpass[$y]."','name','".$branch."','".$section."',".$sem."),('";
		}
		
		$insert_query = substr($insert_query,0 ,-3 );
        $result = mysql_query($insert_query) or die(mysql_error());
    }
    
    function random_str($length, $keyspace = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }
?>