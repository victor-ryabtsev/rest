<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $login
 * @property string $phone
 * @property string $first_name
 * @property string $last_name
 * @property string $age
 *
 * The followings are the available model relations:
 * @property Content[] $contents
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login', 'required'),
			array('login', 'length', 'max'=>50),
			array('login', 'match', 'pattern'=>'/^[a-zA-Z0-9_]+$/'),
			array('phone', 'length', 'max'=>20),
			array('first_name, last_name', 'length', 'max'=>255),
			array('age', 'length', 'max'=>10),
		  	array('age', 'numerical', 'integerOnly' => true, 'min' => 1, 'max' => 100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, phone, first_name, last_name, age', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'contents' => array(self::HAS_MANY, 'Content', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'phone' => 'Phone',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'age' => 'Age',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('age',$this->age,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getList($sort) {
		$criteria = new CDbCriteria();
		$criteria->order = 'id ' . $sort;
		return User::model()->findAll($criteria);
	}

	public static function usersToArray($users)
	{
		$data = array();
		/**@var User $user */
		foreach ($users as $user) {
			$data[] = array(
				'id' => $user->id,
				'login' => $user->login,
				'age' => $user->age,
			);
		}

		return $data;
	}

	public static function userToArray(User $user)
	{
		$data = $user->attributes;


		return $data;
	}
}
