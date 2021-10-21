<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="stylesheet" href="Products.css">
    <link rel="stylesheet" href="Administrator.css">
</head>

<script language="javascript">
    function deleteConfirm() {
        if(confirm("Are you sure to delete this product?")){
            return true;
        }
        else{
            return false;
        }
    }
</script>
<?php
    include_once("connection.php");
    if(isset($_GET["function"])=="del"){
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            pg_query($conn, "DELETE FROM public.product where ProID='$id'");
        }
    }
    ?>
<body>
    <div id="wrapper">
        <form action="" id="data-aud" method="GET">
            <p id="txt-PaU">Products and Delete</p><br>
            <div id="table">
                <table id="tb-data">
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Type</th>
                        <th>Product Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                        $sql = pg_query($conn, "SELECT * FROM public.product") or die(pg_error($conn));
                        if(pg_num_rows($sql)>0){
                            while($result = pg_fetch_assoc($sql)){
                    ?>
                    <tr id="boxdata">
                        <td id="boxdata"><?php echo $result['ProID']; ?></td>
                        <td id="boxdata"><?php echo $result['ProName']; ?></td>
                        <td id="boxdata"><?php echo $result['CategoryID']; ?></td>
                        <td id="boxdata"><img src="images/<?php echo $result['ProImage']; ?>" alt="Error image"></td>
                        <td id="boxdata"><?php echo $result['Price']; ?></td>
                        <td id="boxdata"><?php echo $result['Pro_Qty']; ?></td>
                        <td id="boxdata">
                            <a href="?page=delete&&function=del&&id=<?php echo $result["ProID"]; ?>" id="btn-edit" onclick="return deleteConfirm()">
                                <input type="button" name="btndelete" value="Delete" id="edit-func">
                            </a>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                        else{
                            function alert(){
                                alert("No result");
                            }
                            alert();
                        }
                    ?>
                </table>
            </div>
        </form>
    </div>
</body>
</html>
