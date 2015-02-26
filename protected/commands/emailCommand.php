<?php

class emailCommand extends ConsoleCommand
{

    public function actionIndex()
    {

        $connection = Yii::app()->db;
        $sqlRaw = "
			select m.conversation_id, g.email, c.subject, m.text, gg.employee_name, gg.email as email_sender, m.sender_id  from s_mailbox_message m
			inner join s_mailbox_conversation c on  c.conversation_id = m.conversation_id
			inner join s_user u on  m.recipient_id = u.id
			inner join g_person g on  g.userid = u.id
			left join s_user uu on  m.sender_id = uu.id
			left join g_person gg on  gg.userid = uu.id
			where c.bm_sent = 0 and (g.email is not null or length(g.email) <>0)
			order by g.email
		";

        //FOR TESTING ONLY
        //$sqlRaw = "
        //	select m.conversation_id, 'peterjkambey@gmail.com' as email,'test subject ' 
        //	as subject, m.text from s_mailbox_message m order by conversation_id DESC  limit 1
        //";

        $rawData = $connection->createCommand($sqlRaw)->queryAll();
        Yii::import('EmailComponent');

        foreach ($rawData as $row) {

            $subject = $row['subject'];

            $email = $row['email'];

            if ($row['sender_id'] == 1) {
            	$text = "ADMIN APHRIS";
            } else
	            $text = $row['employee_name'] . " ( " . $row['email_sender'] . " )";

            $text .= ' has send you a message with this following detail:<br/><br/><br/>';

            $text .= $row['text'];

            $body = EmailComponent::template('template002', $text);

            if (!in_array($email, require(dirname(__FILE__) . '/../config/blacklistEmail.php')) && filter_var($email, FILTER_VALIDATE_EMAIL))
                EmailComponent::sendEmail($email, $subject, $body);

            $sql2 = "UPDATE s_mailbox_conversation SET bm_sent = 1 WHERE conversation_id = " . $row['conversation_id'];
            Yii::app()->db->createCommand($sql2)->execute();
        }
    }

    public function actionResend()
    {
        //34342	
        $connection = Yii::app()->db;
        $sqlRaw = "
        	SELECT * FROM s_user_registration
        	WHERE id > 34342 and created_date is null 
        	LIMIT 1;
        
		";

        $rawData = $connection->createCommand($sqlRaw)->queryAll();
        Yii::import('EmailComponent');

        foreach ($rawData as $row) {

            $email = $row['email'];

            $headers = "From: " . Yii::app()->params['recruitmentEmail'];
            $subject = "RESEND: Agung Podomoro Land - Career. Step 2 of 4. Activate your Email";
            $link = "http://www.agungpodomoro-career.com/index.php/site/reactivation/email/" . $email . "/hash/" . $row['activation_code'];
            $body = '<html><body>';
            $body .= "
				<p>
				============================================================================================= <br/>
				Please, DO NOT send any CV or any question to this email. All incoming email will be ignored!!! <br/>
				============================================================================================= <br/>
				</p>
				<br/>
				<br/>
				
				
				<p>Dear, " . $email . "</p>
				
				<p>To activate your account on www.agungpodomoro-career.com, please choose one of two methods below.<br/>
				<br/>
				#1. click the link below, and your account will be activated instantly</p>
				<br/>
				
				<p>" . $link . "</p>
				
				<br/>
				<p>OR</p>
				<br/>
				
				<p>#2. copy or click the link below. </p>
				<br/>
				
				<p>http://www.agungpodomoro-career.com/index.php/site/activation  . On that opened page, type your email address, 
				copy and paste the code below and submit</p>				
				<br/>
				
				<p>" . $row['activation_code'] . "</p>

				<br/>
				<p>Our Privacy Policy</p>
				
				<p>
				#1. Your email address totally protected from outside party.<br/>
				#2. Your given password 100% encrypted with random salt, so same password will generated different hash.<br/>
				#3. This email is intended for email validation only.<br/> 
				#4. This validation process only valid for a month. If you didn't validate or Complete your data Profile, your registered email will be removed permanently..
				
				<br/>
				<br/>
				
				Please, DO NOT send any CV or any question to this email. We do all process via Human Resources Application System
				ALL INCOMING EMAIL WILL BE IGNORED!!! 
				</p>
				<br/>
				
				<p>We welcome you and thank you for joining on our website...<br/><br/>
				Agung Podomoro Land - Recruitment Team</p>
				
				<p>When you succesfully registered, use username dan password below to login. 
				Please, consider the security of your username dan password on this email. :<br/><br/>
				Your given username: " . $email . "<br/>
				Your given password: **has been encrypted by system** </p>
				
				
				";

            $body .= '</body></html>';


            EmailComponent::sendEmail($email, $subject, $body);

            $sql2 = "UPDATE s_user_registration SET created_date = " . time() . " WHERE id = " . $row['id'];
            Yii::app()->db->createCommand($sql2)->execute();
        }
    }

