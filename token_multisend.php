<?php 


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
$metamask = new Metamask_PHP();

$metamask->metamask_multisendToken(17,["0x263547C5d8Ac4690b524410B1bdED5a2Cf0dA1E6","0x21C07eC1623F69e8e2AA33aAe1A816Afbc94e26E"],[100,100],200,"localhost:3000?success=1","localhost:3000?error=1");