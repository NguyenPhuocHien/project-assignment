<?php
	require_once __DIR__ . '/vendor/autoload.php';
	use PhpAmqpLib\Connection\AMQPStreamConnection;
	use PhpAmqpLib\Message\AMQPMessage;

	if( $_POST["data"] )
  	{
     		echo "You want to send message : ". $_POST['data']. "<br />";
		$data=$_POST["data"];      

  	}

	
	$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
	$channel = $connection->channel();
	$channel->queue_declare('hello', false, false, false, false);
	
	

	$msg = new AMQPMessage("$data");
	
	
	
	$channel->basic_publish($msg, '', 'hello');
	
	
	echo $msg->body;
	
	$channel->close();
	$connection->close();
?>

