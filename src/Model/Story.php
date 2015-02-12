<?php
/**
 * Created by PhpStorm.
 * User: welch
 * Date: 2/10/15
 * Time: 5:32 PM
 */

namespace Masterclass\Model;

use PDO;

class Story {

  protected $db;

  /**
   * Class Constructor.
   *
   * @param PDO $pdo
   */
  public function __construct(PDO $pdo){
    $this->db = $pdo;
  }

  /**
   * Returns a list of all stories.
   *
   * @return mixed
   */
  public function getStoryList()
  {
    $sql = 'SELECT * FROM story ORDER BY created_on DESC';
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $stories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($stories as $key => $story)
    {
      $comment_sql = 'SELECT COUNT(*) as `count` FROM comment WHERE story_id = ?';
      $comment_stmt = $this->db->prepare($comment_sql);
      $comment_stmt->execute(array($story['id']));
      $row = $comment_stmt->fetch(PDO::FETCH_ASSOC);
      $stories[$key]['count'] = $row['count'];
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
    $story_stmt = $this->db->prepare($story_sql);
    $story_stmt->execute(array($story_id));
    return $story_stmt->fetch(PDO::FETCH_ASSOC);
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
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array(
      $headline,
      $url,
      $username,
    ));

    return $this->db->lastInsertId();

  }
} 