<?php

/**
 * This form is used to insert or edit posts, either in a new thread, or in
 * an existing one, depending on the model's current thread_id
 */

/**
 * The following fields are availabe:
 * @property integer $thread_id
 * @property string $subject Read-only if thread_id<>null
 * @property string $content
 */
class PostForm extends CFormModel
{

    public $thread_id;
    public $subject;
    public $content;
    public $lockthread;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['subject', 'required', 'on' => 'create'],
            ['subject', 'length', 'max' => 120],
            ['content', 'required'],
            ['lockthread', 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'subject' => 'Subject',
            'content' => 'Content',
            'lockthread' => 'Lock thread?',
        ]);
    }

}
