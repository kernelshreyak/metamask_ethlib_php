<?php



// Web3 Test from PHP


include "metamask_ethlib.php";

?>


<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>ETH Web3 Test</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.34/dist/web3.min.js"></script>
        <script src="./metamask_ethlib.js"></script>

    </head>

    <body>

    <?php

        if(isset($_POST['txsend'])){
            
            $address = $_POST['address'];
            $eth_amount = floatval($_POST['amount']);
            echo "Sending transaction via metamask....<br>Address:address and Amount:$eth_amount";
            
            $metamask = new Metamask_PHP();
            $metamask->metamask_sendTransacton($address,$eth_amount,"https://bitbizsolutions.com/metamask_api/test.php?success=1",
            "https://bitbizsolutions.com/metamask_api/test.php?error=1");
        }
        elseif(isset($_GET['success'])){
            echo "<h3>Transaction Successful!</h3>";
            echo "<br><br>Amount:$_REQUEST[amount]<br>Hash:$_REQUEST[txhash]";
        }
        elseif(isset($_GET['error'])){
            echo "<h3>Transaction ERROR!</h3>";
        }
        else{
            $address = "0x5025d2B5e31deeDe1184163aD6813f4A22747BC5";
            $eth_amount = 1.8;

            ?>
            <h3>Send Transaction via Metamask. Select address and amount (ETH) and click on send transaction</h3><br>
            <form action="" method="post">
                Send To:<input type="text" name="address" value="<?=$address?>"><br>
                Amount:<input type="amount" name="amount" value="<?=$eth_amount?>">
                <br><br>
                <button type=submit name=txsend>Send Transaction</button>
            </form>
            <?php
        }
        
        
        
    ?>
    </body>
</html>