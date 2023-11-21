<?php
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "wordpress";
        $countorder = 0;
        $csvheader = 'order_id,address_type,first_name,last_name,company,address_1,address_2,city,state,postcode,country,phone,email';

        $conn = mysqli_connect($servername,$username,$password,$dbname);
        
        if(!$conn){
                die("connection failed: " . mysqli_connect_error());     
        }
              
        $query = "SELECT i.order_id, a.address_type, a.first_name, a.last_name, a.company, a.address_1, a.address_2, a.city, a.postcode, a.state, a.phone, a.email, i.order_item_type, rp.product_id, rp.variation_id, rp.customer_id, rp.date_created, rp.product_qty, rp.product_net_revenue, rp.product_gross_revenue, rp.coupon_amount, rp.tax_amount, rp.shipping_amount, rp.shipping_tax_amount FROM wp_wc_order_addresses a LEFT JOIN wp_woocommerce_order_items i ON i.order_id = a.order_id LEFT JOIN wp_wc_order_product_lookup rp ON i.order_item_id=rp.order_item_id";
        $userdata = mysqli_query($conn, $query);
        
        $list = array();
        $list[0] = array('order_id','address_type','first_name','last_name','company','address_1','address_2','city','state','postcode','country','phone','email');

        if(mysqli_num_rows($userdata) > 0){
                while($row = mysqli_fetch_assoc($userdata)){
                        $countorder++;
                        $list[$countorder + 1] = array($row["order_id"], $row["address_type"], $row["first_name"], $row["last_name"], $row["company"], $row["address_1"], $row["address_2"], $row["city"], $row["state"], $row["postcode"], $row["phone"], $row["email"], $row["order_item_type"], $row["product_id"], $row["variation_id"], $row["customer_id"], $row["date_created"], $row["product_qty"], $row["product_net_revenue"], $row["product_gross_revenue"], $row["coupon_amount"], $row["tax_amount"], $row["shipping_amount"], $row["shipping_tax_amount"]);
                }
        } else {
                echo "0 results";
        }

        echo "<h2>Done!</h2><br>";

        $fp = fopen('file.csv', 'w');

        foreach($list as $fields){
                fputcsv($fp, $fields);
        }

        fclose($fp);

        mysqli_close($conn);
?>
