<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PeopleTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setTable('people');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }


    public function findMe(Query $query, array $options)
    {
        $me = $options['me'];
        return $query->where(['name like' => '%' . $me . '%'])
            ->orWhere(['mail like' => '%' . $me . '%'])
            ->order(['age' => 'asc']);
    }

    public function findByAge(Query $query, array $options)
    {
        return $query->order(['age' => 'asc'])->order(['name' => 'asc']);
    }


    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id', '整数で入力')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name', '文字列で入力')
            ->requirePresence('name', 'create')
            ->notEmpty('name', '必須');

        $validator->scalar('mail')
            ->scalar('mail', '文字列で入力')
            ->allowempty('mail') //
            ->email('mail', 'メールアドレスを入力');

        $validator
            ->integer('age', '整数で入力')
            ->requirePresence('age', 'create')
            ->notEmpty('age', '必須')
            ->greaterThan('age', -1, 'ゼロ以上の値を入れてください');

        return $validator;
    }
}
