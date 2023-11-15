<?php       
        $servername = "localhost";
        $username = "root"; //Your Db Username, here using the def. root
        $password = ""; //Your Db Password
        $dbname = "***"; //Your Db Name
        $countorder = 0; //Order counter

        $conn = mysqli_connect($servername,$username,$password,$dbname);

        if(!$conn){
                die("connection failed: " . mysqli_connect_error());     
        }
              
        $query = "SELECT * FROM wp_wc_order_addresses LEFT JOIN wp_woocommerce_order_items ON wp_wc_order_addresses.order_id = wp_woocommerce_order_items.order_id";
        $userdata = mysqli_query($conn, $query);
        
        $list = array();
        $list[0] = array("ORDER ID, ADDRESS TYPE, NAME, SURNAME, COMPANY, ADDRESS 1, ADDRESS 2, CITY, STATE, POSTAL CODE, COUNTRY, PHONE, EMAIL");

        if(mysqli_num_rows($userdata) > 0){
                while($row = mysqli_fetch_assoc($userdata)){
                        $countorder++;
                        $list[$countorder + 1] = array($row["order_id"], $row["address_type"], $row["first_name"], $row["last_name"], $row["company"], $row["address_1"], $row["address_2"], $row["city"], $row["state"], $row["postcode"], $row["country"], $row["phone"], $row["email"]);
                        echo "<br> -- ORDER " . $countorder . " -- <br>";
                        echo "order id: ". $row["order_id"]. " - Address Type: " . $row["address_type"] . " - Name: " . $row["first_name"] . " - Surname: " . $row["last_name"] . " - Company: ". $row["company"] . " - Address 1: " . $row["address_1"] . " - Address 2: " . $row["address_2"] . " - City: " . $row["city"] . " - State: " . $row["state"] . " - Postal Code: " . $row["postcode"] . " - Country: " . $row["country"] . " - Phone: " . $row["phone"] . " - Email: " . $row["email"] . " - ITEM ORDINATO: " . $row["order_item_name"] . "<br>" ; 
                        }
        } else {
                echo "0 results";
        }

        $fp = fopen('file.csv', 'w');

        foreach($list as $fields){
                fputcsv($fp, $fields);
        }

        fclose($fp);

        mysqli_close($conn);
?>
