<?php
/**
 * Created by PhpStorm.
 * User: welch
 * Date: 2/10/15
 * Time: 5:32 PM
 */

namespace Masterclass\Model;

use Masterclass\Dbal\AbstractDb;
use PDO;

class Story {

  protected $db;

  /**
   * Class Constructor.
   *
   * @param PDO $pdo
   */
  public function __construct(AbstractDb $db){
    $this->db = $db;
  }

  /**
   * Returns a list of all stories.
   *
   * @return mixed
   */
  public function getStoryList()
  {
    $sql = 'SELECT * FROM story ORDER BY created_on DESC';
    $stories = $this->db->fetchAll($sql);

    foreach ($stories as $key => $story)
    {
      $comment_sql = 'SELECT COUNT(*) as `count` FROM comment WHERE story_id = ?';
      $count = $this->db->fetchOne($comment_sql,[$story['id']]);
      $stories[$key]['count'] = $count['count'];
    }
    return $stories;
  }

  /**
   * Returns a specific News Story.
   *
   * @param $story_id
   * @return mixed
   */
  public function getStory($story_id){
    $story_sql = 'SELECT * FROM story WHERE id = ?';
    return $this->db->fetchOne($story_sql, [$story_id]);
  }

  /**
   * Creates a new News Story.
   *
   * @param $headline
   * @param $url
   * @param $username
   * @return string
   */
  public function createNewsStory($headline, $url, $username){
    $sql = 'INSERT INTO story (headline, url, created_by, created_on) VALUES (?, ?, ?, NOW())';
    $this->db->execute($sql, array(
      $headline,
      $url,
      $username,
    ));

    return $this->db->lastInsertId();

  }
} 