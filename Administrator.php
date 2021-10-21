<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link rel="stylesheet" href="Style.css"/>
    <link rel="stylesheet" href="Administrator.css">
</head>
<body>
    <div id="wrapper">
        <?php
            include_once("connection.php");
        ?>
        <div id="content">
            <div id="datashow-aud">
                <form action="" id="show-aud">
                    <div>
                        <ul id="list-aud">
                            <li>
                                <a href="?page=add">
                                    <img src="images/add_icon.png" alt="" id="img-icon"></a>
                                </a>
                            </li>
                                <a href="?page=delete">
                                    <img src="images/delete_icon.png" alt="" id="img-icon">
                                </a>
                            </li>
                        </ul>
                        <ul id="list-aud">
                            <li>
                                <a href="?page=add" id="txtbtn">Add</a>
                            </li>
                                <a href="?page=delete" id="txtbtn">Delete</a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
            
            <div id="form-add-update-delete">
            <form action="" id="data-aud" method="GET">
                <p id="txt-PaU">Products and Update</p><br>
                <table id="tb-data">
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Type</th>
                        <th>Product Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Update</th>
                    </tr>
                    <?php
                        $sql = pg_query($conn, "SELECT * FROM product") or die(pg_error($conn));
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
                            <a href="?page=update&&id=<?php echo $result['ProID']; ?>" id="btn-edit">
                                <input type="button" value="Edit" id="edit-func">
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
            </form>
        </div>
    </div>
</body>
</html>