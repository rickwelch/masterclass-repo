<?php
/**
 * Created by PhpStorm.
 * User: welch
 * Date: 2/9/15
 * Time: 8:00 PM
 */

namespace Masterclass\Model;

USE PDO;

class Comment {

  protected $db;
  protected $config;

  /**
   * Constructor method.
   *
   * @param PDO $pdo
   */
  public function __construct(PDO $pdo){
    $this->db = $pdo;
  }

  /**
   * Returns the comments for a story.
   *
   * @param $story_id
   * @return array
   */
  public function getCommentsForStory($story_id){

    $comment_sql = 'SELECT * FROM comment WHERE story_id = ?';
    $comment_stmt = $this->db->prepare($comment_sql);
    $comment_stmt->execute(array($story_id));
    $comment_count = $comment_stmt->rowCount();
    return $comment_stmt->fetchAll(PDO::FETCH_ASSOC);
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
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array(
      $username,
      $story_id,
      filter_var($comment, FILTER_SANITIZE_FULL_SPECIAL_CHARS),
    ));

  }
}