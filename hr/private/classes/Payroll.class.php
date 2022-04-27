<?php
class Payroll extends DatabaseObject
{
  protected static $table_name = "payroll";
  protected static $db_columns = ['id', 'employee_id', 'present_salary', 'loan', 'salary_advance', 'overtime_allowance', 'leave_allowance', 'other_allowance', 'other_deduction', 'note', 'present_days', 'payment_status', 'month', 'created_at', 'tax', 'pension', 'deleted'];

  public $id;
  public $employee_id;
  public $present_salary;
  public $loan;
  public $salary_advance;
  public $overtime_allowance;
  public $leave_allowance;
  public $other_allowance;
  public $other_deduction;
  public $note;
  public $present_days;
  public $payment_status;
  public $month;
  public $created_at;

  public $counts;

  // ? DEDUCTIONS
  public $tax;
  public $pension;
  public $deleted;

  const STATUS = [
    '1' => 'Computed',
    '2' => 'Sent',
    '3' => 'Processing',
    '4' => 'Paid',
  ];

  const MONTH = [
    '01' => 'January',
    '02' => 'February',
    '03' => 'March',
    '04' => 'April',
    '05' => 'May',
    '06' => 'June',
    '07' => 'July',
    '08' => 'August',
    '09' => 'September',
    '10' => 'October',
    '11' => 'November',
    '12' => 'December',
  ];

  public function __construct($args = [])
  {
    $this->employee_id          = $args['employee_id'] ?? '';
    $this->present_salary       = $args['present_salary'] ?? '';
    $this->loan                 = $args['loan'] ?? '';
    $this->salary_advance       = $args['salary_advance'] ?? '';
    $this->overtime_allowance   = $args['overtime_allowance'] ?? 0;
    $this->leave_allowance      = $args['leave_allowance'] ?? 0;
    $this->other_allowance      = $args['other_allowance'] ?? 0;
    $this->other_deduction      = $args['other_deduction'] ?? 0;
    $this->note                 = $args['note'] ?? '';
    $this->present_days         = $args['present_days'] ?? '';
    $this->payment_status       = $args['payment_status'] ?? 0;
    $this->month                = $args['month'] ?? date('Y-m-d H:i:s');
    $this->created_at           = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->tax                  = $args['tax'] ?? '';
    $this->pension              = $args['pension'] ?? '';
    $this->deleted              = $args['deleted'] ?? '';
  }


  public static function find_by_employee_id($empId, $options = [])
  {
    $date = $options['date'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($empId) . "'";

    if ($date != false) :
      $sql .= " AND `month`='" . self::$database->escape_string($date) . "'";
    endif;

    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function find_by_month($month)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= " AND month LIKE'%" . self::$database->escape_string($month) . "%'";
    // echo $sql;
    $sql .= " ORDER BY id DESC";
    return static::find_by_sql($sql);
  }

  public static function find_by_created_at($created_at)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= " AND created_at LIKE'%" . self::$database->escape_string($created_at) . "%'";
    $sql .= " ORDER BY id DESC";
    return static::find_by_sql($sql);
  }

  // public static function find_by_date($month)
  // {
  //   // $sql = "SELECT * FROM " . static::$table_name . " ";
  //   $sql = "SELECT DATE_FORMAT(process_salary_date,'%Y%m') AS date FROM " . static::$table_name . " ";
  //   $obj_array = static::find_by_sql($sql);
  //   if (!empty($obj_array)) {
  //     return array_shift($obj_array);
  //   } else {
  //     return false;
  //   }
  // }

