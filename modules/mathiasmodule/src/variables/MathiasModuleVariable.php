<?php
/**
 * mathiasModule module for Craft CMS 3.x
 *
 * @link      josefrenner.ch
 * @copyright Copyright (c) 2021 Josef Renner
 */

namespace modules\mathiasmodule\variables;

use modules\mathiasmodule\MathiasModule;

use craft\elements\Entry;
use craft\helpers\ArrayHelper;
use Craft;

/**
 * @author    Josef Renner
 * @package   MathiasModule
 * @since     1.0.0
 */
class MathiasModuleVariable
{
  // Public Methods
  // =========================================================================

  /**
   * @param null $optional
   * @return string
   */

  // helper function
  public function imgPrep($imgArray) {
    $processedArray = ArrayHelper::map($imgArray, 'id', function($img) {
      return (object)[
        'title' => $img->title,
        'medium' => $img->getUrl('medium'),
        'url' => $img->url,
        'id' => $img->id,
        'focalPoint' => $img->hasFocalPoint ? $img->focalPoint : null
      ];
    });
    // array_values orders the array indexes
    // witout it, it will be an object instead of an array
    return array_values($processedArray);
  }

  //   // helper function
  public function videoPrep($videoArray) {
    $processedArray = ArrayHelper::map($videoArray, 'id', function($video) {
      return (object)[
        'title' => $video->title,
        'url' => $video->url,
      ];
    });
    // array_values orders the array indexes
    // witout it, it will be an object instead of an array
    return array_values($processedArray);
  }

  // helper function
  public function projectsWithAssets($projectsWithoutAssets) {
    $enhancedProjects = ArrayHelper::map($projectsWithoutAssets, 'id', function($project) { // change these stupid names!
      // Get associated assets and the other neccessary fields,
      // i.e. everything what is needed in vue. 
      // without this, the assets are not returned with the object.
      // see https://craftcms.stackexchange.com/questions/28559/how-to-include-asset-fields-in-query-in-php
      // because of the "with" attribute (see query above), there is no query
      // neccessary to fetch the assets in the following block.
      //
      // images need to be preprocessed with the imgPrep-Function (see above),
      // in order to get the urls
      $images = $project->images ? $project->images->all() : null;
      $videos = $project->videos ? $project->videos->all() : null;
      return (object)[
        'title' => $project->title,
        'images' => $images ? $this->imgPrep($images) : null,
        'videos' => $videos ? $this->videoPrep($videos) : null,
        'slug' => $project->slug,
        'type' => $project->type->handle,
        'vimeoId' => $project->vimeoId,
        'id' => $project->id
      ];
    });
    return $enhancedProjects;
  }

  // return array of projects
  // handle: projects, competitions, projectStudies
  public function projects($handle)
  {
    // project query, eager 
    $projectQuery = Entry::find()
    ->section($handle);
    // fetch projects
    $projects = $projectQuery->all();
    // return them as array with key by id or something (I forgot)
    return array_values($this->projectsWithAssets($projects));
  }
  
  // return array of projects as json
  // handle: projects, competitions, projectStudies
  public function json_projects($handle)
  {
    $projectsToProcess = $this->projects($handle);
    return json_encode($projectsToProcess);
  }

}
