<?php


class TreeData
{

    protected $data;

    public function __construct()
    {
        $this->data = [
            ["id" => "1", "parent" => "#", "text" => "Parent Child 1"],
            ["id" => "2", "parent" => "#", "text" => "Parent node 2", "children" => true],
            ["id" => "3", "parent" => "2", "text" => "Child 2.1"],
            ["id" => "4", "parent" => "2", "text" => "Child 2.2", "children" => true],
            ["id" => "5", "parent" => "4", "text" => "Grand Child 2.2" ]
        ];
    }

    public function getRecordById($id)
    {
        $record = [];
        foreach ($this->data as $rec) {
            if ($rec['id'] == $id) {
                $record = $rec;
                break;
            }
        }
        return $record;
    }

    public function getChildRecords($id)
    {
        foreach ($this->data as $rec) {
            if ($rec['parent'] == $id) {
                $ret_arr[] = $rec;
            }
        }

        return $ret_arr;
    }

    public function findAllParent($id, &$output)
    {

        if ($id == '#') {
            return ;
        }

        $record = $this->getRecordById($id);
        $parent = $record['parent'];
        $output[] = $parent;
        
        $this->findAllParent($parent, $output);
    }

    public function getParentByString($str)
    {
        foreach ($this->data as $rec) {
            if (stripos($rec['text'], $str)!==false) {
                $ret_arr[$rec['parent']] = 1;
            }
        }

        $ret_arr = array_keys($ret_arr);
        $parent = [];
        foreach ($ret_arr as $id) {
            $this->findAllParent($id, $parent);
        }

        $ret_arr = array_merge($ret_arr, $parent);
        return $ret_arr;
    }
}


/* Main Function */

$obj = new TreeData();

$id = (isset($_GET['id']) && trim($_GET['id']) !='')?$_GET['id']:'';
$str = (isset($_GET['str']) && trim($_GET['str']) !='')?$_GET['str']:'';

$response = [];
if ($id !='' ) {

    $response = $obj->getChildRecords($id);
} else if ($str !='') {

    $response = $obj->getParentByString($str);
}

header('Content-Type: application/json');
echo json_encode($response);
exit();