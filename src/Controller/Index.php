<?php

namespace Masterclass\Controller;

use Masterclass\Model\Story;

class Index {

  protected $db;
  protected $storyModel;

  public function __construct(Story $story) {
    $this->storyModel = $story;
  }

  public function index() {

    $stories = $this->storyModel->getStoryList();

    $content = '<ol>';
    foreach($stories as $key => $story){

      $content .= '
                <li>
                <a class="headline" href="' . $story['url'] . '">' . $story['headline'] . '</a><br />
                <span class="details">' . $story['created_by'] . ' | <a href="/story/?id=' . $story['id'] . '">' . $story['count'] . ' Comments</a> |
                ' . date('n/j/Y g:i a', strtotime($story['created_on'])) . '</span>
                </li>
            ';
    }

    $content .= '</ol>';
    require  '../layout.phtml';
  }
}

