<?php
// final/db.php

class DB {
  public $conn;

  //constructor for DB connection
  function __construct() {
    $server = 'localhost';
    $user = 'root';
    $pw = '';
    $this->conn = new mysqli(
      $server, $user, $pw, 'finalDB'
    );
    if ($this->conn->connect_error) {
      die('connection failed: ' . $this->conn->connect_error);
    }
  }

  //function query
  public function query($sql) {
    $result = $this->conn->query($sql);
    if($result) {
      return $result;
    } else {
      die('Query error: ' . $this->conn->error);
    }
  }

  //function queryOne
  public function queryOne($sql) {
    $result = $this->conn->query($sql);
    if($result) {
      return $result->fetch_assoc();
    } else {
      die('QueryOne error: ' . $this->conn->error);
    }
  }


public function getCommentsForPost($id){
  $stmt = $this->conn->prepare(
        "SELECT comments.*
         FROM comments, posts_comments pc
         LEFT OUTER JOIN comments c ON comment_id = pc.comment_id
         WHERE comments.id = pc.comment_id && pc.post_id = ?
         GROUP BY comments.id"
       );
        if(!$stmt) die("Prepare failed: " . $this->conn->error);

  $bind = $stmt->bind_param("i", $id);
        if(!$bind) die("bind_param failed: " . $stmt->error);

  $execute = $stmt->execute();
        if(!$execute) die("execute failed: " . $stmt->error);

  //$bindResult = $stmt->bind_result($content);

  $result = $stmt->get_result();

        //var_dump($result);

        if(!$result) {
          var_dump($stmt);
          var_dump($this->conn);
          die("bind_result failed: " . $stmt->error);
        }

        //die(var_dump($result->fetch_assoc()));


        $i = 0;
        $postComments = array();
        while($row = $result->fetch_assoc()){
          //var_dump($row);

          $postComments[$i] = $row;
          $i++;
        }
          return $postComments;
        //die(var_dump($postComments[$count]));

        if(!$result->fetch_assoc()) {
          return;
        }

}

public function deleteCommentsFromPost($postID) {
  $stmt = $this->conn->prepare(
        "SELECT comments.id
         FROM comments, posts_comments pc
         LEFT OUTER JOIN comments c ON comment_id = pc.comment_id
         WHERE comments.id = pc.comment_id && pc.post_id = ?
         GROUP BY comments.id"
       );
        if(!$stmt) die("Prepare failed: " . $this->conn->error);

  $bind = $stmt->bind_param("i", $postID);
        if(!$bind) die("bind_param failed: " . $stmt->error);

  $execute = $stmt->execute();
        if(!$execute) die("execute failed: " . $stmt->error);

  $result = $stmt->get_result();

              if(!$result) {
                var_dump($stmt);
                var_dump($this->conn);
                die("bind_result failed: " . $stmt->error);
              }

              $i = 0;
              $postComments = array();
      while($row = $result->fetch_assoc()){
          $postComments[$i] = $row;
          $i++;
      }

  $stmt->free_result();

      foreach($postComments as $item){
        $commentID = $item['id'];
        $sql = $this->conn->query("DELETE FROM comments WHERE id=$commentID");
        //mysql_free_result($sql);

        $statement = $this->conn->query("DELETE FROM posts_comments WHERE post_id=$postID");
        //mysql_free_result($sql);
      }
    }


} // ENDS CLASS
