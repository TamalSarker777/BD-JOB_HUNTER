 <?php
                     try{
                         
                        $conn=new PDO('mysql:host=localhost:3306;dbname=careerbuilder;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        //database code execute, default : warning generate
                        $sqlquerystring="DELETE FROM jobs  WHERE CURRENT_TIMESTAMP()>deadline";
                        $returnobj=$conn->query($sqlquerystring);         
                      
                        }
    
                    catch (PDOException $ex){
                        ?>

            <?php
                    }
                   
                    ?>