<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Collection\Collection;


/**
 * Post Entity.
 *
 * @property int $id
 * @property int $category_id
 * @property \App\Model\Entity\Category $category
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $author
 * @property bool $published
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Tag[] $tags
 */
class Post extends Entity
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
    /*protected $_accessible = [
        '*' => true,
        'id' => false,
    ];*/

/*******************************/
/*         MODIFICADO          */
/*******************************/    

    protected $_accessible = [
        //'*' => true,
        'category_id' => true,
        'title' => true,
        'slug' => true,
        'author' => true,
        'content' => true,
        'published' => true,
        'category' => true,
        'tags' => true,
        'tag_string' => true,
    ];




    /****************************************************************/
    /*                                                              */
    /* PEGA AS TAGS COMO UMA STRINS E DEPOIS PARTICIONA PARA SALVAR */
    /*                                                              */
    /****************************************************************/
    protected function _getTagString()
    {
        if (isset($this->_properties['tag_string'])) {
            return $this->_properties['tag_string'];
        }
        if (empty($this->tags)) {
            return '';
        }
        $tags = new Collection($this->tags);
        $str = $tags->reduce(function ($string, $tag) {
            return $string . $tag->title . ', ';
        }, '');
        return trim($str, ', ');
    }
    /*END FUNCTION _GETTAG*/




}
