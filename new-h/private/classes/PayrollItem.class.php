

<?php
class PayrollItem extends DatabaseObject
{
    protected static $table_name = "payroll_item";
    protected static $db_columns = ['id','item','category','amount','created_at','deleted'];

    public $id;
    public $item;
    public $category;
    public $amount;
    public $created_at ;
    public $deleted;
    public $counts;

    public function __construct($args=[])
    {
        $this->item = $args['item'] ?? '';
        $this->category = $args['category'] ?? '';
        $this->amount = $args['amount'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted = $args['deleted'] ?? '';
    }

 
   
}

