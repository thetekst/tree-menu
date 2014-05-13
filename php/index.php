<?php

spl_autoload_register(function($class) {
	require_once('classes/'.$class.'.php');
});

$menu = array(
	1 => array(
		"id"=> 1,
		"parent_id"=> 0,
		"title"=> "Категория 1",
		"type" => "folder"
	),
	2 => array(
		"id"=> 2,
		"parent_id"=> 1,
		"title"=> "Подкатегория 1",
		"type" => "folder"
	),
	3 => array(
		"id"=> 3,
		"parent_id"=> 0,
		"title"=> "Категория 2",
		"type" => "file"
	),
	4 => array(
		"id"=> 4,
		"parent_id"=> 2,
		"title"=> "Подкатегория 2",
		"type" => "folder"
	),
	5 => array(
		"id"=> 5,
		"parent_id"=> 4,
		"title"=> "Подкатегория 3",
		"type" => "folder"
	),
	6 => array(
		"id"=> 6,
		"parent_id"=> 0,
		"title"=> "Подкатегория 4",
		"type" => "folder"
	)
);
?>

<ul class="menu">
	<?php treeMenuBuilder::get($menu);?>
</ul>