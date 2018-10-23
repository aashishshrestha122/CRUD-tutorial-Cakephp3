<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Institution Model
 *
 * @method \App\Model\Entity\Institution get($primaryKey, $options = [])
 * @method \App\Model\Entity\Institution newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Institution[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Institution|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Institution|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Institution patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Institution[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Institution findOrCreate($search, callable $callback = null, $options = [])
 */
class InstitutionTable extends Table
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

        $this->setTable('institution');
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
            ->scalar('APROutcome')
            ->maxLength('APROutcome', 255)
            ->requirePresence('APROutcome', 'create')
            ->notEmpty('APROutcome');

        $validator
            ->scalar('ApiUrl')
            ->maxLength('ApiUrl', 255)
            ->requirePresence('ApiUrl', 'create')
            ->notEmpty('ApiUrl');

        $validator
            ->scalar('Country')
            ->maxLength('Country', 255)
            ->requirePresence('Country', 'create')
            ->notEmpty('Country');

        $validator
            ->scalar('Name')
            ->maxLength('Name', 255)
            ->requirePresence('Name', 'create')
            ->notEmpty('Name');

        $validator
            ->scalar('NumberOfCourses')
            ->maxLength('NumberOfCourses', 255)
            ->requirePresence('NumberOfCourses', 'create')
            ->notEmpty('NumberOfCourses');

        $validator
            ->scalar('PUBUKPRN')
            ->maxLength('PUBUKPRN', 255)
            ->requirePresence('PUBUKPRN', 'create')
            ->notEmpty('PUBUKPRN');

        $validator
            ->scalar('PUBUKPRNCountry')
            ->maxLength('PUBUKPRNCountry', 255)
            ->requirePresence('PUBUKPRNCountry', 'create')
            ->notEmpty('PUBUKPRNCountry');

        $validator
            ->scalar('QAAReportUrl')
            ->maxLength('QAAReportUrl', 255)
            ->requirePresence('QAAReportUrl', 'create')
            ->notEmpty('QAAReportUrl');

        $validator
            ->scalar('SortableName')
            ->maxLength('SortableName', 255)
            ->requirePresence('SortableName', 'create')
            ->notEmpty('SortableName');

        $validator
            ->scalar('StudentUnionUrl')
            ->maxLength('StudentUnionUrl', 255)
            ->requirePresence('StudentUnionUrl', 'create')
            ->notEmpty('StudentUnionUrl');

        $validator
            ->scalar('StudentUnionUrlWales')
            ->maxLength('StudentUnionUrlWales', 255)
            ->requirePresence('StudentUnionUrlWales', 'create')
            ->notEmpty('StudentUnionUrlWales');

        $validator
            ->scalar('TEFOutcome')
            ->maxLength('TEFOutcome', 255)
            ->requirePresence('TEFOutcome', 'create')
            ->notEmpty('TEFOutcome');

        $validator
            ->scalar('UKPRN')
            ->maxLength('UKPRN', 255)
            ->requirePresence('UKPRN', 'create')
            ->notEmpty('UKPRN');

        return $validator;
    }
}
