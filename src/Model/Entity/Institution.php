<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Institution Entity
 *
 * @property int $id
 * @property string $APROutcome
 * @property string $ApiUrl
 * @property string $Country
 * @property string $Name
 * @property string $NumberOfCourses
 * @property string $PUBUKPRN
 * @property string $PUBUKPRNCountry
 * @property string $QAAReportUrl
 * @property string $SortableName
 * @property string $StudentUnionUrl
 * @property string $StudentUnionUrlWales
 * @property string $TEFOutcome
 * @property string $UKPRN
 */
class Institution extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'APROutcome' => true,
        'ApiUrl' => true,
        'Country' => true,
        'Name' => true,
        'NumberOfCourses' => true,
        'PUBUKPRN' => true,
        'PUBUKPRNCountry' => true,
        'QAAReportUrl' => true,
        'SortableName' => true,
        'StudentUnionUrl' => true,
        'StudentUnionUrlWales' => true,
        'TEFOutcome' => true,
        'UKPRN' => true
    ];
}
