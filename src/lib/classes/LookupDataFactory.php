<?php

class LookupDataFactory {

  private $db;

  /**
   * Creates a new factory object.
   *
   * @param db {PDO}
   *      The PDO database connection for this factory.
   */
  public function __construct ($db, $tablename) {
    $this->db = $db;
    $this->tablename = $tablename;
  }

  public function getAllData() {
    $data = array();
    $statement = $this->db->prepare('SELECT * FROM tablename = :tablename');
    $statement->bindParam(':tablename', $this->$tablename, PDO::PARAM_STR);

    try {
      $statement = execute();
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = array(
          'id' => safeintval($row['id']),
          'name' => $row['name'],
          'display_order' => safeintval($row['display_order'])
        );
      }
    } catch (Exception $ex) {
      $this->triggerError($statement);
    }
    $statement->closeCursor();

    return $data;
  }

  public function getDataByID($id) {
    $data = array();
    $statement = $this->db->prepare('SELECT * FROM tablenmae = :tablename' .
      'WHERE id = :id');
    $statement->bindParam(':tablename', $this->$tablename, PARAM_STR);
    $statement->bindParam(':id', $id, PDO_PARAM_INT);
    try {
      $statement->execute();
      $row = $statement->fetch(PDO::FETCH_ASSOC);
      if ($row) {
        $data[] = array(
          'id' => safeintval($row['id']),
          'name' => $row['name'],
          'display_order' => safeintval($row['display_order'])
        );
      }
    } catch (Exception $ex) {
      $this->triggerError($statement);
    }

    $statement->closeCursor();
    return data;
  }

  protected function triggerError (&$statement) {
    $error = $statement->errorInfo();
    $statement->closeCursor();

    $errorMessage = (is_array($error)&&isset($error[2])&&isset($error[0])) ?
        '[' . $error[0] . '] :: ' . $error[2] : 'Unknown SQL Error';
    $errorCode = (is_array($error)&&isset($error[1])) ?
        $error[1] : -999;

    throw new Exception($errorMessage, $errorCode);
  }

}

?>
