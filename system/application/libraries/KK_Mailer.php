<?php
	require_once('PHPMailer_v5.1/class.phpmailer.php');
	
	class KK_Mailer {
		
		
		
		
// 			$option = array(
// 				'to' => 'chepy.v@gmail.com',
// 				'from' => 'kiwiguo.net@gmail.com',
// 				'from_name' => '「奇异果」',
// 				'subject' => '默认主题',
// 				'body' => '默认的邮件内容',
// 				'reply_to' => array(
// 					array( 'kiwiguo.net@gmail.com', '「奇异果」' ),
// 					array( 'chepy.v@gmail.com', 'Mr Kelly' ),
// 				),
// 			);	
		function send_mail( $option = array('subject'=>'custom') ) {
			
			$default = array(
				'to' => array(
					array( 'chepy.v@gmail.com', 'Mrkelly'),
				),
				'from' => 'kiwiguo.net@gmail.com',
				'from_name' => '「奇异果」',
				'subject' => '默认主题',
				'body' => '默认的邮件内容',
				'reply_to' => array(
					array( 'bnu.sife@gmail.com', '北师珠赛扶' ),
					//array( 'chepy.v@gmail.com', 'Mr Kelly' ),
				),
			);
			
			$option += $default ; // 合並默認， 沒聲明設置的， 采用默認值
			
			
			$mail = new PHPMailer();
			
			$mail->CharSet = "UTF-8";
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'ssl';
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 465;
			
			$mail->Username = 'kiwiguo.net@gmail.com';
			$mail->Password = '23110388';
			
			$mail->From = $option['from'];
			$mail->FromName = $option['from_name'];
			$mail->Subject = $option['subject'];
			
			$mail->AltBody = 'AltBody';
			
			$mail->MsgHTML( $option['body'] );
			
			// reply_to是一个数组，包含回复多人
			foreach ( $option['reply_to'] as $reply_to ) {
				$mail->AddReplyTo( $reply_to[0] , $reply_to[1] );
			}
			
			//$mail->AddAttachment("/path/to/file.zip");             // attachment
			//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment
			
			// to也是一个数组,多人
			foreach( $option['to'] as $to ) {
				$mail->AddAddress( $to[0], $to[1] );
			}
			
			//$mail->AddAddress( $option['to'] );
			
			$mail->IsHTML( true );
			
			if(!$mail->Send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
				return true;
			}
			
		}
	}