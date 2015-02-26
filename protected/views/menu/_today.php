<div style="border: 1px #D5D5D5;border-bottom-style: solid;padding:3px 0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="fa fa-bars fa-fw"></i><?php echo Yii::t('basic', ' Happening TODAY') ?></li>
    </ul>
</div>

<div style="overflow: hidden;">
    <div style="min-height: 300px;max-height: 300px;overflow-y: auto;">

        <?php
        $dependency = new CDbCacheDependency('SELECT MAX(created_date) FROM g_permission');
        if (!Yii::app()->cache->get('birthday' . Yii::app()->user->id)) {
            $sql = '
		SELECT t.id,t.employee_name,"on birthday" as type,  
        (select 
                `o`.`name` AS `name`
            from
                (`g_person_career` `c`
                left join `a_organization` `o` ON ((`o`.`id` = `c`.`department_id`)))
            where
                ((`t`.`id` = `c`.`parent_id`)
                    and (`c`.`status_id` NOT in (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ')))
            order by `c`.`start_date` desc
            limit 1) AS `department`

		FROM `g_person` `t`

		WHERE (((select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN 
		(' . implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')) 
		AND ((select status_id from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) NOT IN (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . '
		))) 
		AND (date(CONCAT(year(now()),"-",month(birth_date),"-",day(birth_date))) = curdate()) 
		
		UNION ALL

		SELECT  
		`person`.`id` AS `t1_c0`, `person`.`employee_name` AS `t1_c3`,"on leave",
        (select 
                `o`.`name` AS `name`
            from
                (`g_person_career` `c`
                left join `a_organization` `o` ON ((`o`.`id` = `c`.`department_id`)))
            where
                ((`person`.`id` = `c`.`parent_id`)
                    and (`c`.`status_id` NOT in (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ')))
            order by `c`.`start_date` desc
            limit 1) AS `department`

		FROM `g_leave` `t` 
		LEFT OUTER JOIN `g_person` `person` ON (`t`.`parent_id`=`person`.`id`) 
		WHERE approved_id = 2  AND 
		CURDATE() BETWEEN start_date AND end_date AND 
		(((select c.company_id from g_person_career c WHERE person.id=c.parent_id AND c.status_id IN 
		(' . implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')) 
		AND ((select status_id from g_person_status s where s.parent_id = person.id ORDER BY start_date DESC LIMIT 1) NOT IN (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . '
		))) 

		GROUP BY employee_name		

		UNION ALL

		SELECT  
		`person`.`id` AS `t1_c0`, `person`.`employee_name` AS `t1_c3`,"on permission",
        (select 
                `o`.`name` AS `name`
            from
                (`g_person_career` `c`
                left join `a_organization` `o` ON ((`o`.`id` = `c`.`department_id`)))
            where
                ((`person`.`id` = `c`.`parent_id`)
                    and (`c`.`status_id` NOT in (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ')))
            order by `c`.`start_date` desc
            limit 1) AS `department`

		FROM `g_permission` `t` 
		LEFT OUTER JOIN `g_person` `person` ON (`t`.`parent_id`=`person`.`id`) 
		WHERE approved_id = 2  AND 
		CURDATE() BETWEEN date(start_date) AND date(end_date) AND 
		(((select c.company_id from g_person_career c WHERE person.id=c.parent_id AND c.status_id IN 
		(' . implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')) 
		AND ((select status_id from g_person_status s where s.parent_id = person.id ORDER BY start_date DESC LIMIT 1) NOT IN (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . '
		))) 

		GROUP BY employee_name		

        UNION ALL

        SELECT  
        `person`.`id` AS `t1_c0`, `person`.`employee_name` AS `t1_c3`,"not clock in",
        (select 
                `o`.`name` AS `name`
            from
                (`g_person_career` `c`
                left join `a_organization` `o` ON ((`o`.`id` = `c`.`department_id`)))
            where
                ((`person`.`id` = `c`.`parent_id`)
                    and (`c`.`status_id` NOT in (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . ')))
            order by `c`.`start_date` desc
            limit 1) AS `department`

        FROM `g_attendance` `t` 
        LEFT OUTER JOIN `g_person` `person` ON (`t`.`parent_id`=`person`.`id`) 
        WHERE CURDATE() BETWEEN date(t.cdate) AND date(t.cdate) AND t.`in` IS NULL AND 
        (((select c.company_id from g_person_career c WHERE person.id=c.parent_id AND c.status_id IN 
        (' . implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')) 
        AND ((select status_id from g_person_status s where s.parent_id = person.id ORDER BY start_date DESC LIMIT 1) NOT IN (' . implode(",", Yii::app()->getModule("m1")->PARAM_RESIGN_ARRAY) . '
        ))) 

        GROUP BY employee_name      

		';

            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $rows = $command->queryAll();

            Yii::app()->cache->set('birthday' . Yii::app()->user->id, $rows, 3600, $dependency);
        } else
            $rows = Yii::app()->cache->get('birthday' . Yii::app()->user->id);
        ?>

        <?php
        foreach ($rows as $notifica) {
            echo CHtml::openTag('div', ['class' => 'media', 'style' => 'margin-top:0;']);
            echo CHtml::openTag('p', ['class' => 'pull-left', 'style' => 'width:40px']);
            //echo $notifica->photoPath;
            echo CHtml::closeTag('p');

            echo CHtml::openTag('div', ['class' => 'media-body']);
            echo CHtml::openTag('p', ['class' => 'media-heading']);
            echo CHtml::link(strtoupper($notifica["employee_name"]) . ' ', Yii::app()->createUrl('/m1/gPerson/view', ['id' => $notifica["id"]]));
            echo '<br/>';
            echo CHtml::tag('strong', ['style' => 'font-size:11px;'], $notifica["department"]) . ' ';
            echo CHtml::tag('i', ['style' => 'color:grey;font-size:11px; margin-bottom:10px;'], ' ' . $notifica["type"]);
            echo CHtml::closeTag('p');
            echo CHtml::closeTag('div');
            echo CHtml::closeTag('div');
        }
        ?>

    </div>
</div>
<br/>


