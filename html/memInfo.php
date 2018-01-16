<?php
    ob_start();
    session_start();
?>
<div class="memInfo">
    <h4>修改會員資料</h4>
    <?php
try {
    require_once("../php/connectBD103G2.php");

    $sql = "select * from member where MEM_NO =?";
    $mem = $pdo->prepare( $sql );
    $mem->bindValue(1, $_SESSION["MEM_ID"]);//session
    $mem->execute();
    
    if( $mem->rowCount()==0){
        echo "<center>查無此會員資料</center>";
    }else{
        $memRow = $mem->fetchObject();
?>
    <form action="memInfoUpdateToDb.php">
        <input type="hidden" name="no" value="<?php echo $memRow->MEM_NO;?>">
        <table>
            <tr>
                <th>會員密碼</th>
                <td>
                    <input type="psw" name="mempsw" placeholder="<?php echo $memRow->MEM_PSW;?>">
                </td>
            </tr>
            <tr>
                <th>會員姓名</th>
                <td>
                    <input type="text" name="memname" placeholder="<?php echo $memRow->MEM_NAME;?>">
                </td>
            </tr>
            <tr>
                <th>會員電話</th>
                <td>
                    <input type="tel" name="memtel" placeholder="<?php echo $memRow->MEM_TEL;?>">
                </td>
            </tr>
            <tr>
                <th>會員地址</th>
                <td>
                    <input type="address" name="memaddress" placeholder="<?php echo $memRow->MEM_ADDRESS;?>">
                </td>
            </tr>
            <tr>
                <th>會員大頭貼</th>
                <td>
                    <input type="file" name="mempic">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">確定修改</button>
                </td>
            </tr>
        </table>
    </form>

    <?php
    } //if...else 
} catch (PDOException $e) {
  echo "錯誤行號 : ", $e->getLine(), "<br>";
  echo "錯誤訊息 : ", $e->getMessage(), "<br>"; 
}

?>