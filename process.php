<?php
include 'connection.php';

if(isset($_GET['delete'])){
    $id=(int)$_GET['delete'];
    mysqli_query($conn,"DELETE FROM orders WHERE order_id=$id");
    header("Location: index.php"); exit;
}

if(isset($_POST['save'])){
    // ← experience added in INSERT query
    mysqli_query($conn,"INSERT INTO orders(customer_name, food_item, quantity, price, order_date, experience)
    VALUES('{$_POST['customer_name']}','{$_POST['food_item']}','{$_POST['quantity']}',
           '{$_POST['price']}','{$_POST['order_date']}','{$_POST['experience']}')");
    header("Location: index.php"); exit;
}

if(isset($_POST['update'])){
    $id=(int)$_POST['order_id'];
    // ← experience added in UPDATE query
    mysqli_query($conn,"UPDATE orders SET
    customer_name='{$_POST['customer_name']}',
    food_item='{$_POST['food_item']}',
    quantity='{$_POST['quantity']}',
    price='{$_POST['price']}',
    order_date='{$_POST['order_date']}',
    experience='{$_POST['experience']}'
    WHERE order_id=$id");
    header("Location: index.php"); exit;
}
?>