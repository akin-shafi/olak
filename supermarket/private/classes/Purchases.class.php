<?php
class Purchases extends DatabaseObject
{
    protected static $table_name = "purchases";
    protected static $db_columns = ['id', 'date', 'ref', 'attached', 'note', 'created_at', 'update_at','created_by', 'deleted'];
  
  public $id;
  public $date;
  public $ref;
  public $attached;
  public $note;
 
  public $created_at;
  public $update_at;
  public $created_by;
  public $deleted;
  public $counts;

    

    public function __construct($args=[])
    {
      $this->date = $args['date'] ?? '';
      $this->code = $args['code'] ?? '';
      $this->ref = $args['ref'] ?? '';
      $this->attached = $args['attached'] ?? '';
      $this->note = $args['note'] ?? '';
      
      $this->created_at = $args['created_at'] ?? '';
      $this->update_at = $args['update_at'] ?? date('Y-m-d H:i:s');
      $this->created_by = $args['created_by'] ?? '';
      $this->deleted = $args['deleted'] ?? '';
    }

    

    protected function validate()
    {
        $this->errors = [];
        

        // if (is_blank($this->pname)) {
        //     $this->errors[] = "Product Name cannot be blank.";
        // } 
        

        return $this->errors;
    }
 
    

    
}
