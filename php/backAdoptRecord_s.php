<?php
    try{
        require_once('./connectBD103G2.php');

        $order = $_POST["order"];
        $qty = $_POST["qty"];

        if(isset($_POST["pages"])){
            $sql = "select count(*) count
                    from adoption";

            $data = $pdo -> prepare($sql);
            $data -> execute();
            $dataRow = $data -> fetchObject();
            echo $dataRow -> count;
        }else{
            
            if($order == '1'){
                $sql = "select a.CAT_NO catNo,c.CAT_NAME catName,m.MEM_ID memId,a.ADOPT_DATE adoptDate 
                        from adoption a 
                        join MEMBER m on a.MEM_NO = m.MEM_NO
                        join CAT c on a.CAT_NO = c.CAT_NO
                        group by a.CAT_NO 
                        order by a.ADOPT_DATE desc 
                        limit $qty,10";
            }else if($order == '2'){
                $sql = "select a.CAT_NO catNo,c.CAT_NAME catName,m.MEM_ID memId,a.ADOPT_DATE adoptDate 
                        from adoption a 
                        join MEMBER m on a.MEM_NO = m.MEM_NO
                        join CAT c on a.CAT_NO = c.CAT_NO
                        group by a.CAT_NO 
                        order by a.ADOPT_DATE
                        limit $qty,10";
            }
            $data = $pdo -> query($sql);
            $jsonData = array();
            while ($dataRow = $data -> fetchObject()) {
                array_push($jsonData,array('喵編號' => $dataRow -> catNo, '喵名字' => $dataRow -> catName, '領養者' => $dataRow -> memId, '領養時間' => $dataRow -> adoptDate));
            }
            $jsonData = json_encode($jsonData);
            echo $jsonData;
        }
    }catch(PDOException $e){
        echo $e -> getMessage();
        echo $e -> getLine();
    }

?>