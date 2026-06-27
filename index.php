<?php
include 'connection.php';

$edit = false;
$editData = ["order_id"=>"", "customer_name"=>"", "food_item"=>"", 
             "quantity"=>"", "price"=>"", "order_date"=>"", "experience"=>"yes"]; // ← experience added

if(isset($_GET['edit'])){
    $id=(int)$_GET['edit'];
    $res=mysqli_query($conn,"SELECT * FROM orders WHERE order_id=$id");
    if($row=mysqli_fetch_assoc($res)){
        $edit=true;
        $editData=$row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Food Ordering System</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>🍔 Food Ordering System 🍕</h1>
<p class="subtitle">Developed by Sawera</p>

<form method="post" action="process.php">
<input type="hidden" name="order_id" value="<?php echo $editData['order_id'];?>">
<input type="text" name="customer_name" placeholder="Customer Name" required value="<?php echo $editData['customer_name'];?>">
<input type="text" name="food_item" placeholder="Food Item" required value="<?php echo $editData['food_item'];?>">
<input type="number" name="quantity" placeholder="Quantity" required value="<?php echo $editData['quantity'];?>">
<input type="number" name="price" placeholder="Price" required value="<?php echo $editData['price'];?>">
<input type="date" name="order_date" required value="<?php echo $editData['order_date'];?>">

<!-- NEW EXPERIENCE FIELD START -->
<div class="field" style="grid-column:1/3">
    <label style="display:block; margin-bottom:8px; color:white;">🍽️ Previous Experience?</label>
    <select name="experience" style="width:100%; padding:12px; border-radius:10px; border:none;">
        <option value="yes" <?php echo ($editData['experience'] == 'yes') ? 'selected' : ''; ?>>Yes - I've ordered before</option>
        <option value="no" <?php echo ($editData['experience'] == 'no') ? 'selected' : ''; ?>>No - First time ordering</option>
    </select>
</div>
<!-- NEW EXPERIENCE FIELD END -->

<div class="buttons">
<?php if($edit){ ?>
<button class="update" name="update">✏ Update Order</button>
<?php } else { ?>
<button class="save" name="save">💾 Save Order</button>
<?php } ?>
</div>
</form>

<h3 style="color:white; margin-top:20px;">📋 All Orders</h3>
<table>
<thead>
<tr>
<th>ID</th><th>Customer</th><th>Food</th><th>Qty</th><th>Price</th><th>Date</th>
<th>Experience</th><th>Actions</th> <!-- ← New Column -->
</tr>
</thead>
<tbody>
<?php
$r=mysqli_query($conn,"SELECT * FROM orders ORDER BY order_id DESC");
while($row=mysqli_fetch_assoc($r)){
?>
<tr>
<td><?php echo $row['order_id'];?></td>
<td><?php echo $row['customer_name'];?></td>
<td><?php echo $row['food_item'];?></td>
<td><?php echo $row['quantity'];?></td>
<td><?php echo $row['price'];?></td>
<td><?php echo $row['order_date'];?></td>
<td>
    <?php 
    if($row['experience'] == 'yes') {
        echo '<span style="background:#28a745; color:white; padding:4px 10px; border-radius:15px; font-size:12px;">✓ Regular</span>';
    } else {
        echo '<span style="background:#ff9800; color:white; padding:4px 10px; border-radius:15px; font-size:12px;">⭐ New</span>';
    }
    ?>
</td>
<td>
<a class="btn edit" href="?edit=<?php echo $row['order_id'];?>">Edit</a>
<a class="btn delete" href="process.php?delete=<?php echo $row['order_id'];?>" onclick="return confirm('Delete this order?')">Delete</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>

<div class="footer">Restaurant Theme • CRUD Operations • Semester Project</div>
</div>
</body>
</html>