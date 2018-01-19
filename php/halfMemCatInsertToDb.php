<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>會員登入</title>
<style>
    a{
        cursor: pointer;
        border-bottom: 1px solid #44f;
        color: #44f;
        text-decoration: none;
    }
</style>
</head>

<body>
<?php
try {
    require_once "connectBD103G2.php";
    $sql = "insert into
            cat (HALF_NO,CAT_NAME,CAT_DATE,CAT_SEX,CAT_NARRATIVE,CAT_LOCATION,CAT_VACCINE,CAT_LIGATION,CAT_INDIVIDUALITY,CAT_FIT,CAT_ADVANTAGE,CAT_DISADVANTAGE,CAT_COVER)
            values (:no,:name,:date,:sex,:narrative,:location,:vaccine,:ligation,:individuality,:fit,:advantage,:disadvantage,:catpic)";
    $products = $pdo->prepare($sql);
    $products->bindValue(":no", $_REQUEST["no"]);
    $products->bindValue(":name", $_REQUEST["name"]);
    $products->bindValue(":date", $_REQUEST["date"]);
    $products->bindValue(":sex", $_REQUEST["sex"]);
    $products->bindValue(":narrative", $_REQUEST["narrative"]);
    $products->bindValue(":location", $_REQUEST["location"]);
    $products->bindValue(":vaccine", $_REQUEST["vaccine"]);
    $products->bindValue(":ligation", $_REQUEST["ligation"]);
    $products->bindValue(":individuality", $_REQUEST["individuality"]);
    $products->bindValue(":fit", $_REQUEST["fit"]);
    $products->bindValue(":advantage", $_REQUEST["advantage"]);
    $products->bindValue(":disadvantage", $_REQUEST["disadvantage"]);
    $products->bindValue(":catpic", $_REQUEST["catpic"]);
    $products->execute();
    echo "<center>新增成功</center><br>
        <center>將在五秒後回到原網址</center><br>
        <center><a id='backNext'>或者點此直接回到原網址</a></center>";
} catch (Exception $e) {
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
    echo "錯誤行號 : ", $e->getLine(), "<br>";
}
?>
<script>
    window.addEventListener('load', ()=>{
        let back = document.getElementById('backNext')
        setTimeout(function back(){
            history.back()
        }, 5000)
        back.addEventListener('click', (e)=>{
            e.preventDefault();
            window.history.back()
        })
    })
</script>
</body>
</html>