<?php
namespace dynalist;

include "conf/config.php";
include "autoload.php";

$dynalist_api = new dynalist($dynalist_api_private_key);

$return_docs = $dynalist_api->get_all_documents();

echo "<pre>";
print_r($return_docs);
echo "</pre>";

/*$return_node = $dynalist_api->add_item_to_inbox("Add new line to my default todo list");

echo "<pre>";
print_r($return_node);
echo "</pre>";
*/
$contacts_doc = "a4XeglgMJJKN8l22f2CL5gmn";
$return_data = $dynalist_api->get_document_content($contacts_doc);
echo "<pre>";
print_r($return_data);
echo "</pre>";


//$new_document = new document()
/*

$csv_file = "data/contacts_first.txt";

$csv = array_map('str_getcsv', file($csv_file));
array_walk($csv, function(&$a) use ($csv) {
  $a = array_combine($csv[0], $a);
});
array_shift($csv); # remove column header

echo "<pre>";
print_r($csv);
echo "</pre>";


foreach($csv as $curr_item) {


}
*/
// Add a company node

$node[0] = array("action"=>"insert", "parent_id"=>"root", "index"=>0,"content"=>"Company","note"=>"Company view of your data", "checked"=>false);
$node[1] = array("action"=>"insert", "parent_id"=>"root", "index"=>0,"content"=>"People","note"=>"People view of your data", "checked"=>false);

$changes = array($node[0],$node[1]);

$added_nodes = $dynalist_api->set_document_content($contacts_doc,$changes);

echo "<pre>";
print_r($added_nodes);
echo "</pre>";