    public function actionVacancyBroadcast($id)
    { //Not widely used.. test on progress
        $modelVacancy = $this->loadModel((int)$id);

        $criteria = new CDbCriteria;
        $criteria->with = ['jobalert'];
        $criteria->compare('jobalert.specialization_id', $modelVacancy->jspecid);
        $modelApplicant = hApplicant::model()->findAll($criteria);

        if ($modelApplicant != null) {
            foreach ($modelApplicant as $mApplicant) {
                $_list[] = $mApplicant->email;
            }
        }


        if (isset($_list))
            $model->receiver = implode(", ", $_list);

        $model->subject = "Agung Podomoro Land. New Job Opening... Get it now!!!";
        $_level = (isset($modelVacancy->level)) ? $modelVacancy->level->name : '';
        $model->body = '<html><body>';
        $model->body .= "
		<p>Dear, |applicant_name| </p>
		
		<p>We have just open a new job that we think might be applicable to you. Here the criteria: </p>
		
		Title: " . $modelVacancy->vacancy_title . "<br/>
		For Company: " . $modelVacancy->company_name . "<br/>
		Level: " . $_level . "<br/>
		Specialization: " . $modelVacancy->spec->name . "<br/>
		Work Address: " . $modelVacancy->work_address . "<br/>
		Work Area: " . $modelVacancy->work_area . "<br/>
		Min. Working Experience: " . $modelVacancy->min_work_exp . "<br/>
		Skill Required: " . $modelVacancy->skill_required . "<br/>
		<br/>
		
		<p>Click the link below, for more information and applying job. <br/>
		http://career.agungpodomoro-aphris.com/vacancy/" . $modelVacancy->id . " </p>
		
		<p>Thank You for your attention. </p>
		
		<br/>
		<br/>
		<p>Recruitment Administrator <br/>
		recruitment@agungpodomoro.com</p>";
        $model->body .= "</body></html>";

        foreach ($modelApplicant as $applicant) {
            $model->body = str_replace('|applicant_name|', $applicant->applicant_name, $model->body);
            EmailComponent::sendEmail($applicant->email, $model->subject, $model->body, 'ssl');
        }
    }

    public function actionBroadcastCareer($id)
    {

        $connection = Yii::app()->db;
        $sqlRaw = "
			select * from s_email_broadcast where id = ".$id
		;

        $rawData = $connection->createCommand($sqlRaw)->queryRow();
        Yii::import('EmailComponent');

        $subject = $rawData['subject_email'];
        $text = $rawData['email_content'];

        $emails = explode(",",$rawData['receiver_list']);
        //$emails[] = "peter@agungpodomoro.com";

        foreach ($emails as $email) {
            $body = EmailComponent::template('template004', $text);

            if (!in_array($email, require(dirname(__FILE__) . '/../config/blacklistEmail.php')) && filter_var($email, FILTER_VALIDATE_EMAIL))
                EmailComponent::sendEmail($email, $subject, $body);
        }
    }

    public function actionBroadcastBirthdayDepartment()
    {

        $connection = Yii::app()->db;
        $sqlRaw = "
			SELECT * FROM g_bi_person_lite 
			WHERE month(birth_date) = ".date('n')." and day(birth_date) = ".date('j')."
			AND employee_status NOT IN ('Resign','Termination','Black List','End of Contract');
		";

        $rawData = $connection->createCommand($sqlRaw)->queryAll();
        Yii::import('EmailComponent');

        $subject = 'Birthday Info on your Department';

        foreach ($rawData as $row) {
	
	        $sqlRaw2 = "
				SELECT * FROM g_bi_person_lite 
				WHERE id != ".$row['id']." 
				  AND company_id = ".$row['company_id']." 
				  AND department = '".$row['department']."' 
				  AND employee_status NOT IN ('Resign','Termination','BlackList','End of Contract')
				  AND email IS NOT NULL;
			";
	        $rawData2 = $connection->createCommand($sqlRaw2)->queryAll();

	        foreach ($rawData2 as $row2) {

		        $text = '
					<p>Dear, '.$row2["employee_name"].' </p>
					
					<p>Did you know!</p>
					<br/>
					that '.$row["employee_name"].' is birthday today? <br/>
					call or SMS  at '.$row["handphone"].'
										
					<p>Have a nice day. </p>

		        ';

	            $body = EmailComponent::template('template002', $text);

	            if (!in_array($row2["email"], require(dirname(__FILE__) . '/../config/blacklistEmail.php')) && filter_var($row2["email"], FILTER_VALIDATE_EMAIL))
	                EmailComponent::sendEmail($row2["email"], $subject, $body);
	        }
        }
    }

    public function actionBroadcastBirthday()
    {

        $connection = Yii::app()->db;
        $sqlRaw = "
			SELECT * FROM g_bi_person_lite 
			WHERE month(birth_date) = ".date('n')." and day(birth_date) = ".date('j')."
			AND employee_status NOT IN ('Resign','Termination','Black List','End of Contract');
		";

        $rawData = $connection->createCommand($sqlRaw)->queryAll();
        Yii::import('EmailComponent');

        $subject = 'Happy Birthday!! '$row["employee_name"];

        foreach ($rawData as $row) {

		        $text = '
					<p>Dear, '.$row["employee_name"].' </p>
					
					<p>HAPPY BIRTHDAY!</p>
					<br/>
					You are a wonderful source of joy… <br/>
					May your special day bring you an extra share of everything which makes you the happiest in the world. <br/>
					Happy Birthday Dear Employee.

					<p>Best wishes on your birthday</p>

		        ';

	            $body = EmailComponent::template('template002', $text);

	            if (!in_array($row2["email"], require(dirname(__FILE__) . '/../config/blacklistEmail.php')) && filter_var($row2["email"], FILTER_VALIDATE_EMAIL))
	                EmailComponent::sendEmail($row2["email"], $subject, $body);
        }
    }

}
