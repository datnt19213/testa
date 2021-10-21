<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main_Page</title>
</head>

<body>
<?php
    include_once("connection.php");
    $result = pg_query($conn, 'SELECT * FROM public.product ORDER BY RAND () LIMIT 1');
?>
    <div id="content-wrapper">
        <form action="Admin_Page.php" id="formShowNewProduct">
            <div class="row" id="row">
                <div class="col-sm-5 col-md-6">
                    <form action="" id="form-text">
                    <?php
                        if(pg_num_rows($result)>0){
                        $row = pg_fetch_assoc($result);
                    ?>
                        <img src="images/<?php echo $row['ProImage']; ?>" alt="Error Picture">
                        <p>
                            <ul>
                                <li>ID:&nbsp;<?php echo $row['ProID']; ?></li>
                                <li>Name:&nbsp;<?php echo $row['ProName']; ?></li>
                                <li>Type:&nbsp;<?php echo $row['CategoryID']; ?></li>
                                <li>Price:&nbsp;<?php echo $row['Price']; ?></li>
                                <li>Quantity:&nbsp;<?php echo $row['Pro_Qty']; ?></li>
                            <?php
                                }
                                else{
                                    echo ("Error: ".$conn);
                                }
                            ?>
                            </ul>
                        </p>
                        <a href="">
                            <button type="submit" id="cart-btn" onclick="a()"><script>function a(){alert('You just add the product to cart');}</script>Add to Cart</button>
                        </a>
                    </form>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
