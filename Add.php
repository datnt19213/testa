<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link rel="stylesheet" href="Style.css"/>
    <link rel="stylesheet" href="Products.css">
    <link rel="stylesheet" href="Administrator.css">
</head>

<body>
    <div id="wrapper">
        
        <div id="content">
            <div id="div-form">
            <?php
                include_once("connection.php");
                if(isset($_POST["btnAdd"]))
                {
                    $name = $_POST["txtname"];
                    $img = $_FILES['txtimage'];
                    $cate = $_POST['txtcategory'];
                    $price = $_POST['txtprice'];
                    $qty = $_POST['txtqty'];

                    $err = "";

                    if(trim($name) == ""){
                        $err .= "Enter Product Name, please<br/>";
                    }
                    if($img == ""){
                        $err .= "Enter Product Image, please<br/>";
                    }
                    if($cate == ""){
                        $err .= "Enter Product Category, please<br/>";
                    }
                    if($price == ""){
                        $err .= "Enter Product Price, please<br/>";
                    }
                    if($qty == ""){
                        $err .= "Enter Product Quantity, please<br/>";
                    }
                    if($err != ""){
                        echo "$err<br/>";
                    }
                
                else{
                    if($img['type']=="image/jpg" || $img['type']=="image/jpeg" || $img['type']=="image/png" || $img['type']=="image/gif"){
                        if($img['size']<=614400){
                            $result = pg_query($conn, "SELECT * FROM public.product WHERE ProName='$name'") or die(pg_error($conn));
                            if(pg_num_rows($result)==0){
                                copy($img['tmp_name'], "images/".$img['name']);
                                $filePic =$img['name'];
                                $sqlstring = "INSERT INTO punlic.product(ProName, ProImage, CategoryID,  Price, Pro_Qty) VALUES ('$name', '$filePic', '$cate', '$price', '$qty')";
                                pg_query($conn, $sqlstring);
                                echo '<meta http-equiv="refresh" content="0;URL=?page=administrator.php"/>';
                            }
                            else{
                                echo "Duplicae product Name<br/>";
                            }
                        }
                        else{
                            echo "Size of image too big<br/>";
                        }
                    }
                    else{
                        echo "Image format is not correct<br/>";
                    }
                }
            }
        ?>
                <form action="" id="add-form" method="post" enctype="multipart/form-data">
                    <p id="h-txt">Add</p><br>
                    <ul id="listInput">
                        <li id="Proname-add">
                            <p>Product Name:</p>
                            <input type="text" name="txtname" id="txtProname-add" placeholder="Product name" maxlength="50"><br><br>
                        </li>
                        <li id="proImage-add">
                            <p>Image:</p>
                            <input type="file" name="txtimage" id="ProImage-add" placeholder="Product image"><br><br>
                        </li>
                        <li id="ProType-add">
                            <p>Category:</p>
                            <input type="number" name="txtcategory" id="numType-add" placeholder="Category id" min="1" max="2" maxlength="1"><br><br>
                        </li>
                        <li id="proPrice-add">
                            <p>Price:</p>
                            <input type="number" name="txtprice" id="Price-add" maxlength="10"><br><br>
                        </li>
                        <li id="ProQty-add">
                            <p>Quantity:</p>
                            <input type="number" name="txtqty" id="proQty-add" maxlength="10"><br><br>
                        </li>
                        <li>
                            <input type="submit" name="btnAdd" value="Add" id="add">
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
