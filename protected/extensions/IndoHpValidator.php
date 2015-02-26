<?php

class IndoHpValidator extends CValidator
{

    /**
     * @var boolean whether the attribute value can be null or empty. Defaults to true,
     * meaning that if the attribute is empty, it is considered valid.
     */
    public $allowEmpty = true;

    /**
     * Validates the attribute of the object.
     * If there is any error, the error message is added to the object.
     * @param CModel $object the object being validated
     * @param string $attribute the attribute being validated
     */
    protected function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;
        if ($this->allowEmpty && ($value === null || $value === ''))
            return true;
        elseif (!$this->allowEmpty && ($value === null || $value === '')) {
            $message = $this->message !== null ? $this->message : Yii::t('yii', '{attribute} is empty');
            $this->addError($object, $attribute, $message);
        }

        //Without +
        if (preg_match('/^(\+)[\s]*(.*)$/', $value)) {
            $message = Yii::t('yii', '{attribute} without the country code, please');
            $this->addError($object, $attribute, $message);
        }

        //between 10 to 12 digits
        if (!preg_match('/^[0-9]{9,12}$/', $value)) {
            $message = Yii::t('yii', '{attribute} number should contain between 9 to 12 digits');
            $this->addError($object, $attribute, $message);
        }

        //should start from 8
        //if (!preg_match('/^8[0-9]{8,11}$/',$value)) {
        //    $message=Yii::t('yii','{attribute} should start with 8');
        //	$this->addError($object,$attribute,$message);
        //}

        //Check Prefix
        //$tnexp[1] =  '/^02079460[0-9]{3}$/';

        $tnexp[0] = '/^811[0-9]{6,9}$/'; //KartuHALO	Telkomsel
        $tnexp[1] = '/^812[0-9]{6,9}$/'; //	SimPATI, KartuHALO	Telkomsel
        $tnexp[2] = '/^813[0-9]{6,9}$/'; //	SimPATI, KartuHALO	Telkomsel
        $tnexp[3] = '/^814[0-9]{6,9}$/'; //	Indosat 3,5G Broadband	Indosat (IndosatM2)
        $tnexp[4] = '/^815[0-9]{6,9}$/'; //	Mentari, Matrix	Indosat
        $tnexp[5] = '/^816[0-9]{6,9}$/'; //	Mentari, Matrix	Indosat
        $tnexp[6] = '/^817[0-9]{6,9}$/'; //	XL Prabayar, XL Pascabayar	XL Axiata
        $tnexp[7] = '/^818[0-9]{6,9}$/'; //	XL Prabayar, XL Pascabayar	XL Axiata
        $tnexp[8] = '/^819[0-9]{6,9}$/'; //	XL Prabayar, XL Pascabayar	XL Axiata
        $tnexp[9] = '/^821[0-9]{6,9}$/'; //	SimPATI Freedom	Telkomsel
        $tnexp[10] = '/^822[0-9]{6,9}$/'; //	SimPATI (Kartu Facebook)	Telkomsel
        $tnexp[11] = '/^823[0-9]{6,9}$/'; //	Kartu As[1]	Telkomsel
        $tnexp[12] = '/^828[0-9]{6,9}$/'; //	Ceria	Sampoerna Telekom
        $tnexp[13] = '/^831[0-9]{6,9}$/'; //	Axis	AXIS Telekom Indonesia
        $tnexp[14] = '/^838[0-9]{6,9}$/'; //	Axis	AXIS Telekom Indonesia
        $tnexp[15] = '/^852[0-9]{6,9}$/'; //	Kartu As	Telkomsel
        $tnexp[16] = '/^853[0-9]{6,9}$/'; //	Kartu As (Kartu Prima)	Telkomsel
        $tnexp[17] = '/^855[0-9]{6,9}$/'; //	Matrix Auto	Indosat
        $tnexp[18] = '/^856[0-9]{6,9}$/'; //	IM3	Indosat
        $tnexp[19] = '/^857[0-9]{6,9}$/'; //	IM3	Indosat
        $tnexp[20] = '/^858[0-9]{6,9}$/'; //	Mentari	Indosat
        $tnexp[21] = '/^859[0-9]{6,9}$/'; //	XL Prabayar, XL Pascabayar	XL Axiata
        $tnexp[22] = '/^8681[0-9]{5,8}$/'; //	ByRU	PSN/ACeS
        $tnexp[23] = '/^877[0-9]{6,9}$/'; //	XL Prabayar, Hauraa	XL Axiata
        $tnexp[24] = '/^878[0-9]{6,9}$/'; //	XL Prabayar	XL Axiata
        $tnexp[25] = '/^879[0-9]{6,9}$/'; //	XL Prabayar	XL Axiata
        $tnexp[26] = '/^881[0-9]{6,9}$/'; //	smartfren	Smartfren Telecom
        $tnexp[27] = '/^882[0-9]{6,9}$/'; //	smartfren	Smartfren Telecom
        $tnexp[28] = '/^883[0-9]{6,9}$/'; //	Smartfren	Smartfren Telecom
        $tnexp[29] = '/^884[0-9]{6,9}$/'; //	Smartfren	Smartfren Telecom
        $tnexp[30] = '/^887[0-9]{6,9}$/'; //	smartfren	Smartfren Telecom
        $tnexp[31] = '/^888[0-9]{6,9}$/'; //	smartfren	Smartfren Telecom
        $tnexp[32] = '/^889[0-9]{6,9}$/'; //	smartfren	Smartfren Telecom
        $tnexp[33] = '/^896[0-9]{6,9}$/'; //	3	Hutchison Charoen Pokphand Telecom
        $tnexp[34] = '/^897[0-9]{6,9}$/'; //	3	Hutchison Charoen Pokphand Telecom
        $tnexp[35] = '/^898[0-9]{6,9}$/'; //	3	Hutchison Charoen Pokphand Telecom
        $tnexp[36] = '/^899[0-9]{6,9}$/'; //	3	Hutchison Charoen Pokphand Telecom
        $tnexp[36] = '/^21[0-9]{6,9}$/'; //	3	Hutchison Charoen Pokphand Telecom

        $valid = false;
        foreach ($tnexp as $regexp) {
            if (preg_match($regexp, $value, $matches))
                $valid = true;
        }
        if ($valid == false) {
            $message = Yii::t('yii', 'This {attribute} number is not recognized Indonesian Provider');
            $this->addError($object, $attribute, $message);
        }

    }
}

?>
