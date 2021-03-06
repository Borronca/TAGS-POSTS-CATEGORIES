<?php
namespace App\Model\Table;

use App\Model\Entity\Post;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Categories
 * @property \Cake\ORM\Association\BelongsToMany $Tags
 */
class PostsTable extends Table
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

        $this->table('posts');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'post_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'posts_tags'
        ]);
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

        $validator
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->requirePresence('author', 'create')
            ->notEmpty('author');

        $validator
            ->boolean('published')
            ->requirePresence('published', 'create')
            ->notEmpty('published');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['category_id'], 'Categories'));
        return $rules;
    }


    /**************************************************************/
    /*                                                            */
    /*   ADICIONADO function para CONTROLAR O SLUG POR TAGS       */
    /*                                                            */
    /**************************************************************/
    public function findTagged(Query $query, array $options)
    {
        $fields = [
            'Posts.id',
            'Posts.title',
            'Posts.slug',
            'Posts.author',
        ];
        return $this->find()
            ->distinct($fields)
            ->matching('Tags', function ($q) use ($options) {
                return $q->where(['Tags.title IN' => $options['tags']]);
            });
    }
    /*end function findTagged*/

    /**************************************************************/
    /*                                                            */
    /*   CHAMA A FUNÇÃO _BUILTAGS ANTES DE SALVAR OS DADOS        */
    /*                                                            */
    /**************************************************************/
    public function beforeSave($event, $entity, $options)
    {
        if ($entity->tag_string) {
            $entity->tags = $this->_buildTags($entity->tag_string);
        }
    }
    /*END BEFORE SAVE*/

    /**************************************************************/
    /*                                                            */
    /*   constroi as tags                                         */
    /*                                                            */
    /**************************************************************/
    protected function _buildTags($tagString)
    {
        $new = array_unique(array_map('trim', explode(',', $tagString)));
        $out = [];
        $query = $this->Tags->find()
            ->where(['Tags.title IN' => $new]);

        // Remove tags existentes da lista de novas tags.
        foreach ($query->extract('title') as $existing) {
            $index = array_search($existing, $new);
            if ($index !== false) {
                unset($new[$index]);
            }
        }
        // Adiciona tags existentes.
        foreach ($query as $tag) {
            $out[] = $tag;
        }
        // Adiciona novas tags.
        foreach ($new as $tag) {
            $out[] = $this->Tags->newEntity(['title' => $tag]);
        }
        return $out;
    }
    /*END _BUILDTAGS*/



}
