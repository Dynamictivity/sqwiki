<?php

# Version 1.0
# Last Updated 6/22/2009

/*
 * This example is used for Swift Mailer V4

	include "./lib/swift_required.php";
	include 'SmtpApiHeader.php';

	$hdr = new SmtpApiHeader();

	// The list of addresses this message will be sent to
	// [This list is used for sending multiple emails using just ONE request to SendGrid]
	$toList = array('destination1@example.com', 'destination2@example.com');

	// Specify the names of the recipients
	$nameList = array('Name 1', 'Name 2');

	// Used as an example of variable substitution
	$timeList = array('4 PM', '5 PM');

	// Set all of the above variables
	$hdr->addTo($toList);
	$hdr->addSubVal('-name-', $nameList);
	$hdr->addSubVal('-time-', $timeList);

	// Specify that this is an initial contact message
	$hdr->setCategory("initial");

	// You can optionally setup individual filters here, in this example, we have enabled the
	// footer filter
	$hdr->addFilterSetting('footer', 'enable', 1);
	$hdr->addFilterSetting('footer', "text/plain", "Thank you for your business");

	// The subject of your email
	$subject = 'Example SendGrid Email';

	// Where is this message coming from. For example, this message can be from
	// support@yourcompany.com, info@yourcompany.com
	$from = array('yourcompany@example.com' => 'Name Of Your Company');

	// If you do not specify a sender list above, you can specifiy the user here. If a sender
	// list IS specified above
	// This email address becomes irrelevant.
	$to = array('defaultdestination@example.com' => 'Personal Name Of Recipient');

	# Create the body of the message (a plain-text and an HTML version).
	# text is your plain-text email
	# html is your html version of the email
	# if the reciever is able to view html emails then only the html
	# email will be displayed

	// Note the variable substitution here =)
	$text = "<<<EOM
		Hello -name-,

		Thank you for your interest in our products. We have set up an appointment
		to call you at -time- EST to discuss your needs in more detail.

		Regards,
		Fred
		EOM";

	$html = "<<<EOM
		<html>
		<head></head>
		<body>
		<p>Hello -name-,<br>
		Thank you for your interest in our products. We have set up an appointment
		to call you at -time- EST to discuss your needs in more detail.

		Regards,

		Fred, How are you?<br>
		</p>
		</body>
		</html>
		EOM";

	// Your SendGrid account credentials
	$username = 'sendgridusername@yourdomain.com';
	$password = 'example';

	// Create new swift connection and authenticate
	$transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 25);
	$transport->setUsername($username);
	$transport->setPassword($password);
	$swift = Swift_Mailer::newInstance($transport);

	// Create a message (subject)
	$message = new Swift_Message($subject);

	// add SMTPAPI header to the message
	// *****IMPORTANT NOTE*****
	// SendGrid's asJSON function escapes characters. If you are using Swift Mailer's
	// PHP Mailer functions, the getTextHeader function will also escape characters.
	// This can cause the filter to be dropped.
	$headers = $message->getHeaders();
	$headers->addTextHeader('X-SMTPAPI', $hdrFasJSON());

	// attach the body of the email
	$message->setFrom($from);
	$message->setBody($html, 'text/html');
	$message->setTo($to);
	$message->addPart($text, 'text/plain');

	// send message
	if ($recipients = $swift->send($message, $failures)) {
		// This will let us know how many users received this message
		// If we specify the names in the X-SMTPAPI header, then this will always be 1.
		echo 'Message sent out to ' . $recipients . ' users';
	}
	// something went wrong =(
	else {
		echo "Something went wrong - ";
		print_r($failures);
	}
 */

class SmtpApiHeader
{
    var $data;

    function addTo($tos)
    {
        if (!isset($this->data['to'])) {
            $this->data['to'] = array();
        }
        $this->data['to'] = array_merge($this->data['to'], (array)$tos);
    }

    function addSubVal($var, $val)
    {
        if (!isset($this->data['sub'])) {
            $this->data['sub'] = array();
        }

        if (!isset($this->data['sub'][$var])) {
            $this->data['sub'][$var] = array();
        }
        $this->data['sub'][$var] = array_merge($this->data['sub'][$var], (array)$val);
    }

    function setUniqueArgs($val)
    {
        if (!is_array($val))
            return;
        // checking for associative array
        $diff = array_diff_assoc($val, array_values($val));
        if (((empty($diff)) ? false : true)) {
            $this->data['unique_args'] = $val;
        }
    }

    function setCategory($cat)
    {
        $this->data['category'] = $cat;
    }

    function addFilterSetting($filter, $setting, $value)
    {
        if (!isset($this->data['filters'])) {
            $this->data['filters'] = array();
        }

        if (!isset($this->data['filters'][$filter])) {
            $this->data['filters'][$filter] = array();
        }

        if (!isset($this->data['filters'][$filter]['settings'])) {
            $this->data['filters'][$filter]['settings'] = array();
        }
        $this->data['filters'][$filter]['settings'][$setting] = $value;
    }

    function asJSON()
    {
        $json = json_encode($this->data);
        // Add spaces so that the field can be folded
        $json = preg_replace('/(["\]}])([,:])(["\[{])/', '$1$2 $3', $json);
        return $json;
    }

    function as_string()
    {
        $json = $this->asJSON();
        $str = "X-SMTPAPI: " . wordwrap($json, 76, "\n ");
        return $str;
    }

}