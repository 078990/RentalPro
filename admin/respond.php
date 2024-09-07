<?php
namespace AfricasTalking\SDK\Tests;
// Include Twilio's PHP helper library (adjust the path if necessary)
  // Ensure this path is correct

// Place the use statement at the top, right after the require/include statements


// Database connection
$con = mysqli_connect("localhost", "root", "", "company");

// Check if client ID is passed via URL



use AfricasTalking\SDK\AfricasTalking;
use GuzzleHttp\Exception\GuzzleException;

class SMSTest extends \PHPUnit\Framework\TestCase
{
	public function setUp(): void
	{
		$this->names = Fixtures::$name;
		$this->apiKey 	= Fixtures::$apiKey;

		$at 			= new AfricasTalking($this->username, $this->apiKey);

		$this->client 	   = $at->sms();
        $this->tokenClient = $at->token();
	}

	public function testSMSWithEmptyMessage()
	{
        $response = $this->client->send([
            'to' 		=> Fixtures::$multiplePhoneSMS,
        ]);

        $this->assertArrayHasKey('status',$response);
        $this->assertEquals('error',$response['status']);
	}

	public function testSMSWithEmptyRecipient()
	{
        $response = $this->client->send([
            'message' 	=> 'Testing...'
        ]);

        $this->assertArrayHasKey('status',$response);
        $this->assertEquals('error',$response['status']);
	}

	public function testSingleSMSSending()
	{
		$response = $this->client->send([
			'to' 		=> Fixtures::$phone, 
			'message' 	=> 'Testing SMS...'
		]);

		$this->assertObjectHasAttribute('SMSMessageData', $response['data']);
	}

	public function testMultipleSMSSending()
	{
		$response = $this->client->send([
			'to' 		=> Fixtures::$multiplePhoneSMS, 
			'message' 	=> 'Testing multiple sending...'
		]);

		$this->assertObjectHasAttribute('SMSMessageData', $response['data']);
	}

	public function testSMSSendingWithShortcode()
	{
		$response = $this->client->send([
			'to' 		=> Fixtures::$multiplePhonesSMS, 
			'message' 	=> 'Testing with short code...',
			'from'		=> Fixtures::$shortCode
		]);

		$this->assertObjectHasAttribute('SMSMessageData', $response['data']);
	}

	public function testSMSSendingWithAlphanumeric()
	{
		$response = $this->client->send([
			'to' 		=> Fixtures::$multiplePhonesSMS, 
			'message' 	=> 'Testing with AlphaNumeric...',
			'from'		=> Fixtures::$alphanumeric
		]);

		$this->assertObjectHasAttribute('SMSMessageData', $response['data']);
	}

	public function testPremiumSMSSending()
	{
		$response = $this->client->sendPremium([
			'to' 		=> Fixtures::$multiplePhoneNumbersSMS, 
			'linkId'	=> 'messageLinkId',
			'keyword'	=> Fixtures::$keyword,
			'from'		=> Fixtures::$shortCode,
			'message' 	=> 'Testing Premium...'
		]);

		$this->assertObjectHasAttribute('SMSMessageData', $response['data']);
	}

	public function testFetchMessages()
	{
		$response = $this->client->fetchMessages(['lastReceivedId' => '8796']);

		$this->assertObjectHasAttribute('SMSMessageData', $response['data']);
	}

	public function testCreateSubscription()
	{
        $checkoutTokenResponse = $this->tokenClient->createCheckoutToken([
            'phone' => Fixtures::$phone
        ]);
		$response = $this->client->createSubscription([
			'phone' 	=> Fixtures::$phone,
			'shortCode'		=> Fixtures::$shortCode,
			'keyword'		=> Fixtures::$keyword,
            'checkoutToken' => $checkoutTokenResponse['data']->token
		]);

        $this->assertArrayHasKey('status',$response);
        $this->assertEquals('success',$response['status']);
	}

	public function testDeleteSubscription()
	{
		$response = $this->client->deleteSubscription([
			'phone' 	=> Fixtures::$phone, 
			'shortCode'		=> Fixtures::$shortCode,
			'keyword'		=> Fixtures::$keyword
		]);

		$this->assertArrayHasKey('status',$response);
		$this->assertEquals('success',$response['status']);
	}

	public function testFetchSubscriptions()
	{
		$response = $this->client->fetchSubscriptions([
			'shortCode'		=> Fixtures::$shortCode,
			'keyword'		=> Fixtures::$keyword
		]);

		$this->assertObjectHasAttribute('responses', $response['data']);
	}
}


//
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respond to Client</title>
</head>

<body>
    <h1>Send SMS to <?php echo $client['names']; ?></h1>

    <form action="" method="POST">
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $client['phone']; ?>" disabled><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="5" cols="40" required></textarea><br><br>

        <button type="submit" name="send_sms">Send SMS</button>
    </form>
</body>

</html>
