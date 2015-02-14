<?php
/**
 * Created by PhpStorm.
 * User: welch
 * Date: 2/9/15
 * Time: 8:00 PM
 */

namespace Masterclass\Model;

use Masterclass\Dbal\AbstractDb;

class Comment {

  protected $db;

  /**
   * Constructor method.
   *
   * @param PDO $pdo
   */
  public function __construct(AbstractDb $db){
    $this->db = $db;
  }

  /**
   * Returns the comments for a story.
   *
   * @param $story_id
   * @return array
   */
  public function getCommentsForStory($story_id){

    $comment_sql = 'SELECT * FROM comment WHERE story_id = ?';
    $comments = $this->db->fetchAll($comment_sql, [$story_id]);
    return $comments;
  }

  /**
   * Posts a new comment.
   *
   * @param $username
   * @param $story_id
   * @param $comment
   */
  public function postNewComment($username, $story_id, $comment){
    $sql = 'INSERT INTO comment (created_by, created_on, story_id, comment) VALUES (?, NOW(), ?, ?)';
    return $this->db->execute($sql, array(
      $username,
      $story_id,
      filter_var($comment, FILTER_SANITIZE_FULL_SPECIAL_CHARS),
    ));

  }
}