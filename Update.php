<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="Products.css">
    <link rel="stylesheet" href="Administrator.css">
</head>
<body>
<?php
    include_once("connection.php");
    
    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
        $result=pg_query($conn, "SELECT * FROM product WHERE ProID='$id'");
        $row=pg_fetch_array($result, PGSQL_ASSOC);
        $proname=$row['ProName'];
        $proimage=$row['ProImage'];
        $categoryid=$row['CategoryID'];
        $price=$row['Price'];
        $qty=$row['Pro_Qty'];
?>
    <div id="content">
        <div id="form-update">
            <div id="wrapper">
                <form action="" id="frmUpdate" method="POST" enctype="multipart/form-data">
                    <p id="updateFrm">Update</p><br>
                    <ul id="listUpdate">
                        <li id="upID">
                            <p>Product ID:</p>
                            <input type="text" name="txtupProID" id="upProID" readonly maxlength="10" value="<?php echo $id; ?>"><br><br>
                        </li>
                        <li id="upName">
                            <p>Product Name:</p>
                            <input type="text" name="txtupProName" id="upProName" maxlength="50" value="<?php echo $proname; ?>"><br><br>
                        </li>
                        <li id="upImage">
                            <p>Product Image:</p>
                            <input type="file" name="txtupProImg" id="upProImg" value="<?php echo $proimage; ?>"><br><br>
                        </li>
                        <li id="upCate">
                            <p>Product Type:</p>
                            <input type="text" name="txtupProCate" id="upProCate" maxlength="10" value="<?php echo $categoryid; ?>"><br><br>
                        </li>
                        <li id="upPrice">
                            <p>Price:</p>
                            <input type="number" name="txtupProPrice" id="upProPrice" min="0" maxlength="10" value="<?php echo $price; ?>"><br><br>
                        </li>
                        <li id="upQty">
                            <p>Quantity:</p>
                            <input type="number" name="txtupProQty" id="upProQty" min="0" maxlength="10" value="<?php echo $qty; ?>"><br><br>
                        </li>
                        <li>
                            <input type="submit" name="btnUpdate" value="Update" id="update">
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
<?php
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0;url=?page=administrator"/>';
    }
?>
<?php
    if(isset($_POST["btnUpdate"]))
    {
        $id = $_POST["txtupProID"];
        $name = $_POST["txtupProName"];
        $image = $_FILES['txtupProImg'];
        $cate = $_POST['txtupProCate'];
        $pri = $_POST['txtupProPrice'];
        $quantity = $_POST['txtupProQty'];

        $err = "";

        if(trim($name)==""){
            $err .= "Enter Product Name, please<br/>";
        }
        if($image==""){
            $err .= "Enter Product Image, please<br/>";
        }
        if(trim($cate)==""){
            $err .= "Enter Category ID, please<br/>";
        }
        if(trim($pri)==""){
            $err .= "Enter Product price, please<br/>";
        }
        if(trim($quantity)==""){
            $err .= "Enter Product quantity, please<br/>";
        }
        if($err != ""){
            echo "$err<br/>";
        }

        else
        {
            if($image['name']!="")
            {
                if($image['type']=="image/jpg" || $image['type']=="image/jpeg" || $image['type']=="image/png" || $image['type']=="image/gif")
                {
                    if($image['size']<=614400)
                    {
                        $sql=pg_query($conn, "SELECT * FROM public.product WHERE ProID!='$id' AND ProName='$name'");
                        if(pg_num_rows($sql)==0)
                        {
                            copy($image['tmp_name'], "images/".$image['name']);
                            $filePic = $image['name'];

                            $sqlstring = "UPDATE product SET ProName='$name', ProImage='$filePic', CategoryID='$cate', Price='$pri', Pro_Qty='$quantity' WHERE ProID='$id'";
                            pg_query($conn, $sqlstring);
                            echo '<meta http-equiv="refresh" content="0;URL=?page=administrator"/>';
                        }
                        else
                        {
                            echo "Duplicate Product Name<br/>";
                        }
                    }
                    else
                    {
                        echo "Size of umage too big<br/>";
                    }
                }
                else
                {
                    echo "Image format is not correct";
                }
            }
            else
            {
                $res = pg_query($conn, "SELECT * FROM publicproduct WHERE ProID !='$id' AND ProName = '$name'");
                if(pg_num_rows($res)==0)
                {
                    $sqlstr="UPDATE product SET ProName='$name', CategoryID='$cate', Price='$pri', Pro_Qty='$quantity' WHERE ProID='$id'";
                    pg_query($conn, $sqlstr);
                    echo '<meta http-equiv="refresh" content="0;URL=?page=administrator"/>';
                }
                else
                {
                    echo "Duplicate Product Name<br/>";
                }
            } 
        }
    }
?>
</body>
</html>
