<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method='post' action="http://127.0.0.1/pay/index.php">   
	<input type='hidden' name='v_mid' value="<?php echo ($pay["v_mid"]); ?>">          
	<p>订单编号:<input type='hidden' name='v_oid' value="<?php echo ($pay["v_oid"]); ?>"><?php echo ($pay["v_oid"]); ?></p>
	<p>订单总金额:<input type='hidden' name='v_amount' value="<?php echo ($pay["v_amount"]); ?>"><?php echo ($pay["v_amount"]); ?></p>
	<input type='hidden' name='v_moneytype' value="<?php echo ($pay["v_moneytype"]); ?>">             
	<input type='hidden' name='v_url' value="<?php echo ($pay["v_url"]); ?>">
	<input type='hidden' name='v_md5info' value="<?php echo ($pay["v_md5info"]); ?>"> 
	<p><input type="submit" name="" value="确定支付"></p>  
	</form>              
</body>
</html>