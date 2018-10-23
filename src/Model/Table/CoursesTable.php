<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Courses Model
 *
 * @method \App\Model\Entity\Course get($primaryKey, $options = [])
 * @method \App\Model\Entity\Course newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Course[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Course|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Course|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Course patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Course[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Course findOrCreate($search, callable $callback = null, $options = [])
 */
class CoursesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('courses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('ApiUrl')
            ->maxLength('ApiUrl', 500)
            ->allowEmpty('ApiUrl');

        $validator
            ->scalar('KisCourseId')
            ->maxLength('KisCourseId', 500)
            ->allowEmpty('KisCourseId');

        $validator
            ->scalar('KisMode')
            ->maxLength('KisMode', 500)
            ->allowEmpty('KisMode');

        $validator
            ->scalar('Title')
            ->maxLength('Title', 500)
            ->allowEmpty('Title');

        $validator
            ->scalar('TitleInWelsh')
            ->maxLength('TitleInWelsh', 500)
            ->allowEmpty('TitleInWelsh');

        $validator
            ->scalar('PUBUKPRN')
            ->maxLength('PUBUKPRN', 500)
            ->allowEmpty('PUBUKPRN');

        return $validator;
    }
}
