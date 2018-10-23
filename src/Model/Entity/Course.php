<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Course Entity
 *
 * @property int $id
 * @property string $ApiUrl
 * @property string $KisCourseId
 * @property string $KisMode
 * @property string $Title
 * @property string $TitleInWelsh
 * @property string $PUBUKPRN
 */
class Course extends Entity
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
        'ApiUrl' => true,
        'KisCourseId' => true,
        'KisMode' => true,
        'Title' => true,
        'TitleInWelsh' => true,
        'PUBUKPRN' => true
    ];
}
