<?php



/*  
Metamask ETH Library for PHP
Written By: Shreyak Chakraborty

Note:- Web3 JS needs to be included in the page before calling functions from this library
*/


class Metamask_PHP
{

    // Login via Metamask (PENDING)
    public function metamask_login()
    {
        
    }


    // Send ETH transaction via Metamask
    public function metamask_sendTransacton($reciever_address,$amount,$successUrl,$errorUrl)
    {
        ?>
        <script>
            // await ethereum.enable();
            
            var web3js = new Web3(web3.currentProvider);
        
            
            window.addEventListener('load', async () => {
                // Modern dapp browsers...
                if (window.ethereum) {
                    try {
                        await ethereum.enable();
                    
                        transaction = ({
                            from: web3js.givenProvider.selectedAddress,
                            to: "<?=$reciever_address?>",
                            value: web3js.utils.toWei("<?=$amount?>", "ether")
                        });
                        // console.log(transaction);
                        web3js.eth.sendTransaction(transaction).then(function(result){
                          location.href="<?=$successUrl?>&txhash="+result.transactionHash+"&amount=<?=$amount?>";
                        //   $.post( "<?=$successUrl?>", { txhash: result.transactionHash, amount: <?=$amount?> } );
                        })
                        .catch(function(error) {
                          console.error(error);
                          alert("Transaction ERROR:"+error.message);
                          location.href="<?=$errorUrl?>";
                        });

                    } catch (error) {
                        // User denied account access...
                        alert("Intitalization ERROR!");
                    }
                }
                // Legacy dapp browsers...
                else if (window.web3) {
                
                    transaction = ({
                        from: web3js.givenProvider.selectedAddress,
                        to: "<?=$reciever_address?>",
                        value: web3js.utils.toWei("<?=$amount?>", "ether")
                    });
                    console.log(transaction);
                }
                // Non-dapp browsers...
                else {
                    alert('Non-Ethereum browser detected. You should consider trying MetaMask!');
                }
            });
        
        
            </script>
        <?php
    }


     // Send different token amounts from connected Metamask account to other accounts
    public function metamask_multisendToken($decimalPlaces = 18,$recievers,$amounts,$successUrl,$errorUrl)
    {
        $totalAmount = array_sum($amounts)*pow(10,$decimalPlaces);

        $amounts = implode(",",$amounts);
        $recievers = implode(",",$recievers);
        ?>
       
            <script>
            var web3js = new Web3(web3.currentProvider);
            var decimal_places = <?=$decimalPlaces?>;
            var contractAddress = "0xfd5deef39a03c550e772346e2fa05a1c386ea180";
            var AbiOfContract = [{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"},{"name":"_extraData","type":"bytes"}],"name":"approveAndCall","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"p","type":"uint256"}],"name":"changePrice","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"supp","type":"uint256"}],"name":"increaseSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address[]"},{"name":"_value","type":"uint256[]"},{"name":"totalAmount","type":"uint256"}],"name":"multisendToken","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_from","type":"address"},{"indexed":true,"name":"_to","type":"address"},{"indexed":false,"name":"_value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_owner","type":"address"},{"indexed":true,"name":"_spender","type":"address"},{"indexed":false,"name":"_value","type":"uint256"}],"name":"Approval","type":"event"},{"constant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"payable":true,"stateMutability":"payable","type":"fallback"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"constant":true,"inputs":[{"name":"_owner","type":"address"},{"name":"_spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"fundsWallet","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalEthInWei","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"unitsOneEthCanBuy","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"version","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"}]
   
            // convert amounts to Wei
            var amounts_str = "<?=$amounts?>";
            var mainAmount = 0.0;
            var amounts = amounts_str.split(",");
            for (var i =0;i < amounts.length;i++) {
                amounts[i] = (amounts[i] * Math.pow(10,decimal_places)).toString();
            }
           
   
            // generate address array
            var addrs_str = "<?=$recievers?>";
            var addrs = addrs_str.split(",");
           
           
            window.addEventListener('load', async () => {
   
                var contractInstance = new web3js.eth.Contract(AbiOfContract);
                var getData = contractInstance.methods.multisendToken(addrs,amounts,<?=$totalAmount?>).encodeABI();
                // console.log(getData);
   
                // Modern dapp browsers...
                if (window.ethereum) {
                    try {
                        await ethereum.enable();
   
                        transaction = ({
                            from: web3js.givenProvider.selectedAddress,
                            to: contractAddress,
                            data: getData,
                            value: 0
                        });
                        // console.log(transaction);
                         web3js.eth.sendTransaction(transaction)
                        .on('transactionHash', function(hash){
                          location.href = "<?php echo $successUrl;?>&txhash="+hash;
                        });
                        
   
                    } catch (error) {
                       // alert("WEB3 intitalization. Page will reload automatically.");
                        // location.reload();
                    }
                }
                // Legacy dapp browsers...
                else if (window.web3) {
               
                    transaction = ({
                        from: web3js.givenProvider.selectedAddress,
                        to: contractAddress,
                        data: getData,
                        value: web3js.utils.toWei(mainAmount, "ether")
                    });
                    console.log(transaction);
                }
                // Non-dapp browsers...
                else {
                    alert('Non-Ethereum browser detected. You should consider trying MetaMask!');
                }
            });
       
       
            </script>
     
        <?php
    }
}
