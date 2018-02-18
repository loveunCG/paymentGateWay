<!DOCTYPE html>

<head>
    <!-- <script src="<?php echo base_url(); ?>asset/js/agent/jquery.js" type="text/javascript"></script> -->
    <script src="<?php echo base_url(); ?>asset/js/agent/jquery-1.7.1.min.js" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url(); ?>asset/js/jquery-1.10.2.min.js"></script>   -->
</head>
<body>
    <input type="hidden" name="partner" id="partner" value="<?php echo $partner; ?>">
    <input type="hidden" name="banktype" id="banktype" value="<?php echo $banktype; ?>">
    <input type="hidden" name="paymoney" id="paymoney" value="<?php echo $paymoney; ?>">
    <input type="hidden" name="ordernumber" id="ordernumber" value="<?php echo $ordernumber; ?>">
    <input type="hidden" name="sysnumber" id="sysnumber" value="<?php echo $sysnumber; ?>">
    <input type="hidden" name="attach" id="attach" value="<?php echo $attach; ?>">
    <input type="hidden" name="orderstatus" id="orderstatus" value="<?php echo $orderstatus; ?>">
    <input type="hidden" name="sign" id="sign" value="<?php echo $sign; ?>">
    <input type="hidden" name="callbackurl" id="callbackurl" value="<?php echo $callbackurl; ?>">
    <input type="hidden" name="sign" id="sign" value="<?php echo $sign; ?>">
    <input type="hidden" name="url" id="url" value="<?php echo base_url(); ?>">

<script type="text/javascript">
     $(document).ready(function () {
            var partner = $('#partner').val();
            var banktype = $('#banktype').val();
            var paymoney = $('#paymoney').val();
            var ordernumber = $('#ordernumber').val();
            var sysnumber = $('#sysnumber').val();
            var attach = $('#attach').val();
            var orderstatus = $('#orderstatus').val();
            var sign = $('#sign').val();
            var callbackurl = $('#callbackurl').val();
            var url = $('#url').val();

                    $.get(callbackurl, {partner:partner, ordernumber:ordernumber,orderstatus:orderstatus,sysnumber:sysnumber,paymoney:paymoney,attach:attach,sign:sign}, function(data)  {                        
                        if (data == "ok")
                        {
                           location.href = url+"paygateway/callback?stat=ok&sysnumber="+sysnumber;                     
                        }
                        else
                        {                           
                           location.href = url+"paygateway/failed?stat=fail&sysnumber="+sysnumber;
                        }
                     } );
     });
</script>


</body>
</html>
