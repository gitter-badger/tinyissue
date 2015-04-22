<?php

/*
 * This file is part of the Tinyissue package.
 *
 * (c) Mohamed Alsharaf <mohamed.alsharaf@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tinyissue\Model\Traits\Project\Issue;

use Illuminate\Database\Eloquent;
use Tinyissue\Model;

/**
 * CountTrait is trait class containing the methods for counting database records for the Issue model
 *
 * @author Mohamed Alsharaf <mohamed.alsharaf@gmail.com>
 *
 * @property int                $project_id
 * @property int                $created_by
 * @property string             $body
 * @property Model\Project      $project
 * @property Model\User         $createdBy
 *
 * @method   Eloquent\Model     belongsTo($related, $foreignKey = null, $otherKey = null, $relation = null)
 * @method   Eloquent\Model     save()
 * @method   Model\Project\Note activity()
 */
trait CountTrait
{
    /**
     * Count number of comments in an issue
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function countComments()
    {
        return $this->hasOne('Tinyissue\Model\Project\Issue\Comment', 'issue_id')
            ->selectRaw('issue_id, count(*) as aggregate')
            ->groupBy('issue_id');
    }
}