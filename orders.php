<?php
    include "config/connection.php";
    include "logic/functions.php";
    include "views/head.php";
    global $korisnik;
    if(isset($korisnik)){
        if($korisnik->role_name == "user"){ 
        header("Location: index.php");
        }
    }
    else{
        header("Location: index.php");
    }
    include "views/navbar.php";
    $orders = getOrders();
?>
<div class="w-100 container-fluid d-flex justify-content-center col-lg-6 col-12 mb-5" id="ordersTable">
  <table class="table table-striped mt-5 text-center border border-dark" >
  <thead class="text-dark">
    <tr >
      <th scope="col">Order Id</th>
      <th scope="col">Customer Info</th>
      <th scope="col">Products Info</th>
      <th scope="col">Status</th>
      <th scole="col">Price</th>
      <th scope="col">Change Status To Sent</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($orders as $order):{ 
    ?>
    <tr>
      <th scope="row" class="text-dark"><?=$order->id_order?></th>
      <td class="text-dark">First Name: <?=$order->first_name?></br>Last Name: <?=$order->last_name?></br>City: <?=$order->city?></br>Address: <?=$order->address?></br>Phone number: <?=$order->phone_number?></td>
      <td>
        <table class="border border-dark">
            <thead>
            <th scope="col" class="border border-dark text-dark">Product Name</th>
            <th scope="col" class="border border-dark text-dark">Quantity</th>
            <th scope="col" class="border border-dark text-dark">Piece Price</th>
            </thead>
        <tbody>
        <?php
            $products = getProductsByOrder($order->id_order);
            foreach($products as $prod):{  
        ?>
        <tr class="border border-dark text-dark">
          <td class="border border-dark text-dark"><?=$prod->brand_name.' '.$prod->product_name?></td>
          <td class="border border-dark text-dark"><?=$prod->quantity?></td>
          <td class="border border-dark text-dark"><?=$prod->discount?$prod->discount:$prod->price?> &dollar;</td>
        </tr>
      <?php
      }
        endforeach;
      ?>
              </tbody>
      </table>
      </td>
      <td class="text-dark">Pending</td>
      <td class="text-dark">Price: <?=$order->price?> &dollar;</td>
      <td><a class="sendBtn" href="logic/send_order.php?id=<?=$order->id_order?>"><i class="fa-regular fa-paper-plane"></i></a></td>
    </tr>
    <?php
    }
    endforeach;
    ?>
  </tbody>
</table>   
</div>



<?php 
    include "views/footer.php";

?>