  public static function find_by_salary_payable($options = [])
  {
    $lastMonth = $options['month'] ?? false;
    $payment_status = $options['payment_status'] ?? false;

    $sql = "SELECT COUNT(employee_id) AS counts, SUM(present_salary) AS present_salary, SUM(loan) AS loan, SUM(salary_advance) AS salary_advance, SUM(overtime_allowance) AS overtime_allowance, SUM(leave_allowance) AS leave_allowance, SUM(other_allowance) AS other_allowance, SUM(other_deduction) AS other_deduction FROM " . static::$table_name . " ";

    if ($lastMonth) {
      $sql .= " WHERE created_at LIKE'%" . self::$database->escape_string($lastMonth) . "%'";
    }
    if ($payment_status) {
      $sql .= " AND payment_status='" . self::$database->escape_string($payment_status) . "'";
    }

    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function tax_calculator($options = [])
  {
    $payrollItem = PayrollItem::find_by_category(1);

    $netSalary = $options['netSalary'] ?? false;


    foreach ($payrollItem as $value) {
      $basic_salary = $netSalary * intval(PayrollItem::find_by_item_name('basic')->amount) / 100;
      $housing = $netSalary * intval(PayrollItem::find_by_item_name('housing')->amount) / 100;
      $transport = $netSalary * intval(PayrollItem::find_by_item_name('transport')->amount) / 100;

      // $dressing = $netSalary * intval(PayrollItem::find_by_item_name('dressing')->amount) / 100;
      // $untility = $netSalary * intval(PayrollItem::find_by_item_name('utility')->amount) / 100;
      // $others = $netSalary * intval(PayrollItem::find_by_item_name('others')->amount) / 100;
    }

    // Pension calculation
    $BHT = $basic_salary + $housing + $transport;
    $pensionContribution = $BHT * 0.08 * 12;
    $montly_pension = $BHT * 0.08;
    $grossSalary = $netSalary * 12;

    // Taxable Income Calculation
    $relief = 200000 + ($grossSalary * 0.20);
    $taxFree = $pensionContribution + $relief;

    $taxable_income = $grossSalary - $taxFree;
    // $taxable_income = 892096;

    $taxValue = '';
    $cost_percent = [];

    if ($taxable_income < 300000) {
      $taxValue = 0;
    } elseif ($taxable_income >= 300000) {

      $taxValue = $taxable_income - 300000; // first 
      $cost_percent['cost_percent1'] = 300000 * 0.07;

      // Second Round
      if ($taxValue > 300000) {
        $taxValue = $taxValue - 300000; // Second
        $cost_percent['cost_percent2'] = 300000 * 0.11;


        if ($taxValue >= 500000) {

          $taxValue = $taxValue - 500000; // Third
          $cost_percent['cost_percent3'] = 500000 * 0.15;

          if ($taxValue >= 500000) {

            $taxValue = $taxValue - 500000; // Fourth
            $cost_percent['cost_percent4'] = 500000 * 0.19;

            if ($taxValue >= 1600000) {

              $taxValue = $taxValue - 1600000; // Fifth
              $cost_percent['cost_percent5'] = 1600000 * 0.21;
              if ($taxValue >= 3200000) {
                $taxValue = $taxValue * 0.24;
              } else {
                $taxValue = $taxValue * 0.24;
              }
            } else {
              $taxValue = $taxValue * 0.21;
            }
          } else {
            $taxValue = $taxValue * 0.19;
          }
        } else {
          $taxValue = $taxValue * 0.15;
        }
      } else {
        $taxValue = $taxValue * 0.11;
      }
    } else {
    }


    $annual_tax =  array_sum($cost_percent) + $taxValue;
    $monthly_tax =  $annual_tax / 12;

    $obj = [
      'netSalary' => $netSalary,
      'grossSalary' => $grossSalary,
      'Basic' => $basic_salary,
      'housing' => $housing,
      'transport' => $transport,
      'relief' => $relief,
      'taxfree' => $taxFree,
      'taxable_income' => $taxable_income,
      'annunal_tax' => $annual_tax,
      'monthly_tax' => $monthly_tax,
      'pension' => $montly_pension,
      'BHT' => $BHT
    ];
    return $obj;
  }

  public static function sum_of_tax_payable()
  {

    $myArr = [];
    $employee = Employee::find_by_undeleted();
    foreach ($employee as $value) {
      $salary = intval($value->present_salary);
      $tax = Payroll::tax_calculator(['netSalary' => intval($salary)]);
      $monthly_tax = $tax['monthly_tax'];
      array_push($myArr, intval($monthly_tax));
      intval($myArr);
    }

    return  array_sum($myArr);
  }

  public static function sum_of_pension_payable()
  {
    $myArr = [];
    $employee = Employee::find_by_undeleted();
    foreach ($employee as $value) {
      $salary = intval($value->present_salary);
      $tax = Payroll::tax_calculator(['netSalary' => intval($salary)]);
      $pension = $tax['pension'];
      array_push($myArr, intval($pension));
      intval($myArr);
    }

    return  array_sum($myArr);
  }
}
